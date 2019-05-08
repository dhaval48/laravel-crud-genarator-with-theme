
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ongoingcloud\Laravelcrud\Models\Permission;
use Ongoingcloud\Laravelcrud\Models\Role;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tasks', function (Blueprint $table) {
            $table->increments("id");
			$table->string("name")->nullable();
			$table->string("description")->nullable();
			$table->timestamps();
			$table->softDeletes();
			
			
            $table->integer("created_by")->nullable();
        });


        $check_exist = DB::table('modules')->where('name','General')->first();
        $exist_group = DB::table('module_groups')->where('name','task')->first();
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
                    'name'=>'task',
                    'display_name' => 'Task',
                    'description'=>'Manage the Task',
                    'module_id'=> $id,
                    'status' => 1,
                    'icon' => 'fa-500px',
                    'permission' => 'list_task',
                    'url' => 'task',
                    'route' => 'task.index'
                ];    
            $group_id = DB::table('module_groups')->insertGetId($module_groups);

            $permission = [
                [
                    'name'=>'store_task',
                    'display_name'=>'Store Task',
                    'description'=>'Permission to store task',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'update_task',
                    'display_name'=>'Update Task',
                    'description'=>'Permission to update task',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'list_task',
                    'display_name'=>'List Task',
                    'description'=>'Permission to list task',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'delete_task',
                    'display_name'=>'Delete Task',
                    'description'=>'Permission to delete task',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'only_task',
                    'display_name'=>'Only If Creator',
                    'description'=>'Permission to only creator task',
                    'module_group_id' => $group_id
                ],
                [
                    'name'=>'activity_task',
                    'display_name'=>'Activity of Task',
                    'description'=>'Permission to activity task',
                    'module_group_id' => $group_id
                ]
            ];
            DB::table('permissions')->insert($permission);

            $permission = Permission::where('module_group_id',$group_id)->get();
            $role = Role::find(1);       
            foreach($permission as $permission) {
                if($permission->name != "only_task") {            
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
