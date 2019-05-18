<?php

namespace App\Http\Controllers\Backend;

use Ongoingcloud\Laravelcrud\Helpers;
use Ongoingcloud\Laravelcrud\General\Activity;
use Ongoingcloud\Laravelcrud\General\HandlePermission;
use App\General\ModuleConfig;
use App\Http\Controllers\Controller;
use App\Models\Themesetting as Module;
use Auth;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

use App\Http\Requests\Themesetting\StoreThemesettingRequest;
use App\Http\Requests\Themesetting\UpdateThemesettingRequest;
use Lang;

class ThemesettingController extends Controller {

    public $data = [];        
    
    public $form_view = 'backend.modules.themesetting';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function default() {
        
        $this->data = ModuleConfig::theme_settings();
         // [Module_Data]
    }

    public function store(StoreThemesettingRequest $request) {
        $this->default();
        $this->validate($request, [
                
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

        $message = isset($request->id) ? Lang::get('theme_settings.edit_message') : Lang::get('theme_settings.create_message');
        return Helpers::successResponse($message,$model);
    }

    public function edit(UpdateThemesettingRequest $request) {
        $this->default();
        $this->data['id'] = 1;
        $model = Module::findorfail(1);
        $formelement = $model->getAttributes();
        $formelement['_token'] = csrf_token();
         // [DropdownSelectedValue]
        
         // [GridEdit]
        $this->data['fillable'] = $formelement;

        $this->data['permissions'] = HandlePermission::getPermissionsVue($this->data['dir']);

        return view($this->form_view, ['data'=>$this->data]);
    }
}
