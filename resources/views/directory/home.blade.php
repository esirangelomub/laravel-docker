@include('inc.header')


@if(session('info'))
    <div class="alert alert-success">
        {{session('info')}}
    </div>
@endif

<div class="table-title">
    <div class="row">
        <div class="col-sm-6">
            <a href="{{ url('/') }}"><h2>North River Project (Grand Slam Media)</h2>
            </a>
        </div>
        <div class="col-sm-6">
            <a href="{{ url('/create') }}" class="btn btn-outline-danger"><i class="material-icons">&#xE147;</i> <span>Add New Directory</span></a>
        </div>
    </div>
</div>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Directory</th>
        <th>Path</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($directories) > 0)
        @foreach($directories->all() as $directory)
            <tr>

                <td>{{ $directory->id }}</td>
                <td>{{ $directory->name }}</td>
                <td>{{ $directory->path }}</td>
                <td>
                    <a href='{{ url("/files/{$directory->id}") }}' class="read" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Files">&#xE86D;</i></a>

                    <a href='{{ url("/update/{$directory->id}") }}' class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>

                    <a href='{{ url("/delete/{$directory->id}") }}' class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>
</div>
</div>

@include('inc.footer')
