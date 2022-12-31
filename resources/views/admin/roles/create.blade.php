<div id="kt_drawer_create" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="chat" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '400px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_create_toggle" data-kt-drawer-close="#kt_drawer_chat_close">
    <!--begin::Messenger-->
    <div class="card w-100 rounded-0 border-0" id="kt_drawer_chat_messenger">
        <!--begin::Card header-->
        <div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
            <!--begin::Title-->
            <div class="card-title">
                <!--begin::User-->
                <div class="d-flex justify-content-center flex-column me-3">
                    <!--begin::Info-->
                    <div class="mb-0 lh-1">
                        <h3 class="fw-bolder text-dark">Create Role</h3>
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::User-->
            </div>
            <!--end::Title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_chat_close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body" id="kt_drawer_chat_messenger_body">
            <div class="row mb-3">
                <!--begin::Col-->
                <div class="col-md-12">
                    <!--begin::Form-->

                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="mb-2" for="name">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter a Role Name">
                        </div>

                        <div class="d-flex flex-column my-5 fv-row">
                            <label class="mb-2" for='email'>Permissions</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                                <label class="form-check-label" for="checkPermissionAll">All</label>
                            </div>
                            <hr>
                            @php $i = 1; @endphp
                            @foreach ($permission_groups as $group)
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input type="checkbox" class="form-check-input" id="{{ $i }}Management"
                                            value="{{ $group->name }}"
                                            onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                        <label class="form-check-label" for="checkPermission">{{ $group->name
                                            }}</label>
                                    </div>
                                </div>

                                <div class="col-8 role-{{ $i }}-management-checkbox">
                                    @php
                                    $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                    $j = 1;
                                    @endphp
                                    @foreach ($permissions as $permission)
                                    <div class="form-check form-check-custom form-check-solid mb-2">
                                        <input type="checkbox" class="form-check-input"
                                            onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})"
                                            name="permissions[]" id="checkPermission{{ $permission->id }}"
                                            value="{{ $permission->name }}">
                                        <label class="form-check-label"
                                            for="checkPermission{{ $permission->id }}">{{ $permission->alter_name }}</label>
                                    </div>
                                    @php $j++; @endphp
                                    @endforeach
                                    <br>
                                </div>

                            </div>
                            @php $i++; @endphp
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-success mt-4 pr-4 pl-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Messenger-->
</div>
