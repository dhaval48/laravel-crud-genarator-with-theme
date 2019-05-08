<?php 

namespace App\General;
use Lang;

class ModuleConfig {

    public static function status() {
        return include 'ModuleConfig/status.php';
    }

    public static function tasks() {
        return include 'ModuleConfig/task.php';
    }

    public static function location() {
        return include 'ModuleConfig/location.php';
    }

	// [Moduleconfig]
}