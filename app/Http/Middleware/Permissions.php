<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\RoleHasPermission;
use Illuminate\Support\Facades\Auth;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $perId = Permission::where('name', $request->route()->getName())->value('id');
        $can = RoleHasPermission::where('permission_id', $perId)->pluck('role_id')->toArray();
        if(in_array(Auth::guard('admin')->user()->roles()->value('id'), $can)) {
            return $next($request);
        }
        // abort('403', 'you have no permission');
        return redirect('403');
    }
}
