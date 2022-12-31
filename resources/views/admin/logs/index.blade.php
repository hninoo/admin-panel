@extends('admin.layout.master')

@section('content')
@if (Auth::guard('admin')->user()->can('admins.log'))
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Table Widget 7-->
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Logs</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Description</th>
                                <th scope="col">User ID</th>
                                <th scope="col" data-resizable>Changes</th>
                                <th scope="col">Causer</th>
                                <th scope="col">Created_at</th>

                                {{-- <th scope="col">Action</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $activity)
                            {{-- {{ dd($activity) }} --}}
                            {{-- {{ dd($activity->properties)}} --}}
                            <tr>
                                <td>{{ $activities->firstItem() + $loop->index }}</td>
                                <td>{{ $activity->description }}</td>
                                @php
                                $user = $activity->subject_type::find($activity->subject_id);
                                $name = $user ? $user->name : 'Unknow(deleted User)'
                                @endphp
                                <td>{{ $activity->subject_id . ' : ' .$name }}</td>
                                <td style="word-wrap: break-word;">{{ $activity->properties }}</td>
                                @if ($activity->causer == '')
                                <td>{{ __("-") }}</td>
                                @else
                                <td>{{ optional(optional($activity)->causer)->name }}</td>
                                @endif
                                <td>{{ $activity->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</div>
@endcan
@endsection
