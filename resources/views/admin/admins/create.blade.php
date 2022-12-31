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
                        <h3 class="fw-bolder text-dark">Create Admin</h3>
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

                    <form action="{{ route('admins.store') }}" method="POST">
                        @csrf
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="mb-2" for="name">Name</label>
                            <input class="form-control form-control-solid" id="name" name="name" placeholder="Enter Name" value="" />
                        </div>

                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="mb-2" for="username">Username</label>
                            <input type="text" class="form-control form-control-solid" id="username" name="username" placeholder="Enter Username" required value="">
                        </div>

                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="mb-2" for="nickname">Nickname</label>
                            <input type="text" class="form-control form-control-solid" id="nickname" name="nickname" placeholder="Enter Nickname" required value="">
                        </div>

                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="mb-2" for='email'>Email</label>
                            <input class="form-control form-control-solid" id="email" name="email" placeholder="Enter Email" value="" />
                        </div>

                        <div class="d-flex flex-column mb-5 fv-row" for="password">
                            <label class="mb-2" id="password">Password</label>
                            <input type="password" class="form-control form-control-solid" id="password" name="password" placeholder="Enter Password">
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row" for="password_confirmation">
                            <label class="mb-2" for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control form-control-solid" id="password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password">
                        </div>

                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="mb-2">
                                <span class="required">Assign Roles</span>
                            </label>
                            <select id="role" name="role" data-placeholder="Select Role..." class="form-select form-select-solid">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
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
