@extends('admin.layout.master')

@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="w-100 px-10">
        <!--begin::Table Widget 7-->
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Edit Role</span>
                </h3>
                <div class="card-toolbar">
                </div>
            </div>

            <div class="card-body pt-3">
                <!--begin::Table container-->
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label class="mb-2" for="name">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}"
                            placeholder="Enter a Role Name">
                    </div>

                    <div class="d-flex flex-column my-5 fv-row">
                        <label class="mb-2" for="name">Permissions</label>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkPermissionAll">
                            <label class="form-check-label" for="checkPermissionAll">All</label>
                        </div>
                        <hr>
                        @php $i = 1; @endphp
                        @foreach ($permission_groups as $group)
                            <div class="d-flex flex-row flex-wrap">
                                @php
                                $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                $j = 1;
                                @endphp

                                <div class="w-150px">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                                    </div>
                                </div>

                                <div class="role-{{ $i }}-management-checkbox">
                                    @foreach ($permissions as $permission)
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                            <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->alter_name }}</label>
                                        </div>
                                        @php $j++; @endphp
                                    @endforeach
                                    <br>
                                </div>
                            </div>
                        @php $i++; @endphp
                        @endforeach
                    </div>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary mt-4 pr-4 pl-4 me-2">Back</a>
                    <button type="submit" class="btn btn-success mt-4 pr-4 pl-4">Update</button>
                </form>
                <!--end::Table container-->
            </div>
        </div>
    </div>
    <!-- data table end -->
</div>
@endsection

@section('js')
@include('admin.roles.partials.scripts')
@endsection