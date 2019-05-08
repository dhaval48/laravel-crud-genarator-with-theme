
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $exist_module = DB::table('form_modules')->where('main_module','Task')->first();
        if(empty($exist_module)) {

            $module_id = DB::table('form_modules')->insertGetId([
                            
                 'parent_module' => 'General',
                 'main_module' => 'Task',
                 'table_name' => 'tasks',
                
                        ]);
            $data = [
                    
                    [
                        'formmodule_id' => $module_id,
                        'name' => 'name',
                        'type' => 'varchar',
                        'validation' => null,
                        'default' => null,
                    ],
                    
                    [
                        'formmodule_id' => $module_id,
                        'name' => 'status',
                        'type' => 'varchar',
                        'validation' => null,
                        'default' => null,
                    ],
                    
                    [
                        'formmodule_id' => $module_id,
                        'name' => 'description',
                        'type' => 'varchar',
                        'validation' => null,
                        'default' => null,
                    ],
                    
                ];

            DB::table('module_tables')->insert($data);

            $values = [
                    
                    [
                        'formmodule_id' => $module_id,
                        'visible' => 1,
                        'db_name' => 'name',
                        'input_name' => 'name',
                        'input_type' => 'input',
                        'key' => null,
                        'value' => null,
                        'table' => null,
                    ],
                    
                    [
                        'formmodule_id' => $module_id,
                        'visible' => 1,
                        'db_name' => 'status',
                        'input_name' => 'status',
                        'input_type' => 'dropdown',
                        'key' => 'id',
                        'value' => 'name',
                        'table' => 'status',
                    ],
                    
                    [
                        'formmodule_id' => $module_id,
                        'visible' => 1,
                        'db_name' => 'description',
                        'input_name' => 'description',
                        'input_type' => 'input',
                        'key' => null,
                        'value' => null,
                        'table' => null,
                    ],
                    
                ];
            DB::table('module_inputs')->insert($values);
        }       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
