let modalForm = document.getElementById("modalForm");
let btnAddNew = document.getElementById("btnAddNew");
let spanClose = document.getElementById("close");

btnAddNew.onclick = function() {
    modalForm.style.display = "block";
    let modalBody = document.getElementById('modalBody');
    let template = `<div id="formSucursales" class="formSucursales">
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

    modalBody.insertAdjacentHTML('afterbegin',template);
    
        let btnSaveRegister = document.getElementById('btnSaveRegister');
        btnSaveRegister.addEventListener('click',()=>{
            let idTrClass = document.querySelectorAll('.idTrClass');
            let idSucursal = idTrClass.length+1;
            let txtDescripcion = document.getElementById('txt_descripcion');
            let txtDireccion = document.getElementById('txt_direccion');
            let txtMunicipio = document.getElementById('txt_municipio');
            let txtDepartamento = document.getElementById('txt_departamento');
            window.location.href="../../controllers/sucursales/insertSucursal.php?id="+idSucursal+"&descripcion="+txtDescripcion.value+"&direccion="+txtDireccion.value+"&municipio="+txtMunicipio.value+"&departamento="+txtDepartamento.value;
        });
}

spanClose.onclick = function() {
    modalForm.style.display = "none";
    let formSucursales = document.querySelectorAll('.formSucursales');
    formSucursales.forEach($form => {
        $form.remove();
    });
}

window.onclick = function(event) {
    if(event.target == modalForm){
        modalForm.style.display = "none";
    }
}