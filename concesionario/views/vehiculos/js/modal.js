let modalForm = document.getElementById("modalForm");
let btnAddNew = document.getElementById("btnAddNew");
let spanClose = document.getElementById("close");
let btnDelete = document.querySelectorAll('.btnDelete');
let btnEdit = document.querySelectorAll('.btnEdit');

function readImage (input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imgPreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

btnAddNew.onclick = function() {
    modalForm.style.display = "block";
    let modalBody = document.getElementById('modalBody');
    let template = `<div id="headerForm" class="headerForm">NUEVO REGISTRO</div>
                    <div id="formVehiculos" class="formVehiculos">
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
                                <input type="number" name="txt_precio" id="txt_precio" class="form-control" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Transmisión:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="number" name="txt_idtipotransmicionvehiculo" id="txt_idtipotransmicionvehiculo" class="form-control" required>
                                    <option disabled selected>Seleccione una opción</option>
                                    ${templateTransmicion}
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Tipo:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="number" name="txt_idtipovehiculo" id="txt_idtipovehiculo" class="form-control" required>
                                    <option disabled selected>Seleccione una opción</option>
                                    ${templateTipo}
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Marca:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="number" name="txt_idmarcavehiculo" id="txt_idmarcavehiculo" class="form-control" required>
                                    <option disabled selected>Seleccione una opción</option>
                                    ${templateMarca}
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Estado:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="text" name="txt_idestadovehiculo" id="txt_idestadovehiculo" class="form-control" required>
                                    <option disabled selected>Seleccione una opción</option>
                                    ${templateEstado}
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Imagen:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8" style="text-align: center;">
                                <input type="file" name="txt_imagen" id="txt_imagen" class="form-control txt_imagen" required>
                                <br>
                                <img id="imgPreview" src="https://via.placeholder.com/160" alt="Imagen" class="imgPreviewForm" style="margin-right: 20%;"/>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 2%;">
                            <button id="btnSaveRegister" class="btn btn-primary">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                Guardar
                            </button>
                        </div>
                        <form id="formCopyToUploadFile" action="../../controllers/uploadImages.php" method="post" enctype="multipart/form-data" target="_blank" hidden>
                            <input id="btnSubmitImg" type="submit" value="Upload Image" name="submit">
                        </form>
                    </div>`;
    let formVehiculos = document.querySelectorAll('.formVehiculos');
    formVehiculos.forEach($form => {
        $form.remove();
    });
    let headerForm = document.querySelectorAll('.headerForm');
    headerForm.forEach($form => {
        $form.remove();
    });
    modalBody.insertAdjacentHTML('afterbegin',template);

    $("#txt_imagen").change(function () {
        readImage(this);

        let fileToUpload = document.getElementById('fileToUpload');
        if(fileToUpload){
            fileToUpload.remove();
        }

        let real = $("#txt_imagen");
        let cloned = real.clone(true);
        let formCopyToUploadFile = document.getElementById('formCopyToUploadFile');
        formCopyToUploadFile.insertAdjacentElement('afterbegin',cloned[0]);

        let boolFirstPosition = true;
        let txtImagenElements = document.querySelectorAll('.txt_imagen');
        txtImagenElements.forEach($item => {
            if (boolFirstPosition) {
                boolFirstPosition = false;
            } else {
                $item.removeAttribute('id');
                $item.removeAttribute('class');
                $item.removeAttribute('name');
                $item.removeAttribute('required');

                $item.setAttribute('name', 'fileToUpload')
                $item.setAttribute('id', 'fileToUpload')
            }
        });
    });


    let btnSaveRegister = document.getElementById('btnSaveRegister');
    btnSaveRegister.addEventListener('click',()=>{
        let idTrClass = document.querySelectorAll('.idTrClass');
        let idVehiculos = 0;

        if (idTrClass.length > 0) {
            idTrClass.forEach($tr => {
                let id = $tr.id.split('_')[1];
                idVehiculos = parseInt(id)+1;
            });
            idVehiculos++;
        }
        else {
            idVehiculos = 1;
        }

        let txtDescripcion = document.getElementById('txt_descripcion');
        let txtPrecio = document.getElementById('txt_precio');
        let txtTransmicion = document.getElementById('txt_idtipotransmicionvehiculo');
        let txtTipo = document.getElementById('txt_idtipovehiculo');
        let txtMarca = document.getElementById('txt_idmarcavehiculo');
        let txtEstado = document.getElementById('txt_idestadovehiculo');
        let txt_imagen = document.getElementById('txt_imagen');
        let btnSubmitImg = document.getElementById('btnSubmitImg');
        
        btnSubmitImg.click();
        window.location.href="../../controllers/vehiculos/insertVehiculo.php?id="+idVehiculos+"&descripcion="+txtDescripcion.value+"&precio="+txtPrecio.value+"&idtipotransmicionvehiculo="+txtTransmicion.value+"&idtipovehiculo="+txtTipo.value+"&idmarcavehiculo="+txtMarca.value+"&idestadovehiculo="+txtEstado.value+"&imagen="+txt_imagen.value+"&update=N";
    });
}

spanClose.onclick = function() {
    modalForm.style.display = "none";
    let formVehiculos = document.querySelectorAll('.formVehiculos');
    formVehiculos.forEach($form => {
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
        let pathImage = document.getElementById(`tdImgView_${id}`).getAttribute('src');
        window.location.href="../../controllers/vehiculos/deleteVehiculo.php?id="+id+"&pathImage="+pathImage;
    });
});

