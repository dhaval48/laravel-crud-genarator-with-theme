<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lang;

/**
 * Class Todo.
 */
class Todo extends Model
{

    use SoftDeletes;

    protected $table = 'todos';

    protected $fillable = [
        'name',
				'description',
				
        'created_by',
        ];

    public $formelements = [
        "name" => "",
		"description" => "",
		

         // [ModelArray]
    ];

    public $searchelements = [
        'name',
				'description',
				
        ];

    public function list_data() {
        return  [
            Lang::get('todos.name') => 'name',
			Lang::get('todos.description') => 'description',
			
        ];
    }


     // [Relation]
}
