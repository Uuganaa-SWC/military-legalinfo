@extends('home')
@section("content")
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <div class="container">
        <h3><center>Цэргийн дүрэм</center></h3></br>
        <table id="dvrem" class="table-primary table-bordered data-table border-primary" style="width: 100%; ">
            <thead>
                <tr>
                    <th style="text-align:center">№</th>
                    <th style="text-align:center">Дүрэмүүд</th>
                    <th style="text-align:center">Бүлэг</th>
                    <th style="text-align:center" hidden>Өгөгдөл</th>
                </tr>
            </thead>
            <tbody>
                    <th style="text-align:center" hidden>Өгөгдөл</th>
                </tr>
            </thead>
            <tbody >

            </tbody>
        </table>
        <div><center></br>
            <a href="{{url("/new/dvrem")}}" id="Target" type="button" class="btn btn-outline-success" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px">Нэмэх</a>
            <a  id="btnEdit" type="button" class="btn btn-outline-warning" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px">Засах</a>
            <button id="delete" type="button" class="btn btn-outline-danger" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px">Устгах</button>
        </div>
    </div></br>

    @endsection
    @section("js")
<script>
    var dataRow = "";
    var csrf = "{{ csrf_token() }}";
    var getTable = "{{url('/show/dvrem')}}"
    var medeeDelete = "{{url('/dvrem/delete')}}"
    var urlAtag = "{{url('/dvrem/edit/')}}";
</script>
<script src="{{url("tsergiinDvrem/dvrem_oruulax.js")}}"></script>
<script src="{{url("tsergiinDvrem/tsergiinDvrem.js")}}"></script>
<script src="{{url("tsergiinDvrem/dvrem_ustgax.js")}}"></script>
<script src="{{url("tsergiinDvrem/dvrem_zasax.js")}}"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
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
