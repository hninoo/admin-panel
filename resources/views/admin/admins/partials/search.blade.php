<!--begin::Filter menu-->
<div class="m-0">
    <!--begin::Menu toggle-->
    <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click"
        data-kt-menu-placement="bottom-end">
        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
        <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path
                    d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                    fill="currentColor" />
            </svg>
        </span>
        <!--end::Svg Icon-->Filter
    </a>
    <!--end::Menu toggle-->
    <!--begin::Menu 1-->
    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_6244763d93048">
        <!--begin::Header-->
        <div class="px-7 py-5">
            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
        </div>
        <!--end::Header-->
        <!--begin::Menu separator-->
        <div class="separator border-gray-200"></div>
        <!--end::Menu separator-->
        <!--begin::Form-->
        <form action="{{ route('admins.index') }}" method="GET">
            <div class="px-7 py-5">
                <div class="mb-10">
                    <div>
                        <select class="form-select form-select-solid" data-kt-select2="true"
                            data-placeholder="Select Role" name="role" data-dropdown-parent="#kt_menu_6244763d93048"
                            data-allow-clear="true">
                            <option value=""></option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-5">
                    <input type="text" name="name" class="form-control form-control-sm form-control-solid"
                        placeholder="Name" value="{{ request('name') }}">
                </div>

                <div class="mb-5">
                    <input type="text" name="email" class="form-control form-control-sm form-control-solid"
                        placeholder="Email" value="{{ request('email') }}">
                </div>

                <!--begin::Actions-->
                <div class="d-flex justify-content-end">
                    <input type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                        data-kt-menu-dismiss="false" value="Reset">
                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                </div>
                <!--end::Actions-->
            </div>
        </form>
        <!--end::Form-->
    </div>
    <!--end::Menu 1-->
</div>
<!--end::Filter menu-->
