@extends("home")
@section('content')
    <div style="width: 100%">
            <label class=" form-control-label"><b>Дүрэмүүд</b></label>
                <select id="durem"  class="form-control valid" post-url="{{url("/select/durem")}}">
                    <option value="{{$selectedDvrem->id}}">{{$selectedDvrem->bulegNer}}</option>
                    @foreach ($dvrems as $dvrem )
                        <option value="{{$dvrem->id}}">{{$dvrem->bulegNer}}</option>
                    @endforeach
                </select>
            <label class=" form-control-label"><b>Бүлэг</b></label>
                <select id="buleg" class="form-control valid">
                    <option value="{{$selectedBuleg->bulegID}}">{!!$selectedBuleg->name!!}</option>
                    @foreach ( $bulegs as $buleg )
                        <option value="{{$buleg->bulegID}}">{{$buleg->name}}</option>
                    @endforeach
                </select>
        <div class="form-group">
            <label for="name" class=" form-control-label"><b>Өгөгдөл</b></label>
            <textarea id="my-editor" name="body" class="form-control">{!!$androidData->mainInfo!!}</textarea>
        </div>
        <div style="margin-top: 30px">
            <input id="editStoreDurem" type="button" post-url="{{url("/durem/editStore")}}" class="btn btn-outline-success" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px" value="Хадгалах"/>
            <a href="{{url("/show/soldier")}}" type="button" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px" class="btn btn-outline-danger float-right">Буцах</a>
        </div>
    </div>
@endsection



@section('js')
<script>
    var ID = {{$ID}}
    console.log(ID);
</script>
<script src="{{url("tsergiinDvrem/dvrem_zasax.js")}}"></script>
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
