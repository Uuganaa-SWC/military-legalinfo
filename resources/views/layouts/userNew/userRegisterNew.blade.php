<div class="modal fade" id="newUserRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Хэрэглэгч нэмэх</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
                </div>
        <div class="modal-body">
            <div class="form-group">
                <label class=" form-control-label"><b>Утасны дугаар</b></label>
                <input class="form-control" type="number" id="phone_number" placeholder="Утасны дугаар оруулна уу!"/>

                <label class=" form-control-label"><b>Мөнгөн дүн</b></label>
                <input class="form-control" type="number" id="money" placeholder="Мөнгөн дүн оруулна уу!"/>

                <label class=" form-control-label"><b>Нээсэн огноо</b></label>
                <input class="form-control" type="date" id="date" placeholder="Нээсэн огноо оруулна уу!"/>

                {{-- <label class=" form-control-label"><b>Идэвхитэй эсэх</b></label>
                <input class="form-control" type="number" id="isToken" placeholder="Идэвхитэй эсэх оруулна уу!"/> --}}

                <label class=" form-control-label"><b>Тайлбар</b></label>
                <input class="form-control" type="text" id="tailbar" placeholder="Нээсэн огноо оруулна уу!"/>

            <div class="modal-footer">
                <button type="button" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px" post-url="{{url("/new/userRegister")}}" id="btnSaveRule" class="btn btn-success">Хадгалах</button>
                <button type="button" style="border-radius: 50px 0px 50px 0px; padding-left: 50px; padding-right: 50px" class="btn btn-secondary" data-dismiss="modal">Гарах</button>

            </div>
            </div>
        </div>
        </div>
    </div>
</div>
