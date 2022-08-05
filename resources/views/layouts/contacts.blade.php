@extends("home")
@section('content')

    <div style="width: 100%">
        <div class="form-group">
            <label for="name" class=" form-control-label"><b>Холбоо барих</b></label>
            <textarea id="my-editor" name="body" class="form-control">{!!$contacts->contactMain!!}</textarea>
        </div>
        <div style="margin-top: 30px">
            <input id="newContact" type="button" post-url="{{url("/edit/contact")}}" class="btn btn-outline-success" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px" value="Хадгалах"/>
            <a href="{{url("/home")}}" type="button" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px" class="btn btn-outline-danger float-right">Буцах</a>
        </div>
    </div>
@endsection



@section('js')
<script>
    var ID = "{{$contacts->id}}";
</script>
<script src="{{url("Instruction/contacts.js")}}"></script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
var options = {
    filebrowserImageBrowseUrl: '{{url('/laravel-filemanager?type=Images')}}',
    filebrowserImageUploadUrl: '{{url('/laravel-filemanager/upload?type=Images&_token=')}}',
    filebrowserBrowseUrl: '{{url('/laravel-filemanager?type=Files')}}',
    filebrowserUploadUrl: '{{url('/laravel-filemanager/upload?type=Files&_token=')}}'
};
var editor = CKEDITOR.replace('my-editor', options);
</script>
@endsection
