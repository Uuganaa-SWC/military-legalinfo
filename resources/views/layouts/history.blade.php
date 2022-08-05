@extends('home')
@section("content")
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <div class="container">
        <h3><center>Төлбөрийн түүх</center></h3></br>
        <table id="userHistory" class="table-primary table-bordered data-table border-primary" style="width: 100%; ">
            <thead>
                <tr>
                    <th style="text-align:center">№</th>
                    <th style="text-align:center">Утасны дугаар</th>
                    <th style="text-align:center">Нэхэмжлэлийн дугаар</th>
                    <th style="text-align:center">Нэхэмжлэлийн номер</th>
                    <th style="text-align:center">Төлбөрийн мэдээлэл</th>
                    <th style="text-align:center">Огноо</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div><center></br>
            <button id="historyDelete" type="button" class="btn btn-outline-danger" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px">Устгах</button>
        </div>
    </div></br>


    @endsection
    @section("js")
<script>
    var dataRow = ""
    var csrf = "{{ csrf_token() }}"
    var getTable = "{{url('/show/table/history')}}"
    var historyDelete = "{{url('/userHistory/delete')}}"
</script>
<script src="{{url("userRegister/userHistory.js")}}"></script>
<script src="{{url("userRegister/userHistoryDelete.js")}}"></script>
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
