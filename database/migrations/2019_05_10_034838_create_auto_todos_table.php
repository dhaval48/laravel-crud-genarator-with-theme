
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $exist_module = DB::table('form_modules')->where('main_module','todo')->first();
        if(empty($exist_module)) {

            $module_id = DB::table('form_modules')->insertGetId([
                            
                 'parent_module' => null,
                 'main_module' => 'todo',
                 'table_name' => 'todos',
                
                        ]);
            $data = [
                    
                    [
                        'formmodule_id' => $module_id,
                        'name' => 'name',
                        'type' => 'varchar',
                        'validation' => 'required',
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
                        'db_name' => 'description',
                        'input_name' => 'description',
                        'input_type' => 'textarea',
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
