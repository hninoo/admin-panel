<?php

namespace App\Http\Filters;

class UserFilter extends Filter
{
    protected $filters = ['name', 'email', 'money', 'coin'];

    public function name($value)
    {
        return $this->builder->where('name', 'LIKE', "%{$value}%");
    }

    public function email($value)
    {
        return $this->builder->where('email', 'like', "%{$value}%");
    }

    public function money($value)
    {
        if ($value) {
            return $this->builder->where('money', '>=', $value);
        }
    }

    public function coin($value)
    {
        if ($value) {
            return $this->builder->where('money', '>=', $value);
        }
    }
}
