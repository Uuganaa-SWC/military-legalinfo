<div id="modalNewArticle" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Хуулийн заалт нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form class="" id="frmArticle" action="" method="post">
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Хууль:</label>
                    <div class="col-md-6">
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
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Эцэг заалт:</label>
                    <div class="col-md-6">
                        <select class="form-control" name="parentArticle" id="cmbParentArticle">

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Хуулийн заалтын нэр:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="articleName" id="txtArticleName" value="">
                    </div>
                </div>
              </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="btnPostArticle" post-url="{{url("/discipline/law/articles/new")}}" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
