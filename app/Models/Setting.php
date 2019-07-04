<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Lang;

/**
 * Class Setting.
 */
class Setting extends Model
{

    protected $table = 'settings';

    protected $fillable = [
            // 'enable_registration',
    		'app_name',
            'favicon',
            'nav_color',
            'side_color',	
            'created_by',
        ];

    public $formelements = [
        // "enable_registration" => "",
		'app_name' => "",
        'favicon' => "",
        'nav_color' => "",
        'side_color'=> "",

         // [ModelArray]
    ];

     // [Relation]
}
