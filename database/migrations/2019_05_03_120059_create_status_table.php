
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ongoingcloud\Laravelcrud\Models\Permission;
use Ongoingcloud\Laravelcrud\Models\Role;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('status', function (Blueprint $table) {
            $table->increments("id");
			$table->string("name")->nullable();
			$table->timestamps();
			$table->softDeletes();
			
			
            $table->integer("created_by")->nullable();
        });


        $check_exist = DB::table('modules')->where('name','General')->first();
        $exist_group = DB::table('module_groups')->where('name','status')->first();
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
                    'name'=>'status',
                    'display_name' => 'Status',
                    'description'=>'Manage the Status',
                    'module_id'=> $id,
                    'status' => 1,
                    'icon' => 'fa-500px',
                    'permission' => 'list_status',
                    'url' => 'status',
                    'route' => 'status.index'
                ];    
            $group_id = DB::table('module_groups')->insertGetId($module_groups);

            $permission = [
                [
                    'name'=>'store_status',
                    'display_name'=>'Store Status',
                    'description'=>'Permission to store status',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'update_status',
                    'display_name'=>'Update Status',
                    'description'=>'Permission to update status',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'list_status',
                    'display_name'=>'List Status',
                    'description'=>'Permission to list status',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'delete_status',
                    'display_name'=>'Delete Status',
                    'description'=>'Permission to delete status',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'only_status',
                    'display_name'=>'Only If Creator',
                    'description'=>'Permission to only creator status',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'activity_status',
                    'display_name'=>'Activity of Status',
                    'description'=>'Permission to activity status',
                    'module_group_id' => $group_id
                ]
            ];
            DB::table('permissions')->insert($permission);

            $permission = Permission::where('module_group_id',$group_id)->get();
            $role = Role::find(1);       
            foreach($permission as $permission) {
                if($permission->name != "only_status") {            
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
