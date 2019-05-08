
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ongoingcloud\Laravelcrud\Models\Permission;
use Ongoingcloud\Laravelcrud\Models\Role;

class CreateThemeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('theme_settings', function (Blueprint $table) {
            $table->increments("id");
			$table->string("color")->nullable();
			$table->timestamps();
			$table->softDeletes();
			
			
            $table->integer("created_by")->nullable();
        });

        DB::table('theme_settings')->insertGetId([
                            
            'color' => "Purple",
            
        ]);


        $check_exist = DB::table('modules')->where('name','General')->first();
        $exist_group = DB::table('module_groups')->where('name','themesetting')->first();
        if(empty($exist_group)) {
            if(!empty($check_exist)) {
                $id = $check_exist->id;
            } else {
                $module = \DB::table('modules')->orderBy('id', 'DESC')->first();

                $id = DB::table('modules')->insertGetId([
                    'name' => 'General',
                    'description' => 'Manage General',
                    'url' => 'general',
                    'icon' => 'fa-database',
                    'order' => $module->order+1,
                ]);
            }   
            
            $module_groups=[
                    'name'=>'themesetting',
                    'display_name' => 'Theme Setting',
                    'description'=>'Manage the Theme Setting',
                    'module_id'=> $id,
                    'status' => 1,
                    'icon' => 'fa-500px',
                    'permission' => 'list_themesetting',
                    'url' => 'themesetting',
                    'route' => 'themesetting.index'
                ];    
            $group_id = DB::table('module_groups')->insertGetId($module_groups);

            $permission = [
                [
                    'name'=>'store_themesetting',
                    'display_name'=>'Store Theme Setting',
                    'description'=>'Permission to store themesetting',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'update_themesetting',
                    'display_name'=>'Update Theme Setting',
                    'description'=>'Permission to update themesetting',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'list_themesetting',
                    'display_name'=>'List Theme Setting',
                    'description'=>'Permission to list themesetting',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'delete_themesetting',
                    'display_name'=>'Delete Theme Setting',
                    'description'=>'Permission to delete themesetting',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'only_themesetting',
                    'display_name'=>'Only If Creator',
                    'description'=>'Permission to only creator themesetting',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'activity_themesetting',
                    'display_name'=>'Activity of Theme Setting',
                    'description'=>'Permission to activity themesetting',
                    'module_group_id' => $group_id
                ]
            ];
            DB::table('permissions')->insert($permission);

            $permission = Permission::where('module_group_id',$group_id)->get();
            $role = Role::find(1);       
            foreach($permission as $permission) {
                if($permission->name != "only_themesetting") {            
                    $role->permissions()->attach($role->id, ['permission_id' => $permission->id]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
