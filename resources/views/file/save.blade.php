@include('inc.header')

<form method="POST" action="{{ url($url) }}">
    @method($method)
    {{csrf_field()}}
    <div class="modal-header">
        <h4 class="modal-title">{{$title}}</h4>
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif
    </div>
    <div class="modal-body">
        @if($method !=  'DELETE')
            <input name="directories_id" type="hidden" value="{{$data['directories_id']}}">
            <div class="form-group">
                <label>File</label>
                <input type="text" name="name" class="form-control" value="{{$data['name']}}">
            </div>
            <div class="form-group">
                <label>Size</label>
                <input type="number" name="file_size" class="form-control" value="{{$data['file_size']}}">
            </div>
            <div class="form-group">
                <label>Path</label>
                <textarea class="form-control" name="path">{{$data['path']}}</textarea>
            </div>
        @else
            <div class="alert alert-danger text-center fw-bold" role="alert">Are you sure you want to delete this record?</div>
        @endif
    </div>
    <div class="modal-footer">
        <a href="{{ url('/') }}" type="button" class="btn btn-default" data-dismiss="modal">Back</a>
        <button class="btn btn-success" type="submit">{{$btn_label}}</button>
    </div>
</form>


@include('inc.footer')
