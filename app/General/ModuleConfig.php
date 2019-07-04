<?php 

namespace App\General;
use Lang;

class ModuleConfig {
    public static function theme_settings() {
        return include 'ModuleConfig/themesetting.php';
    }

    public static function settings() {
        return include 'ModuleConfig/setting.php';
    }


	// [Moduleconfig]
}