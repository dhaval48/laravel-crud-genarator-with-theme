<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lang;

/**
 * Class Location.
 */
class Location extends Model
{

    use SoftDeletes;

    protected $table = 'location';

    protected $fillable = [
        'name',
				'postcode',
				'area_no',
				
        'created_by',
        ];

    public $formelements = [
        "name" => "",
		"postcode" => "",
		"area_no" => "",
		

         // [ModelArray]
    ];

    public $searchelements = [
        'name',
				'postcode',
				'area_no',
				
        ];

    public function list_data() {
        return  [
            Lang::get('location.name') => 'name',
			Lang::get('location.postcode') => 'postcode',
			Lang::get('location.area_no') => 'area_no',
			
        ];
    }


     // [Relation]
}
