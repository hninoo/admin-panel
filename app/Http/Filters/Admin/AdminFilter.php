<?php

namespace App\Http\Filters\Admin;

use App\Http\Filters\Filter;

class AdminFilter extends Filter
{
    protected $filters = ['name', 'email', 'nickname', 'role'];

    public function name($value)
    {
        return $this->builder->where('name', 'LIKE', "%$value%");
    }

    public function email($value)
    {
        return $this->builder->where('email', 'LIKE', "%$value%");
    }

    public function nickname($value)
    {
        return $this->builder->where('nickname', $value);
    }

    public function role($value)
    {
        if (request('role') != null)
            return $this->builder->whereHas('roles', function ($query) use ($value) {
                $query->where('id', $value);
            });
    }

    // public function amount($value)
    // {
    //     if ($value) {
    //         return $this->builder->whereHas('amount', function ($q) use ($value) {
    //             $q->where('user_amounts.amount', $value);
    //         });
    //     }
    // }
}
