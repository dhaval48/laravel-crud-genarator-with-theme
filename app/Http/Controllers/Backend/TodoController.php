<?php

namespace App\Http\Controllers\Backend;

use Ongoingcloud\Laravelcrud\Helpers;
use Ongoingcloud\Laravelcrud\General\Activity;
use Ongoingcloud\Laravelcrud\General\HandlePermission;
use App\General\ModuleConfig;
use App\Http\Controllers\Controller;
use App\Models\Todo as Module;
use Auth;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Http\Requests\Todo\DeleteTodoRequest;
use App\Http\Requests\Todo\ListTodoRequest;
use App\Http\Requests\Todo\OnlyTodoRequest;
use Lang;

class TodoController extends Controller {

    public $data = [];        
    
    public $form_view = 'backend.modules.todo';
    public $form_export = 'backend.modules.todo-table';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function default() {
        
        $this->data = ModuleConfig::todos();
         // [Module_Data]
    }

    public function index(ListTodoRequest $request) { 
        $this->default();
        $model = new Module;
        $this->data['permissions'] = HandlePermission::getPermissionsVue($this->data['dir']);

        $this->data['lists'] = Module::latest()->paginate(25);
        $only = new OnlyTodoRequest();
        if($only->authorize()){
            $this->data['lists'] = Module::latest()->where('created_by', \Auth::user()->id)->paginate(25);
        }
        
        $this->data['list_data'] = $model->list_data();
        $this->data['fillable'] = Helpers::formatDeleteFillable();
        return view($this->form_view, ['data'=>$this->data]);
    }

    public function Paginate($from_delete = false ,Request $request) {
        $this->default();
        $this->data['permissions'] = HandlePermission::getPermissionsVue($this->data['dir']);
        
        $model = new Module;
        $searchelements = $model->searchelements;


        if(isset($request->q) && !empty($request->q)) {

            $lists = Module::latest()->where(function($query) use ($searchelements, $request) {
                                    foreach ($searchelements as $key => $value) {

                                        $query = $query->orwhere($value,'like','%'.$request->q.'%');
                                    }
                                });
        } else {
            $lists = Module::latest();
        }

        $only = new OnlyTodoRequest();
        if($only->authorize()){
            $lists = $lists->where('created_by', \Auth::user()->id);
        }

        $this->data['list_data'] = $model->list_data();

        if($request->pdf) {
            $this->data['lists'] = $lists->get();

            $data = $this->data;
            
            $pdf = PDF::loadView($this->form_export, compact('data'));        
            return $pdf->download('Todo.pdf');
        }

        if($request->csv) {
            $this->data['lists'] = $lists->get();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
            $i = 0;
            
            foreach ($this->data['list_data'] as $field => $value) {
                $sheet->setCellValue(range('A', 'Z')[$i]."1", $field);
                $sheet->getStyle(range('A', 'Z')[$i])->getFont()->setSize(10); 
                $sheet->getStyle(range('A', 'Z')[$i]."1")->getFont()->setBold( true );
                $i++;
            }

            $rows = 2;
            $j = 0;
            foreach($this->data['lists'] as $value){

                foreach ($this->data['list_data'] as $list_data) {
                    $list = Helpers::getRelation($value, $list_data);
                    $sheet->setCellValue(range('A', 'Z')[$j].$rows, $list);
                    $sheet->getColumnDimension(range('A', 'Z')[$j])
                        ->setAutoSize(true);
                    $sheet->getStyle(range('A', 'Z')[$j])->getFont()->setSize(10); 
                    $j++;
                }
                $j = 0;
                $rows++;
            }
            $writer = new Csv($spreadsheet);
            header("Content-Type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="Todo.csv"');
            return $writer->save("php://output");
        }

        if($from_delete) {
            return $this->data;
        }

        $this->data['lists'] = $lists->paginate(25);
        return Helpers::successResponse(Lang::get('label.notification.success_message'),$this->data);
    }

    public function create(StoreTodoRequest $request) {
        $this->default();
        return view($this->form_view, ['data'=>$this->data]);
    }

    public function store(StoreTodoRequest $request) {
        $this->default();
        $this->validate($request, [
                "name" => "required",
			
            ]
        );   
         // [GridValidation]
        $input = $request->all();
         //[DropdownValue]

        \DB::beginTransaction();   
        try {
            if(isset($request->id)) {
                $model = Module::find($request->id);
                $msg = Helpers::activity($input, $this->data['lang'], $model->toArray());
                 // [GridActivity]
                 // [GridDelete]
                $model->update($input);
            } else {
                $input["created_by"] = \Auth::user()->id;
                $model = Module::Create($input);
                $msg = "<b>".Auth::user()->name."</b> created ".$this->data['dir'].".";
            }
             // [GridSave]
            if(!empty($msg)) {
                Activity::add($msg, $this->data['dir'], $model->id);
            }
            
        } catch (\Exception $e) {
            \DB::rollback();
            return Helpers::errorResponse();
        }
        \DB::commit();

        $message = isset($request->id) ? Lang::get('todos.edit_message') : Lang::get('todos.create_message');
        return Helpers::successResponse($message,$model);
    }

    public function edit($id, UpdateTodoRequest $request) {
        $this->default();
        $this->data['id'] = $id;
        $model = Module::findorfail($id);
        $formelement = $model->getAttributes();
        $formelement['_token'] = csrf_token();
         // [DropdownSelectedValue]
        
         // [GridEdit]
        $this->data['fillable'] = $formelement;

        $this->data['permissions'] = HandlePermission::getPermissionsVue($this->data['dir']);

        $only = new OnlyTodoRequest();
        if(!$only->authorize() || $model->created_by == \Auth::user()->id) {
            return view($this->form_view, ['data'=>$this->data]);
        } else {
            return "Unauthorized!";
        }
    }

    public function destroy(DeleteTodoRequest $request){
        $this->default();
        $this->data['permissions'] = HandlePermission::getPermissionsVue($this->data['dir']);
        
        \DB::beginTransaction();
        try {
            $model = Module::findorfail($request->id);
            $msg = "<b>".Auth::user()->name."</b> deleted data of id : ". $model->id;
            Activity::add($msg, $this->data['dir'], $model->id);
             // [GridDelete]
            $model->delete();
        } catch (\Exception $e) {
            \DB::rollback();                        
            return Helpers::errorResponse('Error while deleting todo. Try again latter');
        }
        \DB::commit();

        $model = new Module;
        $this->data['lists'] = Module::latest()->paginate(25);
        $only = new OnlyTodoRequest();
        if($only->authorize()){
            $this->data['lists'] = Module::latest()->where('created_by', \Auth::user()->id)->paginate(25);
        }
        $this->data['list_data'] = $model->list_data();
        return Helpers::successResponse(Lang::get('todos.delete_message'),$this->data);
    }
}
