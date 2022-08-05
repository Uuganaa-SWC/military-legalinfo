@extends("home")
@section('content')
<style>
    .form-inline {
    display: flex;
    flex-flow: row wrap;
    align-items: center;
    }

    .form-inline label {
    margin: 5px 10px 5px 0;
    }

    .form-inline input {
    vertical-align: middle;
    margin: 5px 10px 5px 0;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    }

    .form-inline button {
    padding: 10px 20px;
    border: 1px solid rgb(240, 47, 192);
    border-radius: 5px;
    color: rgb(0, 0, 0);
    cursor: pointer;
    }

    .form-inline button:hover {
    background: linear-gradient(to right, #005B6E, #04668C, #3C6CA7, #AB6BBA, #DA66AC, #FF6792);
    color: #FFF
    }

    @media (max-width: 800px) {
    .form-inline input {
        margin: 100px 0;
    }

    .form-inline {
        flex-direction: column;
        align-items: stretch;
    }
}
</style>
    <div style="width: 100%">
            <label class=" form-control-label"><b>Дүрэмүүд</b></label>
                <select id="durem" class="form-control valid" post-url="{{url("/select/input")}}">
                    <option value="-1">Дүрэм сонгох</option>
                    @foreach ($dvrems as $dvrem )
                        <option value="{{$dvrem->id}}">{{$dvrem->bulegNer}}</option>
                    @endforeach
                </select>
            <label class=" form-control-label"><b>Бүлэг</b></label>
                <select id="buleg" class="form-control valid">
                    <option value="-1">Бүлэг сонгох</option>
                    @foreach ( $bulegs as $buleg )
                        <option value="{{$buleg->id}}">{{$buleg->name}}</option>
                    @endforeach
                </select>
        <div class="form-group">
            <label for="name" class=" form-control-label"><b>Өгөгдөл</b></label>
            <textarea id="my-editor" name="body" class="form-control"></textarea>
        </div>
        <div style="margin-top: 30px">
            <input id="newDvrem" type="button" post-url="{{url("/dvrem/store")}}" class="btn btn-outline-success" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px" value="Хадгалах"/>
            <a href="{{url("/show/soldier")}}" type="button" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px" class="btn btn-outline-danger float-right">Буцах</a>
        </div>
    </div>
@endsection



@section('js')
<script src="{{url("tsergiinDvrem/dvrem_oruulax.js")}}"></script>
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
