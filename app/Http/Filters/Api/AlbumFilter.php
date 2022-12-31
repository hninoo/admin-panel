<?php

namespace App\Http\Filters\Api;

use App\Http\Filters\Filter;

class AlbumFilter extends Filter
{
    protected $filters = ['name', 'artitstId'];

    public function name($value)
    {
        return $this->builder->where('name', 'LIKE', "%$value%");
    }

    public function artitstId($value)
    {
        return $this->builder->whereHas('artist', function ($q) use ($value) {
            $q->where('name', 'like', "%$value%");
        });
    }
}
