@extends('admin.layout.master')

@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="w-100 px-10">
        <!--begin::Table Widget 7-->
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Roles</span>
                </h3>
                <div class="card-toolbar">
                    @if (Auth::guard('admin')->user()->can('roles.store'))
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    <span id="kt_drawer_create_toggle" class="btn btn-sm btn-light-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor">
                                </rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->New Role
                    </span>
                    @endif
                </div>
            </div>

            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="ps-4 min-w-30px rounded-start">No</th>
                                <th class="min-w-125px">Name</th>
                                <th class="min-w-125px">Permissions</th>
                                <th class="min-w-125px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td class="ps-3">{{ $loop->index+1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $perm)
                                    <span class="badge badge-primary mr-1 mb-1">
                                        {{ $perm->alter_name }}
                                    </span>
                                    @endforeach
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        @if (Auth::guard('admin')->user()->can('roles.edit'))
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-light-info btn-sm px-4 me-1">Edit</a>
                                        @endif

                                        @if (Auth::guard('admin')->user()->can('roles.destroy'))
                                            <button data-id="{{$role->id}}" type="submit" class="btn btn-light-danger btn-sm px-4" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                                                Delete
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                {{ $roles->links() }}
                <!--end::Table container-->
            </div>
        </div>
    </div>
    <!-- data table end -->
</div>

@include('admin.roles.create')
@include('admin.layout.delete', ['route' => 'roles.destroy'])
@endsection

@section('js')
@include('admin.roles.partials.scripts')

<script>
    $('#kt_modal_1').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget)
        var id = button.data('id')
        modal = $(this)
        modal.find('.modal-body #id').val(id)
    })
</script>
@endsection