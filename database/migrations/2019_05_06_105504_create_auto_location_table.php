
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $exist_module = DB::table('form_modules')->where('main_module','Location')->first();
        if(empty($exist_module)) {

            $module_id = DB::table('form_modules')->insertGetId([
                            
                 'parent_module' => 'General',
                 'main_module' => 'Location',
                 'table_name' => 'location',
                
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
                        'name' => 'postcode',
                        'type' => 'integer',
                        'validation' => null,
                        'default' => null,
                    ],
                    
                    [
                        'formmodule_id' => $module_id,
                        'name' => 'area_no',
                        'type' => 'integer',
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
                        'db_name' => 'postcode',
                        'input_name' => 'postcode',
                        'input_type' => 'input',
                        'key' => null,
                        'value' => null,
                        'table' => null,
                    ],
                    
                    [
                        'formmodule_id' => $module_id,
                        'visible' => 1,
                        'db_name' => 'area_no',
                        'input_name' => 'area_no',
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
