<?php

namespace App\Http\Helper;

use Illuminate\Support\Facades\Session;

class Table {
    public static function tableProp($paginate) {
        return [
            'total' => $paginate->total(),
            'count' => $paginate->count(),
            'per_page' => $paginate->perPage(),
            'current_page' => $paginate->currentPage(),
            'total_pages' => $paginate->lastPage(),
        ];
    }
}
