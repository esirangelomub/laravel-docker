@include('inc.header')

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

<div class="table-search">
    <form method="POST" action="{{ url('/search') }}">
        {{csrf_field()}}
        <div class="row row-search">
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for..." value="{{$search}}">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Search</button>
                    </span>
                </div>
            </div>
        </div>
    </form>
</div>

@if(session('info'))
    <div class="alert alert-success">
        {{session('info')}}
    </div>
@endif

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th></th>
        <th>Directory</th>
        <th>Path</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($directories) > 0)
        @foreach($directories->all() as $directory)
            <tr>

                <td><i class="material-icons" data-toggle="tooltip" title="Directories/Files">&#xe2c7;</i></td>
                <td>{{ $directory->name }}</td>
                <td>{{ $directory->path }}</td>
                <td>
                    <a href='{{ url("{$directory->id}/files") }}' class="read"><i class="material-icons" data-toggle="tooltip" title="Directories/Files">&#xe0ee;</i></a>
                    <a href='{{ url("{$directory->id}/edit") }}' class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xe745;</i></a>
                    <a href='{{ url("{$directory->id}/delete") }}' class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>
</div>
</div>

@include('inc.footer')