btnEdit.forEach($btn => {
    $btn.addEventListener('click',() => {
        modalForm.style.display = "block";
        let id = $btn.id.split('_')[1];
        let description = document.getElementById(`DESCRIPCION_${id}`).textContent;
        let price = document.getElementById(`PRECIO_${id}`).textContent;
        let image = document.getElementById(`tdImgView_${id}`).src;
        let transmission = document.getElementById(`TRANSMICION_${id}`).textContent;
        let typeVehicle = document.getElementById(`TIPO_${id}`).textContent;
        let brand = document.getElementById(`MARCA_${id}`).textContent;
        let state = document.getElementById(`ESTADO_${id}`).textContent;
        let modalBody = document.getElementById('modalBody');
        let intIdTransmicion = $btn.className.split('_')[1].split(' ')[0];
        let intIdTipo = $btn.className.split('__')[1].split(' ')[0];
        let intIdMarca = $btn.className.split('___')[1].split(' ')[0];
        let intIdEstado = $btn.className.split('____')[1];

        let template = `<div id="headerForm" class="headerForm">EDITAR REGISTRO</div>
                        <div id="formVehiculos" class="formVehiculos">

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
                                    <input type="number" name="txt_precio" id="txt_precio" class="form-control" required value="${price}">
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Transmisión:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <select type="number" name="txt_idtipotransmicionvehiculo" id="txt_idtipotransmicionvehiculo" class="form-control" required>
                                        <option value="${intIdTransmicion}" disabled selected>${transmission}</option>
                                        ${templateTransmicion}
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Tipo:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <select type="number" name="txt_idtipovehiculo" id="txt_idtipovehiculo" class="form-control" required>
                                        <option value="${intIdTipo}" disabled selected>${typeVehicle}</option>
                                        ${templateTipo}
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Marca:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <select type="number" name="txt_idmarcavehiculo" id="txt_idmarcavehiculo" class="form-control" required>
                                        <option value="${intIdMarca}" disabled selected>${brand}</option>
                                        ${templateMarca}
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Estado:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <select type="text" name="txt_idestadovehiculo" id="txt_idestadovehiculo" class="form-control" required>
                                        <option value="${intIdEstado}" disabled selected>${state}</option>
                                        ${templateEstado}
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Imagen:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8" style="text-align: center;">
                                    <input type="file" name="txt_imagen" id="txt_imagen" class="form-control txt_imagen" required>
                                    <br>
                                    <img id="imgPreview" src="${image}" alt="Imagen" class="imgPreviewForm" style="margin-right: 20%;"/>
                                </div>
                            </div>

                            <div style="text-align: center; margin-top: 2%;">
                                <button id="btnSaveRegister" class="btn btn-primary">
                                    <i class="fa fa-save" aria-hidden="true"></i>
                                    Guardar
                                </button>
                            </div>
                            <form id="formCopyToUploadFile" action="../../controllers/uploadImages.php" method="post" enctype="multipart/form-data" target="_blank" hidden>
                                <input id="btnSubmitImg" type="submit" value="Upload Image" name="submit">
                            </form>
                        </div>`;
        let formVehiculos = document.querySelectorAll('.formVehiculos');
        formVehiculos.forEach($form => {
            $form.remove();
        });
        let headerForm = document.querySelectorAll('.headerForm');
        headerForm.forEach($form => {
            $form.remove();
        });
        modalBody.insertAdjacentHTML('afterbegin',template);

        $("#txt_imagen").change(function () {
            readImage(this);
            
            let fileToUpload = document.getElementById('fileToUpload');
            if(fileToUpload){
                fileToUpload.remove();
            }

            let real = $("#txt_imagen");
            let cloned = real.clone(true);
            let formCopyToUploadFile = document.getElementById('formCopyToUploadFile');
            formCopyToUploadFile.insertAdjacentElement('afterbegin',cloned[0]);
    
            let boolFirstPosition = true;
            let txtImagenElements = document.querySelectorAll('.txt_imagen');
            txtImagenElements.forEach($item => {
                if(boolFirstPosition){
                    boolFirstPosition = false;
                }
                else{
                    $item.removeAttribute('id');
                    $item.removeAttribute('class');
                    $item.removeAttribute('name');
                    $item.removeAttribute('required');
    
                    $item.setAttribute('name', 'fileToUpload')
                    $item.setAttribute('id', 'fileToUpload')
                }
            });
        });
        
        let btnSaveRegister = document.getElementById('btnSaveRegister');
        btnSaveRegister.addEventListener('click',()=> {
            let txtDescripcion = document.getElementById('txt_descripcion');
            let txtPrecio = document.getElementById('txt_precio');
            let txtImagen = document.getElementById('txt_imagen');
            let txtTransmicion = document.getElementById('txt_idtipotransmicionvehiculo').value.split(' ')[0];
            let txtTipo = document.getElementById('txt_idtipovehiculo').value.split(' ')[0];
            let txtMarca = document.getElementById('txt_idmarcavehiculo').value.split(' ')[0];
            let txtEstado = document.getElementById('txt_idestadovehiculo').value.split(' ')[0];
            let btnSubmitImg = document.getElementById('btnSubmitImg');
            let pathImage = document.getElementById(`tdImgView_${id}`).getAttribute('src');
            
            if (txtImagen.value) {
                btnSubmitImg.click();
            }

            window.location.href="../../controllers/vehiculos/insertVehiculo.php?id="+id+"&descripcion="+txtDescripcion.value+"&precio="+txtPrecio.value+"&imagen="+txtImagen.value+"&pathImage="+pathImage+"&idtipotransmicionvehiculo="+txtTransmicion+"&idtipovehiculo="+txtTipo+"&idmarcavehiculo="+txtMarca+"&idestadovehiculo="+txtEstado+"&update=Y";
        });
    });
});