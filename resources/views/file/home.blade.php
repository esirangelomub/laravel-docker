@include('inc.header')

<div class="table-title">
    <div class="row">
        <div class="col-sm-8">
            <ol class="breadcrumb">
                <li><a href="/">Directories</a></li>
                <li><a href="/{{$collection->id}}/files">{{$collection->name}}</a></li>
            </ol>
        </div>
        <div class="col-sm-4">
            <a href="{{ url($collection->id . '/create') }}" class="btn btn-outline-danger"><i class="material-icons">&#xe2c7;</i> <span>Add Directory</span></a>
            <a href="{{ url($collection->id . '/files/create') }}" class="btn btn-outline-danger"><i class="material-icons">&#xe873;</i> <span>Add File</span></a>
        </div>
    </div>
</div>

<div class="table-search">
    <form method="POST" action="{{ url($collection->id . '/files/search') }}">
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

<div class="row">
    <div class="col-md-12 text-right">
        <h5>Total directories: {{count($collection->parent_directories)}}</h5>
        <h5>Total files: {{count($collection->files)}}</h5>
    </div>
</div>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th></th>
        <th>Directory/File</th>
        <th>Path</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($collection->parent_directories) > 0)
        @foreach($collection->parent_directories->all() as $directory)
            <tr>

                <td><i class="material-icons" data-toggle="tooltip" title="Directories">&#xe2c7;</i></td>
                <td>{{ $directory->name }}</td>
                <td>{{ $directory->path }}</td>
                <td class="text-center">
                    <a href='{{ url("{$directory->id}/files") }}' class="read"><i class="material-icons" data-toggle="tooltip" title="Directories/Files">&#xe0ee;</i></a>
                    <a href='{{ url("{$directory->id}/edit") }}' class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xe745;</i></a>
                    <a href='{{ url("{$directory->id}/delete") }}' class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                </td>
            </tr>
        @endforeach
    @endif

    @if(count($collection->files) > 0)
        @foreach($collection->files->all() as $file)
            <tr>

                <td><i class="material-icons" data-toggle="tooltip" title="Files">&#xe873;</i></td>
                <td>{{ $file->name }} ({{ $file->file_size }} Mb)</td>
                <td>{{ $file->path }}</td>
                <td class="text-center">
                    <a href='{{ url("{$file->directories_id}/files/{$file->id}/edit") }}' class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xe745;</i></a>
                    <a href='{{ url("{$file->directories_id}/files/{$file->id}/delete") }}' class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>
</div>
</div>

@include('inc.footer')
