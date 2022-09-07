let modalForm = document.getElementById("modalForm");
let btnAddNew = document.getElementById("btnAddNew");
let spanClose = document.getElementById("close");
let btnDelete = document.querySelectorAll('.btnDelete');
let btnEdit = document.querySelectorAll('.btnEdit');

btnAddNew.onclick = function() {
    modalForm.style.display = "block";
    let modalBody = document.getElementById('modalBody');
    let template = `<div id="headerForm" class="headerForm">NUEVO REGISTRO</div>
                    <div id="formSucursales" class="formSucursales">
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
                                <label><strong>Direccion:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" required>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Municipio:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="text" name="txt_municipio" id="txt_municipio" class="form-control" required>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Departamento:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="text" name="txt_departamento" id="txt_departamento" class="form-control" required>
                            </div>
                        </div>
                        <div style="text-align: center; margin-top: 2%;">
                            <button id="btnSaveRegister" class="btn btn-primary">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                Guardar
                            </button>
                        </div>
                    </div>`;
    let formSucursales = document.querySelectorAll('.formSucursales');
    formSucursales.forEach($form => {
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
        let idSucursal = 0;
        if(idTrClass.length > 0){
            idTrClass.forEach($tr => {
                let id = $tr.id.split('_')[1];
                if( parseInt(id) > parseInt(idSucursal) ){
                    idSucursal = parseInt(id);
                }
            });
            idSucursal++;
        }
        else{
            idSucursal = 1;
        }

        let txtDescripcion = document.getElementById('txt_descripcion');
        let txtDireccion = document.getElementById('txt_direccion');
        let txtMunicipio = document.getElementById('txt_municipio');
        let txtDepartamento = document.getElementById('txt_departamento');
        window.location.href="../../controllers/sucursales/insertSucursal.php?id="+idSucursal+"&descripcion="+txtDescripcion.value+"&direccion="+txtDireccion.value+"&municipio="+txtMunicipio.value+"&departamento="+txtDepartamento.value+"&update=N";
    });
}

spanClose.onclick = function() {
    modalForm.style.display = "none";
    let formSucursales = document.querySelectorAll('.formSucursales');
    formSucursales.forEach($form => {
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
        window.location.href="../../controllers/sucursales/deleteSucursal.php?id="+id;
    });
});

btnEdit.forEach($btn => {
    $btn.addEventListener('click',() => {
        modalForm.style.display = "block";
        let id = $btn.id.split('_')[1];
        let description = document.getElementById(`DESCRIPCION_${id}`).textContent;
        let direction = document.getElementById(`DIRECCION_${id}`).textContent;
        let municipality = document.getElementById(`MUNICIPIO_${id}`).textContent;
        let departament = document.getElementById(`DEPARTAMENTO_${id}`).textContent;
        let modalBody = document.getElementById('modalBody');
        let template = `<div id="headerForm" class="headerForm">EDITAR REGISTRO</div>
                        <div id="formSucursales" class="formSucursales">
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
                                    <label><strong>Direccion:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" required value="${direction}">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Municipio:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="text" name="txt_municipio" id="txt_municipio" class="form-control" required value="${municipality}">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Departamento:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="text" name="txt_departamento" id="txt_departamento" class="form-control" required value="${departament}">
                                </div>
                            </div>
                            <div style="text-align: center; margin-top: 2%;">
                                <button id="btnSaveRegister" class="btn btn-primary">
                                    <i class="fa fa-save" aria-hidden="true"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>`;
        let formSucursales = document.querySelectorAll('.formSucursales');
        formSucursales.forEach($form => {
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
            let txtDireccion = document.getElementById('txt_direccion');
            let txtMunicipio = document.getElementById('txt_municipio');
            let txtDepartamento = document.getElementById('txt_departamento');
            window.location.href="../../controllers/sucursales/insertSucursal.php?id="+id+"&descripcion="+txtDescripcion.value+"&direccion="+txtDireccion.value+"&municipio="+txtMunicipio.value+"&departamento="+txtDepartamento.value+"&update=Y";
        });        
    });
});