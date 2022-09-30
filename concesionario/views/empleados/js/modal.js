let modalForm = document.getElementById("modalForm");
let btnAddNew = document.getElementById("btnAddNew");
let spanClose = document.getElementById("close");
let btnDelete = document.querySelectorAll('.btnDelete');
let btnEdit = document.querySelectorAll('.btnEdit');

btnAddNew.onclick = function() {
    modalForm.style.display = "block";
    let modalBody = document.getElementById('modalBody');
    let template = `<div id="headerForm" class="headerForm">NUEVO REGISTRO</div>
                    <div id="formEmpleados" class="formEmpleados">
                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Nombres:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Apellidos:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Dirección:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>DPI:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="number" name="txt_dpi" id="txt_dpi" class="form-control" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Teléfono:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Usuario:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="number" name="txt_idusuario" id="txt_idusuario" class="form-control" required>
                                    <option disabled selected>Seleccione una opción</option>
                                    ${templateUsuarios}
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Cargo:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="number" name="txt_idcargo" id="txt_idcargo" class="form-control" required>
                                    <option disabled selected>Seleccione una opción</option>
                                    ${templateCargos}
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Total vendido:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="number" name="txt_totalventas" id="txt_totalventas" class="form-control" required>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 2%;">
                            <button id="btnSaveRegister" class="btn btn-primary">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                Guardar
                            </button>
                        </div>
                    </div>`;
    let formEmpleados = document.querySelectorAll('.formEmpleados');
    formEmpleados.forEach($form => {
        $form.remove();
    });
    let headerForm = document.querySelectorAll('.headerForm');
    headerForm.forEach($form => {
        $form.remove();
    });
    modalBody.insertAdjacentHTML('afterbegin',template);

    let btnSaveRegister = document.getElementById('btnSaveRegister');

    btnSaveRegister.addEventListener('click',() => {
        let idTrClass = document.querySelectorAll('.idTrClass');
        let idEmpleado = 0;

        if (idTrClass.length > 0) {
            idTrClass.forEach($tr => {
                let id = $tr.id.split('_')[1];
                if( parseInt(id) > parseInt(idEmpleado) ){
                    idEmpleado = parseInt(id);
                }
            });
            idEmpleado++;
        } else {
            idEmpleado = 1;
        }

        let txtNombres = document.getElementById('txt_nombres');
        let txtApellidos = document.getElementById('txt_apellidos');
        let txtDireccion = document.getElementById('txt_direccion');
        let txtDpi = document.getElementById('txt_dpi');
        let txtTelefono = document.getElementById('txt_telefono');
        let txtIdUsuario = document.getElementById('txt_idusuario');
        let txtIdCargo = document.getElementById('txt_idcargo');
        let txtTotalVentas = document.getElementById('txt_totalventas');

        window.location.href="../../controllers/empleados/insertEmpleado.php?id="+idEmpleado+"&nombres="+txtNombres.value+"&apellidos="+txtApellidos.value+"&direccion="+txtDireccion.value+"&dpi="+txtDpi.value+"&telefono="+txtTelefono.value+"&idusuario="+txtIdUsuario.value+"&idcargo="+txtIdCargo.value+"&totalventas="+txtTotalVentas.value+"&update=N";
    });
}

spanClose.onclick = function() {
    modalForm.style.display = "none";
    let formEmpleados = document.querySelectorAll('.formEmpleados');
    formEmpleados.forEach($form => {
        $form.remove();
    });

    let headerForm = document.querySelectorAll('.headerForm');
    headerForm.forEach($form => {
        $form.remove();
    });
}

window.onclick = function(event) {
    if (event.target == modalForm) {
        modalForm.style.display = "none";
    }
}

btnDelete.forEach($btn => {
    $btn.addEventListener('click',() => {
        let id = $btn.id.split('_')[1];

        window.location.href="../../controllers/empleados/deleteEmpleado.php?id="+id;
    });
});

btnEdit.forEach($btn => {
    $btn.addEventListener('click',() => {
        modalForm.style.display = "block";
        let id = $btn.id.split('_')[1];
        let nombres = document.getElementById(`NOMBRES_${id}`).textContent;
        let apellidos = document.getElementById(`APELLIDOS_${id}`).textContent;
        let direccion = document.getElementById(`DIRECCION_${id}`).textContent;
        let dpi = document.getElementById(`DPI_${id}`).textContent;
        let telefono = document.getElementById(`TELEFONO_${id}`).textContent;
        let totalVentas = document.getElementById(`TOTALVENTAS_${id}`).textContent;

        let modalBody = document.getElementById('modalBody');
        let template = `<div id="headerForm" class="headerForm">EDITAR REGISTRO</div>
                        <div id="formEmpleados" class="formEmpleados">
                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Nombres:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" required value="${nombres}">
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Apellidos:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" required value="${apellidos}">
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Dirección:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" required value="${direccion}">
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>DPI:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="number" name="txt_dpi" id="txt_dpi" class="form-control" required value="${dpi}">
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Teléfono:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" required value="${telefono}">
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Total vendido:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="number" name="txt_totalventas" id="txt_totalventas" class="form-control" required value="${totalVentas}">
                                </div>
                            </div>

                            <div style="text-align: center; margin-top: 2%;">
                                <button id="btnSaveRegister" class="btn btn-primary">
                                    <i class="fa fa-save" aria-hidden="true"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>`;
        let formEmpleados = document.querySelectorAll('.formEmpleados');
        formEmpleados.forEach($form => {
            $form.remove();
        });
        let headerForm = document.querySelectorAll('.headerForm');
        headerForm.forEach($form => {
            $form.remove();
        });
        modalBody.insertAdjacentHTML('afterbegin',template);
        
        let btnSaveRegister = document.getElementById('btnSaveRegister');
        btnSaveRegister.addEventListener('click',() => {
            let txtNombres = document.getElementById('txt_nombres');
            let txtApellidos = document.getElementById('txt_apellidos');
            let txtDireccion = document.getElementById('txt_direccion');
            let txtDpi = document.getElementById('txt_dpi');
            let txtTelefono = document.getElementById('txt_telefono');
            let txtTotalVentas = document.getElementById('txt_totalventas');

            window.location.href="../../controllers/empleados/insertEmpleado.php?id="+id+"&nombres="+txtNombres.value+"&apellidos="+txtApellidos.value+"&direccion="+txtDireccion.value+"&dpi="+txtDpi.value+"&telefono="+txtTelefono.value+"&totalventas="+txtTotalVentas.value+"&update=Y";
        });
    });
});