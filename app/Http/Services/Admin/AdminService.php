<?php

namespace App\Http\Services\Admin;

use App\Http\Repositories\Admin\AdminRepository;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    private $adminRepo;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo = $adminRepo;
        $this->itemPerPage = config('enums.itemPerPage');
    }

    public function getAll($filter)
    {
        return $this->adminRepo->getPaginatedWithFilter($this->itemPerPage, $filter);
    }

    public function create($request)
    {
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        try {
            $admin = $this->adminRepo->create($data);
            if ($request->role) {
                $admin->assignRole($request->role);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($request, $id)
    {
        // Find  Admin
        $admin = $this->adminRepo->getById($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }

        try {
            $admin->save();

            $admin->roles()->detach();
            if ($request->role) {
                $admin->assignRole($request->role);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
