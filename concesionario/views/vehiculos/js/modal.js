let modalForm = document.getElementById("modalForm");
let btnAddNew = document.getElementById("btnAddNew");
let spanClose = document.getElementById("close");
let btnDelete = document.querySelectorAll('.btnDelete');
let btnEdit = document.querySelectorAll('.btnEdit');

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
                                <label><strong>Imagen:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="text" name="txt_imagen" id="txt_imagen" class="form-control" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Transmisión:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="number" name="txt_idtipotransmicionvehiculo" id="txt_idtipotransmicionvehiculo" class="form-control" required>
                                    <option disabled selected>--Seleccione una transmisión--</option>
                                    <option value="1">Manual</option>
                                    <option value="2">Automática</option>
                                    <option value="3">Continuamente variable</option>
                                    <option value="4">Doble embrague</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Tipo:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="number" name="txt_idtipovehiculo" id="txt_idtipovehiculo" class="form-control" required>
                                    <option disabled selected>--Seleccione un tipo de vehículo--</option>
                                    <option value="1">Monovolumen</option>
                                    <option value="2">Dos volúmenes</option>
                                    <option value="3">Dos volúmenes y medio</option>
                                    <option value="4">Tres volúmenes</option>
                                    <option value="5">Berlina</option>
                                    <option value="6">Sedán</option>
                                    <option value="7">Cupé</option>
                                    <option value="8">Hatchback</option>
                                    <option value="9">Descapotable</option>
                                    <option value="10">Roadster</option>
                                    <option value="11">Familiar</option>
                                    <option value="12">Todoterreno</option>
                                    <option value="13">Crossover</option>
                                    <option value="14">Deportivo</option>
                                    <option value="15">Camioneta</option>
                                    <option value="16">Pick-up</option>
                                    <option value="17">Hardtop</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Marca:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="number" name="txt_idmarcavehiculo" id="txt_idmarcavehiculo" class="form-control" required>
                                    <option disabled selected>--Seleccione una marca--</option>
                                    <option value="1">Aston Martin</option>
                                    <option value="2">Fiat</option>
                                    <option value="3">Ferrari</option>
                                    <option value="4">Ford</option>
                                    <option value="5">Chevrolet</option>
                                    <option value="6">Honda</option>
                                    <option value="7">Mazda</option>
                                    <option value="8">Renault</option>
                                    <option value="9">Toyota</option>
                                    <option value="10">Subaru</option>
                                    <option value="11">Hyundai</option>
                                    <option value="12">Mclaren</option>
                                    <option value="13">Volkswagen</option>
                                    <option value="14">Land Rover</option>
                                    <option value="15">Kia</option>
                                    <option value="16">Nissan</option>
                                    <option value="17">Porsche</option>
                                    <option value="18">Mercedes Benz</option>
                                    <option value="19">Dodge</option>
                                    <option value="20">Jeep</option>
                                    <option value="21">Bentley</option>
                                    <option value="22">Chrysler</option>
                                    <option value="23">Cadillac</option>
                                    <option value="24">Mitsubishi</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Estado:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="text" name="txt_idestadovehiculo" id="txt_idestadovehiculo" class="form-control" required>
                                    <option disabled selected>--Seleccione un estado--</option>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
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
    let formVehiculos = document.querySelectorAll('.formVehiculos');
    formVehiculos.forEach($form => {
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
        let idVehiculos = 0;
        if(idTrClass.length > 0){
            idTrClass.forEach($tr => {
                let id = $tr.id.split('_')[1];
                idVehiculos = parseInt(id)+1;
            });
        }
        else{
            idVehiculos = 1;
        }

        let txtDescripcion = document.getElementById('txt_descripcion');
        let txtPrecio = document.getElementById('txt_precio');
        let txtImagen = document.getElementById('txt_imagen');
        let txtTransmicion = document.getElementById('txt_idtipotransmicionvehiculo');
        let txtTipo = document.getElementById('txt_idtipovehiculo');
        let txtMarca = document.getElementById('txt_idmarcavehiculo');
        let txtEstado = document.getElementById('txt_idestadovehiculo');

        window.location.href="../../controllers/vehiculos/insertVehiculo.php?id="+idVehiculos+"&descripcion="+txtDescripcion.value+"&precio="+txtPrecio.value+"&imagen="+txtImagen.value+"&idtipotransmicionvehiculo="+txtTransmicion.value+"&idtipovehiculo="+txtTipo.value+"&idmarcavehiculo="+txtMarca.value+"&idestadovehiculo="+txtEstado.value+"&update=N";
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
        window.location.href="../../controllers/vehiculos/deleteVehiculo.php?id="+id;
    });
});

