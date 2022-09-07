let modalForm = document.getElementById("modalForm");
let btnAddNew = document.getElementById("btnAddNew");
let spanClose = document.getElementById("close");
let btnDelete = document.querySelectorAll('.btnDelete');
let btnEdit = document.querySelectorAll('.btnEdit');

btnAddNew.onclick = function() {
    modalForm.style.display = "block";
    let modalBody = document.getElementById('modalBody');
    let template = `<div id="headerForm" class="headerForm">NUEVO REGISTRO</div>
                    <div id="formRepuestos" class="formRepuestos">
                        
                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Descripción:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" required>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Precio:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="text" name="txt_precio" id="txt_precio" class="form-control" required>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Unidades:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="text" name="txt_unidades" id="txt_unidades" class="form-control" required>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 2%;">
                            <button id="btnSaveRegister" class="btn btn-primary">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                Guardar
                            </button>
                        </div>
                    </div>`;
    let formRepuestos = document.querySelectorAll('.formRepuestos');
    formRepuestos.forEach($form => {
        $form.remove();
    });
    let headerForm = document.querySelectorAll('.headerForm');
    headerForm.forEach($form => {
        $form.remove();
    });

    modalBody.insertAdjacentHTML('afterbegin',template);

    let btnSaveRegister = document.getElementById('btnSaveRegister');
    btnSaveRegister.addEventListener('click',()=>{
        let idTrClass = document.querySelectorAll('.idTrClass');
        let idRepuesto = 0;
        if(idTrClass.length > 0){
            idTrClass.forEach($tr => {
                let id = $tr.id.split('_')[1];
                idRepuesto = parseInt(id)+1;
            });
        }
        else{
            idRepuesto = 1;
        }

        let txtDescripcion = document.getElementById('txt_descripcion');
        let txtPrecio = document.getElementById('txt_precio');
        let txtUnidades = document.getElementById('txt_unidades');
        window.location.href="../../controllers/repuestos/insertRepuesto.php?id="+idRepuesto+"&descripcion="+txtDescripcion.value+"&precio="+txtPrecio.value+"&unidades="+txtUnidades.value+"&update=N";
    });
}

spanClose.onclick = function() {
    modalForm.style.display = "none";
    let formRepuestos = document.querySelectorAll('.formRepuestos');
    formRepuestos.forEach($form => {
        $form.remove();
    });
    let headerForm = document.querySelectorAll('.headerForm');
    headerForm.forEach($form => {
        $form.remove();
    });
}

window.onclick = function(event) {
    if(event.target == modalForm){
        modalForm.style.display = "none";
    }
}

btnDelete.forEach($btn => {
    $btn.addEventListener('click',() => {
        let id = $btn.id.split('_')[1];
        window.location.href="../../controllers/repuestos/deleteRepuesto.php?id="+id;
    });
});

btnEdit.forEach($btn => {
    $btn.addEventListener('click',() => {
        modalForm.style.display = "block";
        let id = $btn.id.split('_')[1];
        let description = document.getElementById(`DESCRIPCION_${id}`).textContent;
        let price = document.getElementById(`PRECIO_${id}`).textContent;
        let units = document.getElementById(`UNIDADES_${id}`).textContent;
        let modalBody = document.getElementById('modalBody');
        let template = `<div id="headerForm" class="headerForm">EDITAR REGISTRO</div>

                        <div id="formRepuestos" class="formRepuestos">
                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Descripción:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" required value="${description}">
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Precio:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="text" name="txt_precio" id="txt_precio" class="form-control" required value="${price}">
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Unidades:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="text" name="txt_unidades" id="txt_unidades" class="form-control" required value="${units}">
                                </div>
                            </div>

                            <div style="text-align: center; margin-top: 2%;">
                                <button id="btnSaveRegister" class="btn btn-primary">
                                    <i class="fa fa-save" aria-hidden="true"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>`;
        let formRepuestos = document.querySelectorAll('.formRepuestos');
        formRepuestos.forEach($form => {
            $form.remove();
        });
        let headerForm = document.querySelectorAll('.headerForm');
        headerForm.forEach($form => {
            $form.remove();
        });
        modalBody.insertAdjacentHTML('afterbegin',template);
        
        let btnSaveRegister = document.getElementById('btnSaveRegister');
        btnSaveRegister.addEventListener('click',()=>{
            let txtDescripcion = document.getElementById('txt_descripcion');
            let txtPrecio = document.getElementById('txt_precio');
            let txtUnidades = document.getElementById('txt_unidades');
            window.location.href="../../controllers/repuestos/insertRepuesto.php?id="+id+"&descripcion="+txtDescripcion.value+"&precio="+txtPrecio.value+"&unidades="+txtUnidades.value+"&update=Y";
        });        
    });
});