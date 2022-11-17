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
                'create' => 'create.' . $name,
                'store' => $name . '.store',
                'show' => $name . '.show',
                'update' => $name . '.update',
                'edit' => $name . '.edit',
                'destroy' => $name . '.destroy'
            ]
        ];
    }

    public static function getRouteWithNextID($next_id, $sub) {
        $param = self::getCurrentParameters();
        $param[] = $next_id;
        return route(self::getCurrentRouteName() . $sub , $param);
    }

    public static function getEditWithNextID($next_id) {
        $param = self::getCurrentParameters();
        $param[] = $next_id;
        return route(self::getCurrentRouteName() . '.edit', $param);
    }

    public static function getShowWithNextID($next_id) {
        $param = self::getCurrentParameters();
        $param[] = $next_id;
        return route(self::getCurrentRouteName() . '.show', $param);
    }

    public static function getUpdateWithID($next_id, $route = null) {
        if ($route) {
            $param = self::getCurrentParameters();
            $param[] = $next_id;
            return route($route . '.update', array_values($param));
        } else {
            $param = self::getCurrentParameters();
            $param[] = $next_id;
            return route(str_replace('.edit', '', self::getCurrentRouteName()) . '.update', $param);
        }
    }

    public static function getAdd() {
        $param = self::getCurrentParameters();
        return route(str_replace('.create', '', Routing::getCurrentRouteName()), array_values($param));
    }
}
