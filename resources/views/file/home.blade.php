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
        <th>File</th>
        <th>Size</th>
        <th>Path</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($collection->files) > 0)
        @foreach($collection->files->all() as $file)
            <tr>

                <td>{{ $file->id }}</td>
                <td>{{ $file->name }}</td>
                <td>{{ $file->size }}</td>
                <td>{{ $file->path }}</td>
                <td>
                    <a href='{{ url("/update/{$file->id}") }}' class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href='{{ url("/delete/{$file->id}") }}' class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>
</div>
</div>

@include('inc.footer')
