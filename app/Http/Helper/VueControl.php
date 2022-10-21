<?php

namespace App\Http\Helper;

class VueControl {
    static $singleton;
    public $pool = array();
    public static function Mono(){
        if (self::$singleton)
            return self::$singleton;
        return self::$singleton = new self();
    }
    public function prepareFile($key, $file = array()){
        $this->pool[$key] = $file;
    }
    public static function FileMonoByName($name){
        return [
            (object)[
                'id' => 1,
                'file_desc' => $name
            ]
        ];
    }
}
