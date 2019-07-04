<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lang;

/**
 * Class Themesetting.
 */
class Themesetting extends Model
{

    use SoftDeletes;

    protected $table = 'theme_settings';

    protected $fillable = [
        'color',
				
        'created_by',
        ];

    public $formelements = [
        "color" => "",
		

         // [ModelArray]
    ];

    public $searchelements = [
        'color',
				
        ];

    public function list_data() {
        return  [
            Lang::get('theme_settings.color') => 'color',
			
        ];
    }


     // [Relation]
}
