<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * AList is a base model which has several attributes to set up Front End function such as : Sort, Search, Filter Value or Date Range.
 * Indonesia Translate : AList adalah model yang memiliki beberapa attribute untuk mengatur fungsi Front End seperti : Pengurutan, Pencarian, Penjaringan atau Jangka waktu.
 * @var string $sort_default _column key_ as default sort (created_at usually)
 * @var string $date_default _column key_ as default date filter (created_at usually)
 * @var Array $searchable _column key_ with value 0 as first key, and 1 to next key. use array to define relation search
 * @var Array $sortable column key with null as self attribute, and array to define relation sort
 */

abstract class _List extends Model {
    public $timestamps = false;
    protected $searchable = [];
    protected $sortable = [];
    protected $filterable = [];
    protected $sort_default = 'created_at';
    protected $date_default = 'created';


    public function scopeFilter($query, $request) {
        if ($request->fl) {
            if (!$this->uniqueFilter($query, $request->fl, $request->tfl))
                switch ($request->tfl) {
                    case 'null':
                        $query->whereNull($request->fl);
                        break;
                    case 'fill':
                        $query->whereNotNull($request->fl);
                        break;
                    default:
                        $query->where($request->fl, $request->tfl);
                        break;
                }
        }
        if ($request->asort || $request->dsort) {
            $sort_type = $request->asort ? 'ASC' : 'DESC';
            $sort_value = $request->asort ? $request->asort : $request->dsort;
            if (array_key_exists($sort_value, $this->sortable)) {
                $cols = $this->sortable[$sort_value];
                if ($cols) {
                    $query->select($this->table . '.*', $cols[0] . '.' . $cols[2])->leftJoin($cols[0], function ($join) use ($cols) {
                        $join->on($this->table . '.' . $cols[1], '=', $cols[0] . '.id');
                    })->orderBy($cols[2], $sort_type);
                } else {
                    $query->orderBy($sort_value, $sort_type);
                }
            }
        } else
            $query->latest($this->sort_default);

        if ($request->dt) {
            $query->where($this->date_default, '<=', $request->dt);
        }
        if ($request->df) {
            $query->where($this->date_default, '>=', $request->df);
        }
        if ($request->sc) {
            $val = '%' . $request->sc . '%';
            foreach ($this->searchable as $key => $fkey) {
                if (is_numeric($fkey)) {
                    switch ($fkey) {
                        case 0: // first
                            $query->where($key, 'like', $val);
                            break;
                        case 1: // second
                            $query->orWhere($key, 'like', $val);
                            break;
                        default:
                            $query = $this->uniqueSearch($query);
                    }
                } else {
                    $query->orWhereHas($key, function ($q) use ($fkey, $val) {
                        return $q->where($fkey, 'like', $val);
                    });
                }
            }
        }
        foreach ($this->filterable as $k => $f) {
            if ($request->has($k)) {
                if (!$this->uniqueOption($query, $k, $request->{$k}))
                    $query->where($f, $request->{$k});
            }
        }
        return $query;
    }
    protected function uniqueSearch($query) {
        return $query;
    }
    protected function uniqueOption($query, $key, $value) {
        return false;
    }
    protected function uniqueFilter($query, $key, $value) {
        return false;
    }
}
