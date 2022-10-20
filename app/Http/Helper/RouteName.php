<?php

namespace App\Http\Helper;

class RouteName {
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
}
