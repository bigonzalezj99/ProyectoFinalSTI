let inputDataForm = document.querySelectorAll('.inputDataForm');

let btnEditData = document.getElementById('btnEditData');
let btnDeleteAccount = document.getElementById('btnDeleteAccount');

let modalForm = document.getElementById("modalForm");
let spanClose = document.getElementById("close");

inputDataForm.forEach($input=>{
    $input.addEventListener('change',()=>{
        btnEditData.removeAttribute('disabled');
    });
});

spanClose.onclick = function() {
    modalForm.style.display = "none";
    let formMyProfile = document.querySelectorAll('.formMyProfile');
    formMyProfile.forEach($form => {
        $form.remove();
    });
    let headerForm = document.querySelectorAll('.headerForm');
    headerForm.forEach($form => {
        $form.remove();
    });
}

btnEditData.onclick = function() {
    modalForm.style.display = "block";
    let modalBody = document.getElementById('modalBody');
    let template = `<div id="headerForm" class="headerForm">EDITAR REGISTRO</div>
                    <div id="formMyProfile" class="formMyProfile">
                        <strong style='text-align: center;'>
                            <p>
                                <i class="fa fa-warning fa-2x" aria-hidden="true" style='color: #b1b113;'></i>
                                ¿Está seguro de cambiar sus datos?
                                <i class="fa fa-warning fa-2x" aria-hidden="true" style='color: #b1b113;'></i>
                            </p>
                        </strong>
                        <br><br>
                        <div style="text-align: center; margin-top: 2%;">
                            <button id="btnSaveRegister" class="btn btn-primary">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                Guardar
                            </button>
                        </div>
                    </div>`;

    let formMyProfile = document.querySelectorAll('.formMyProfile');
    formMyProfile.forEach($form => {
        $form.remove();
    });

    let headerForm = document.querySelectorAll('.headerForm');
    headerForm.forEach($form => {
        $form.remove();
    });

    modalBody.insertAdjacentHTML('afterbegin',template);

    let btnSaveRegister = document.getElementById('btnSaveRegister');
    btnSaveRegister.addEventListener('click',()=>{
        let tableInfo = document.querySelector('.tableInfo');
        let idSession = tableInfo.id.split('_')[1];
        
        let inputEmail = document.getElementById("EMAIL").value;
        let inputPassword = document.getElementById("PASSWORD").value;
        let inputNombres = document.getElementById("NOMBRES").value;
        let inputApellidos = document.getElementById("APELLIDOS").value;
        let inputDireccion = document.getElementById("DIRECCION").value;
        let inputNit = document.getElementById("NIT").value;
        let inputTelefono = document.getElementById("TELEFONO").value;
        
        window.location.href="../../controllers/micuenta/editAccount.php?id="+idSession+"&email="+inputEmail+"&pass="+inputPassword+"&name="+inputNombres+"&surname="+inputApellidos+"&direction="+inputDireccion+"&nit="+inputNit+"&phone="+inputTelefono;
    });
}

btnDeleteAccount.onclick = function() {
    modalForm.style.display = "block";
    let modalBody = document.getElementById('modalBody');
    let template = `<div id="headerForm" class="headerForm">ELIMINAR CUENTA</div>
                    <div id="formMyProfile" class="formMyProfile">
                        <strong style='text-align: center;'>
                            <p>
                                <i class="fa fa-warning fa-2x" aria-hidden="true" style='color: #ff0000;'></i>
                                ¿Está seguro de eliminar su cuenta? Esto no se puede revertir
                                <i class="fa fa-warning fa-2x" aria-hidden="true" style='color: #ff0000;'></i>
                            </p>
                        </strong>
                        <br><br>
                        <div style="text-align: center; margin-top: 2%;">
                            <button id="btnConfirmDelete" class="btn btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                Eliminar
                            </button>
                        </div>
                    </div>`;

    let formMyProfile = document.querySelectorAll('.formMyProfile');
    formMyProfile.forEach($form => {
        $form.remove();
    });

    let headerForm = document.querySelectorAll('.headerForm');
    headerForm.forEach($form => {
        $form.remove();
    });

    modalBody.insertAdjacentHTML('afterbegin',template);

    let btnConfirmDelete = document.getElementById('btnConfirmDelete');
    btnConfirmDelete.addEventListener('click',()=>{
        let tableInfo = document.querySelector('.tableInfo');
        let idSession = tableInfo.id.split('_')[1];
        window.location.href="../../controllers/micuenta/deleteAccount.php?id="+idSession;
    });
}