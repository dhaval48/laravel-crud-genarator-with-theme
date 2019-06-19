
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ongoingcloud\Laravelcrud\Models\Permission;
use Ongoingcloud\Laravelcrud\Models\Role;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('settings', function (Blueprint $table) {
            $table->increments("id");
            $table->tinyinteger("enable_registration")->nullable();
            $table->string("app_name")->nullable();
            $table->text("favicon")->nullable();
            $table->string("nav_color")->nullable();
			$table->string("side_color")->nullable();
			$table->timestamps();
			
            $table->integer("created_by")->nullable();
        });


        DB::table('settings')->insertGetId([
                            
                'enable_registration' => 1,
                'app_name' => 'Laravel',
                'favicon' => 'favicon.ico',
                'nav_color' => 'Purple',
                'side_color' => 'Purple',
            ]);

        $exist_group = DB::table('module_groups')->where('name','setting')->first();
        if(empty($exist_group)) { 
            
            $module_groups=[
                    'name'=>'setting',
                    'display_name' => 'Setting',
                    'description'=>'Manage the Setting',
                    'module_id'=> null,
                    'status' => 1,
                    'icon' => 'fa-500px',
                    'permission' => 'update_setting',
                    'url' => 'setting',
                    'route' => 'setting.index'
                ];    
            $group_id = DB::table('module_groups')->insertGetId($module_groups);

            $permission = [
                [
                    'name'=>'store_setting',
                    'display_name'=>'Store Setting',
                    'description'=>'Permission to store setting',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'update_setting',
                    'display_name'=>'Update Setting',
                    'description'=>'Permission to update setting',
                    'module_group_id' => $group_id
                ],
            ];
            DB::table('permissions')->insert($permission);

            $permission = Permission::where('module_group_id',$group_id)->get();
            $role = Role::find(1);       
            foreach($permission as $permission) {
                if($permission->name != "only_setting") {            
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
