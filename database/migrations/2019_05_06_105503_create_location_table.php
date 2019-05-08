
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ongoingcloud\Laravelcrud\Models\Permission;
use Ongoingcloud\Laravelcrud\Models\Role;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('location', function (Blueprint $table) {
            $table->increments("id");
			$table->string("name")->nullable();
			$table->integer("postcode")->nullable();
			$table->integer("area_no")->nullable();
			$table->timestamps();
			$table->softDeletes();
			
			
            $table->integer("created_by")->nullable();
        });


        $check_exist = DB::table('modules')->where('name','General')->first();
        $exist_group = DB::table('module_groups')->where('name','location')->first();
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
                    'name'=>'location',
                    'display_name' => 'Location',
                    'description'=>'Manage the Location',
                    'module_id'=> $id,
                    'status' => 1,
                    'icon' => 'fa-500px',
                    'permission' => 'list_location',
                    'url' => 'location',
                    'route' => 'location.index'
                ];    
            $group_id = DB::table('module_groups')->insertGetId($module_groups);

            $permission = [
                [
                    'name'=>'store_location',
                    'display_name'=>'Store Location',
                    'description'=>'Permission to store location',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'update_location',
                    'display_name'=>'Update Location',
                    'description'=>'Permission to update location',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'list_location',
                    'display_name'=>'List Location',
                    'description'=>'Permission to list location',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'delete_location',
                    'display_name'=>'Delete Location',
                    'description'=>'Permission to delete location',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'only_location',
                    'display_name'=>'Only If Creator',
                    'description'=>'Permission to only creator location',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'activity_location',
                    'display_name'=>'Activity of Location',
                    'description'=>'Permission to activity location',
                    'module_group_id' => $group_id
                ]
            ];
            DB::table('permissions')->insert($permission);

            $permission = Permission::where('module_group_id',$group_id)->get();
            $role = Role::find(1);       
            foreach($permission as $permission) {
                if($permission->name != "only_location") {            
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
