<div class="modal fade" id="editGroups" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Дүрэм нэмэх</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
                </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="cmbRank" class=" form-control-label"><b>Дүрэм</b></label>

                <option value="" id="durem1"></option>
                <select id="cmbGroup" class="form-control">
                    <option value="-1">Дүрэм сонгох</option>
                        @foreach ($durems as $durem)
                        <option value="{{$durem->id}}">{{$durem->bulegNer}}</option>
                        @endforeach
                    </select>
                <label class=" form-control-label"><b>Бүлэг</b></label>
                <input class="form-control" name="txtRule" id="txtRules" placeholder="Бүлгийн нэршил оруулна уу!"/>
                <div class="modal-footer">
                    <button type="button" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px" post-url="{{url("/group/edit")}}" id="editSaveGroup" class="btn btn-success">Хадгалах</button>
                    <button type="button" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px" class="btn btn-secondary" data-dismiss="modal">Гарах</button>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
