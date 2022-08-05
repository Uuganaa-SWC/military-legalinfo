@extends('home')

@section('content')
  <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script>
window.jQuery || document.write('<script src="http://mysite.com/jquery.min.js"><\/script>'))
</script>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-4">
            <select class="form-control" name="law" id="cmbLaw"  post-url="{{url('/get/discipline/law/articles')}}">
                <option value="-1">Сонгоно уу</option>
                <option value="1">Төрийн албаны тухай</option>
                <option value="2">Цэргийн албаны тухай</option>
                <option value="3">Төрийн албан хаагчийн ёс зүйн дүрэм</option>
                <option value="4">Зэвсэгт хүчний офицер, ахлагчийн ёс зүйн дүрэм</option>
                <option value="5">Цэргийн алба хаагчдын эрх зүйн байдлын тухай</option>
                <option value="6">Цэргийн алба хаагчдын тэтгэвэр, тэтгэмжийн тухай</option>
                <option value="7">Төрийн цэргийн байгууллагын хөгжлийн стратеги 2030.</option>
                <option value="8">Цэргийн алба хаагчийн хувцас өмсөх дүрэм.</option>
                <option value="9">Цол олгох журам</option>
                <option value="10">Энхийг дэмжих ажиллагаанд оролцуулах журам</option>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" name="parentArticle" id="cmbParentArticle" post-url="{{url("/get/discipline/law/child/articles")}}">
                <option value="-1">Сонгоно уу</option>
            </select>
        </div>
        <div class="col-md-4" id="divChildCombo">
            <select class="form-control" name="parentArticle" id="cmbChildArticle" post-url="{{url("/discipline/load/law")}}">
            </select>
        </div>
    </div>
    <br>
    <div class="form-group col-md-12 text-left">
      <label>Мэдээний агуулга <span class="red-required">*</span> </label>
      <textarea id="myeditor" name="body" class="form-control"></textarea>
    </div>
    <br>
<div class="row">
    <button type="button" name="button" class="btn btn-success" post-url="{{url("/discipline/law/law/new")}}" id="btnNewLaw">Нэмэх</button>
</div>

<script src="{{url('/js/admin/discipline/law/law.js')}}"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '{{url('/laravel-filemanager?type=Images')}}',
    filebrowserImageUploadUrl: '{{url('/laravel-filemanager/upload?type=Images&_token=')}}',
    filebrowserBrowseUrl: '{{url('/laravel-filemanager?type=Files')}}',
    filebrowserUploadUrl: '{{url('/laravel-filemanager/upload?type=Files&_token=')}}'
  };
  var editor = CKEDITOR.replace('myeditor', options);
</script>
@endsection
