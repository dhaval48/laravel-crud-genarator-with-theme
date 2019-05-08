<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lang;

/**
 * Class Task.
 */
class Task extends Model
{

    use SoftDeletes;

    protected $table = 'tasks';

    protected $fillable = [
        'name',
				'status',
				'description',
				
        'created_by',
        ];

    public $formelements = [
        "name" => "",
		"status" => "",
		"description" => "",
		

         // [ModelArray]
    ];

    public $searchelements = [
        'name',
				'status',
				'description',
				
        ];

    public function list_data() {
        return  [
            Lang::get('tasks.name') => 'name',
			Lang::get('tasks.status') => 'status.id',
			Lang::get('tasks.description') => 'description',
			
        ];
    }


     	
	public function status() {
	    return $this->belongsTo('App\Models\Status','status','id');
	}
// [Relation]
}
