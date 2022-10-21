<?php

namespace App\Http\Helper;

use Illuminate\Support\Facades\Route;

class Routing {
    static $routeName;
    static $routeParameters;
    public static function getCurrentRouteName() {
        if (self::$routeName)
            return self::$routeName;
        return self::$routeName = Route::currentRouteName();
    }
    public static function getCurrentParameters() {
        if (self::$routeParameters)
            return self::$routeParameters;
        return self::$routeParameters = Route::current()->parameters;
    }
    public static function setName($name) {
        return [
            'names' => [
                'index' => $name,
                'create' => $name . '.create',
                'store' => $name . '.store',
                'show' => $name . '.show',
                'update' => $name . '.update',
                'edit' => $name . '.edit',
                'destroy' => $name . '.destroy'
            ]
        ];
    }

    public static function getUpdateWithNextID($next_id) {
        $param = self::getCurrentParameters();
        $param[] = $next_id;
        return route(self::getCurrentRouteName() . '.update', $param);
    }
    public static function getShowWithNextID($next_id) {
        $param = self::getCurrentParameters();
        $param[] = $next_id;
        return route(self::getCurrentRouteName() . '.show', $param);
    }
}
