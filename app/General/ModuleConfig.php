<?php 

namespace App\General;
use Lang;

class ModuleConfig {

    public static function status() {
        return include 'ModuleConfig/status.php';
    }



    public static function theme_settings() {
        return include 'ModuleConfig/themesetting.php';
    }

	// [Moduleconfig]
}