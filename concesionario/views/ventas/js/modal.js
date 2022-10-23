//let modalForm = document.getElementById("modalForm");
//let btnAddNew = document.getElementById("btnAddNew");
//let spanClose = document.getElementById("close");

btnAddNew.onclick = function() {
    modalForm.style.display = "block";
    let modalBody = document.getElementById('modalBody');
    let template = `<div id="headerForm" class="headerForm">CONFIRMAR VENTA</div>
                    <div id="formVentas" class="formVentas">
                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Fecha:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <input type="date" name="txt_fecha" id="txt_fecha" class="form-control" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <label><strong>Cliente:</strong></label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                                <select type="number" name="txt_idcliente" id="txt_idcliente" class="form-control" required>
                                    <option disabled selected>Seleccione una opción</option>
                                    ${templateCliente}
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
    let formVentas = document.querySelectorAll('.formVentas');
    formVentas.forEach($form => {
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
        let idVenta = 0;

        if (idTrClass.length > 0) {
            idTrClass.forEach($tr => {
                let id = $tr.id.split('_')[1];
                if( parseInt(id) > parseInt(idVenta) ){
                    idVenta = parseInt(id);
                }
            });
            idVenta++;
        } else {
            idVenta = 1;
        }

        let txtFecha = document.getElementById('txt_fecha');
        let txtIdCliente = document.getElementById('txt_idcliente');

        window.location.href="../../controllers/ventas/insertVenta.php?id="+idVenta+"&fecha="+txtFecha.value+"&idcliente="+txtIdCliente.value+"&update=N";
    });
}

spanClose.onclick = function() {
    modalForm.style.display = "none";
    let formVentas = document.querySelectorAll('.formVentas');
    formVentas.forEach($form => {
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