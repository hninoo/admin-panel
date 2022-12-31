@extends('admin.layout.log')

@section('content')
<div class="content mt-3">
    <div class="card table table-striped table-bordered dataTable no-footer">
        <div class="card-header {{ $headerClass ?? "" }}">
            <strong class="card-title">Logs</strong>
        </div>
        <div class="card-body p-5">
            <div class="table table-striped table-bordered dataTable no-footer table-responsive">
                <table class="table table-hover">
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
                            <td>{{ $activity->subject_id . ' : ' . App\User::find($activity->subject_id)->name }}</td>
                            <td style="word-wrap: break-word;">{{ $activity->properties }}</td>
                            <td>{{ $activity->causer->name }}</td>
                            <td>{{ $activity->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $users->links() }} --}}
            </div>
            {{ $activities->links() }}
        </div>
    </div>

</div>
@endsection
