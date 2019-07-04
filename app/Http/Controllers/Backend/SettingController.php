<?php

namespace App\Http\Controllers\Backend;

use Ongoingcloud\Laravelcrud\Helpers;
use Ongoingcloud\Laravelcrud\General\Activity;
use Ongoingcloud\Laravelcrud\General\HandlePermission;
use App\General\ModuleConfig;
use App\Http\Controllers\Controller;
use App\Models\Setting as Module;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests\Setting\StoreSettingRequest;
use App\Http\Requests\Setting\UpdateSettingRequest;
use Lang;

class SettingController extends Controller {

    public $data = [];        
    
    public $form_view = 'backend.modules.setting';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function default() {
        
        $this->data = ModuleConfig::settings();
         // [Module_Data]
    }

    public function store(StoreSettingRequest $request) {
        $this->default(); 
        $this->validate($request, [
                'app_name' => 'required',
            ]
        );   
        // $input = Helpers::attachFile($request);
        $input = $request->all();
        // $input['enable_registration'] = $input['enable_registration'] ? true : false;
        
        \DB::beginTransaction();   
        try {

            if(isset($request->id)) {
                $model = Module::find($request->id);

                if($request->hasFile('favicon')) {
                    $destinationPath = public_path();

                    $file_name = date('mdYHis') . uniqid() . "." .$request->favicon->getClientOriginalExtension();

                    $request->favicon->move($destinationPath, $file_name);

                    $input['favicon'] = $file_name;
                    unlink($destinationPath.'/'.$model->favicon);
                }

                if (file_exists(base_path().'/.env')) {
                    file_put_contents(base_path().'/.env', str_replace(
                        'APP_NAME='.$model->app_name, 'APP_NAME='.$request->app_name, file_get_contents(base_path().'/.env')
                    ));
                }
                $content = file_get_contents(base_path().'/.env');
                $content = preg_replace('/'.$model->app_name . '$/',"'".$request->app_name."'", $content);

                file_put_contents(base_path()."/.env", $content);

                $msg = Helpers::activity($input, $this->data['lang'], $model->toArray());
                 // [GridActivity]
                 // [GridDelete]
                $model->update($input);
            }
            if(!empty($msg)) {
                Activity::add($msg, $this->data['dir'], $model->id);
            }
            
        } catch (\Exception $e) {
            dd($e);
            \DB::rollback();
            return Helpers::errorResponse();
        }
        \DB::commit();

        $message = isset($request->id) ? Lang::get('settings.edit_message') : Lang::get('settings.create_message');
        return Helpers::successResponse($message,$model);
    }

    public function edit(UpdateSettingRequest $request) {
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
