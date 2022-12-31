<?php

namespace App\Http\Filters\Api;

use App\Http\Filters\Filter;

class ArtistFilter extends Filter
{
    protected $filters = ['name', 'gender', 'country'];

    public function name($value)
    {
        return $this->builder->where('name', 'LIKE', "%$value%");
    }

    public function gender($value)
    {
        return $this->builder->where('gender', $value);
    }

    public function country($value)
    {
        return $this->builder->where('country', $value);
    }
}