btnEdit.forEach($btn => {
    $btn.addEventListener('click',() => {
        modalForm.style.display = "block";
        let id = $btn.id.split('_')[1];
        let description = document.getElementById(`DESCRIPCION_${id}`).textContent;
        let price = document.getElementById(`PRECIO_${id}`).textContent;
        let image = document.getElementById(`IMAGEN_${id}`).textContent;
        let transmission = document.getElementById(`TRANSMICION_${id}`).textContent;
        let typeVehicle = document.getElementById(`TIPO_${id}`).textContent;
        let brand = document.getElementById(`MARCA_${id}`).textContent;
        let state = document.getElementById(`ESTADO_${id}`).textContent;

        let modalBody = document.getElementById('modalBody');
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
                                    <label><strong>Imagen:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <input type="text" name="txt_imagen" id="txt_imagen" class="form-control" required value="${image}">
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Transmisión:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <select type="number" name="txt_idtipotransmicionvehiculo" id="txt_idtipotransmicionvehiculo" class="form-control" required value="${transmission}">
                                        <option disabled selected>--Seleccione una transmisión--</option>
                                        <option value="1">Manual</option>
                                        <option value="2">Automática</option>
                                        <option value="3">Continuamente variable</option>
                                        <option value="4">Doble embrague</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Tipo:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <select type="number" name="txt_idtipovehiculo" id="txt_idtipovehiculo" class="form-control" required value="${typeVehicle}">
                                        <option disabled selected>--Seleccione un tipo de vehículo--</option>
                                        <option value="1">Monovolumen</option>
                                        <option value="2">Dos volúmenes</option>
                                        <option value="3">Dos volúmenes y medio</option>
                                        <option value="4">Tres volúmenes</option>
                                        <option value="5">Berlina</option>
                                        <option value="6">Sedán</option>
                                        <option value="7">Cupé</option>
                                        <option value="8">Hatchback</option>
                                        <option value="9">Descapotable</option>
                                        <option value="10">Roadster</option>
                                        <option value="11">Familiar</option>
                                        <option value="12">Todoterreno</option>
                                        <option value="13">Crossover</option>
                                        <option value="14">Deportivo</option>
                                        <option value="15">Camioneta</option>
                                        <option value="16">Pick-up</option>
                                        <option value="17">Hardtop</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Marca:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <select type="number" name="txt_idmarcavehiculo" id="txt_idmarcavehiculo" class="form-control" required value="${brand}">
                                        <option disabled selected>--Seleccione una marca--</option>
                                        <option value="1">Aston Martin</option>
                                        <option value="2">Fiat</option>
                                        <option value="3">Ferrari</option>
                                        <option value="4">Ford</option>
                                        <option value="5">Chevrolet</option>
                                        <option value="6">Honda</option>
                                        <option value="7">Mazda</option>
                                        <option value="8">Renault</option>
                                        <option value="9">Toyota</option>
                                        <option value="10">Subaru</option>
                                        <option value="11">Hyundai</option>
                                        <option value="12">Mclaren</option>
                                        <option value="13">Volkswagen</option>
                                        <option value="14">Land Rover</option>
                                        <option value="15">Kia</option>
                                        <option value="16">Nissan</option>
                                        <option value="17">Porsche</option>
                                        <option value="18">Mercedes Benz</option>
                                        <option value="19">Dodge</option>
                                        <option value="20">Jeep</option>
                                        <option value="21">Bentley</option>
                                        <option value="22">Chrysler</option>
                                        <option value="23">Cadillac</option>
                                        <option value="24">Mitsubishi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <label><strong>Estado:</strong></label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                    <select type="text" name="txt_idestadovehiculo" id="txt_idestadovehiculo" class="form-control" required value="${state}">
                                        <option disabled selected>--Seleccione un estado--</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
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
        let formVehiculos = document.querySelectorAll('.formVehiculos');
        formVehiculos.forEach($form => {
            $form.remove();
        });
        let headerForm = document.querySelectorAll('.headerForm');
        headerForm.forEach($form => {
            $form.remove();
        });
        modalBody.insertAdjacentHTML('afterbegin',template);
        
        let btnSaveRegister = document.getElementById('btnSaveRegister');
        btnSaveRegister.addEventListener('click',()=> {
            let txtDescripcion = document.getElementById('txt_descripcion');
            let txtPrecio = document.getElementById('txt_precio');
            let txtImagen = document.getElementById('txt_imagen');
            let txtTransmicion = document.getElementById('txt_idtipotransmicionvehiculo');
            let txtTipo = document.getElementById('txt_idtipovehiculo');
            let txtMarca = document.getElementById('txt_idmarcavehiculo');
            let txtEstado = document.getElementById('txt_idestadovehiculo');
            window.location.href="../../controllers/vehiculos/insertVehiculo.php?id="+id+"&descripcion="+txtDescripcion.value+"&precio="+txtPrecio.value+"&imagen="+txtImagen.value+"&idtipotransmicionvehiculo="+txtTransmicion.value+"&idtipovehiculo="+txtTipo.value+"&idmarcavehiculo="+txtMarca.value+"&idestadovehiculo="+txtEstado.value+"&update=Y";
        });        
    });
});