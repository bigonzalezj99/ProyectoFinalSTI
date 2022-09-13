let modalForm = document.getElementById("modalForm");
let btnAddNew = document.getElementById("btnAddNew");
let spanClose = document.getElementById("close");
let btnDelete = document.querySelectorAll('.btnDelete');
let btnEdit = document.querySelectorAll('.btnEdit');

btnAddNew.onclick = function() {
    modalForm.style.display = "block";
    let modalBody = document.getElementById('modalBody');
    let template = `<div id="headerForm" class="headerForm">NUEVO REGISTRO</div>
                    <div id="formUsuarios" class="formUsuarios">
                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Correo electrónico:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="email" name="txt_email" id="txt_email" class="form-control" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Contraseña:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="password" name="txt_password" id="txt_password" class="form-control" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Rol:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="number" name="txt_idrol" id="txt_idrol" class="form-control" required>
                                    <option disabled selected>--Seleccione un rol--</option>
                                    <option value="1">WebMaster</option>
                                    <option value="2">Administrador</option>
                                    <option value="3">Cliente</option>
                                </select>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 2%;">
                            <button id="btnSaveRegister" class="btn btn-primary">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                Guardar
                            </button>
                        </div>
                    </div>`;
    let formUsuarios = document.querySelectorAll('.formUsuarios');
    formUsuarios.forEach($form => {
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
        let idUsuario = 0;

        if (idTrClass.length > 0) {
            idTrClass.forEach($tr => {
                let id = $tr.id.split('_')[1];
                idUsuario = parseInt(id)+1;
            });
        } else {
            idUsuario = 1;
        }

        let txtEmail = document.getElementById('txt_email');
        let txtPassword = document.getElementById('txt_password');
        let txtIdRol = document.getElementById('txt_idrol');

        window.location.href="../../controllers/usuarios/insertUsuario.php?id="+idUsuario+"&email="+txtEmail.value+"&password="+txtPassword.value+"&idrol="+txtIdRol.value+"&update=N";
    });
}

spanClose.onclick = function() {
    modalForm.style.display = "none";

    let formUsuarios = document.querySelectorAll('.formUsuarios');

    formUsuarios.forEach($form => {
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

        window.location.href="../../controllers/usuarios/deleteUsuario.php?id="+id;
    });
});

btnEdit.forEach($btn => {
    $btn.addEventListener('click',() => {
        modalForm.style.display = "block";

        let id = $btn.id.split('_')[1];
        let email = document.getElementById(`EMAIL_${id}`).textContent;
        let password = document.getElementById(`PASSWORD_${id}`).textContent;
        let idRol = document.getElementById(`ROL_${id}`).textContent;
        let modalBody = document.getElementById('modalBody');

        let template = `<div id="headerForm" class="headerForm">EDITAR REGISTRO</div>
                        <div id="formUsuarios" class="formUsuarios">
                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Correo electrónico:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="email" name="txt_email" id="txt_email" class="form-control" required value="${email}">
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Contraseña:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="password" name="txt_password" id="txt_password" class="form-control" required value="${password}">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Rol:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <select type="number" name="txt_idrol" id="txt_idrol" class="form-control" required value="${idRol}">
                                        <option disabled selected>--Seleccione un rol--</option>
                                        <option value="1">WebMaster</option>
                                        <option value="2">Administrador</option>
                                        <option value="3">Cliente</option>
                                    </select>
                                </div>
                            </div>

                            <div style="text-align: center; margin-top: 2%;">
                                <button id="btnSaveRegister" class="btn btn-primary">
                                    <i class="fa fa-save" aria-hidden="true"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>`;
        let formUsuarios = document.querySelectorAll('.formUsuarios');
        formUsuarios.forEach($form => {
            $form.remove();
        });
        let headerForm = document.querySelectorAll('.headerForm');
        headerForm.forEach($form => {
            $form.remove();
        });
        modalBody.insertAdjacentHTML('afterbegin',template);
        
        let btnSaveRegister = document.getElementById('btnSaveRegister');
        btnSaveRegister.addEventListener('click',() => {
            let txtEmail = document.getElementById('txt_email');
            let txtPassword = document.getElementById('txt_password');
            let txtIdRol = document.getElementById('txt_idrol');

            window.location.href="../../controllers/usuarios/insertUsuario.php?id="+id+"&email="+txtEmail.value+"&password="+txtPassword.value+"&idrol="+txtIdRol.value+"&update=Y";
        });        
    });
});