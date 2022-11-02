<?php

namespace App\Http\Helper;

class VueControl {
    static $singleton;
    public $pool = array();
    public static function Mono() {
        if (self::$singleton)
            return self::$singleton;
        return self::$singleton = new self();
    }
    public function prepareFile($key, $file = array()) {
        $this->pool[$key] = $file;
    }
    public static function Mapping($arrays, string $desc_key) {
        if (sizeof($arrays) > 0) {
            $array = array();
            foreach ($arrays as $obj) {
                $array[] = (object)[
                    'id' => $obj->id,
                    'file_desc' => $obj->{$desc_key}
                ];
            }
            return $array;
        }
        return [];
    }
    public static function FileMonoByName($name) {
        return [
            (object)[
                'id' => 1,
                'file_desc' => $name
            ]
        ];
    }
}
