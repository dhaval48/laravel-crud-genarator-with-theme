<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lang;

/**
 * Class Status.
 */
class Status extends Model
{

    use SoftDeletes;

    protected $table = 'status';

    protected $fillable = [
        'name',
				
        'created_by',
        ];

    public $formelements = [
        "name" => "",
		

         // [ModelArray]
    ];

    public $searchelements = [
        'name',
				
        ];

    public function list_data() {
        return  [
            Lang::get('status.name') => 'name',
			
        ];
    }


     // [Relation]
}
