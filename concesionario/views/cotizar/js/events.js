let modalForm = document.getElementById("modalForm");
let spanClose = document.getElementById("close");
let btnSearch = document.getElementById("btnSearch");
let btnClear = document.getElementById("btnClear");
let btnView = document.querySelectorAll('.btnView');
let btnSelect = document.querySelectorAll('.btnSelect');
let divToCards = document.getElementById('divToCards');

let btnPrintImage = document.getElementById('btnPrintImage');

btnSearch.addEventListener('click',()=>{
    let txtPrecioDesde = document.getElementById('txt_precioDesde').value;
    let txtPrecioHasta = document.getElementById('txt_precioHasta').value;
    let txtTransmision = document.getElementById('txt_transmision').value;
    let txtTipo = document.getElementById('txt_tipo').value;
    let txtMarca = document.getElementById('txt_marca').value;

    let strParams = "btnP=Y";
    if(txtPrecioDesde){
        strParams += "&pF="+txtPrecioDesde;
    }
    if(txtPrecioHasta){
        strParams += "&pT="+txtPrecioHasta;
    }
    if(txtTransmision !== "0"){
        strParams += "&Tr="+txtTransmision;
    }
    if(txtTipo !== "0"){
        strParams += "&vT="+txtTipo;
    }
    if(txtMarca !== "0"){
        strParams += "&Br="+txtMarca;
    }

    window.location.href="cotizar.php?"+strParams;
});

btnClear.addEventListener('click',()=>{
    window.location.href="cotizar.php";
});

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

btnView.forEach($btn=>{
    $btn.addEventListener('click',()=>{
        modalForm.style.display = "block";
        let id = $btn.id.split('_')[1];
        let image = document.getElementById(`tdImgView_${id}`).src;
        let modalBody = document.getElementById('modalBody');
        let template = `<div id="headerForm" class="headerForm">IMAGEN</div>
                        <div id="formVehiculos" class="formVehiculos" style="text-align: center;">
                            <img id="imgPreview" src="${image}" alt="Imagen" class="imgPreviewEstimate"/>
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
    });
});

btnSelect.forEach($btn=>{
    $btn.addEventListener('click',()=>{
        let idBtn = $btn.id.split('_')[1];
        let divCard = document.getElementById(`divCard_${idBtn}`);
        if(divCard){
            let contPage = document.querySelector('.contPage');
            let templateMessage = `<div id='divMessageSelectSomething' class="divMessageSelectSomething" style='position: absolute; bottom: 5%; right: 2%;'>
                                    <p style='background: #d51e1e; color: #ffffff; border-radius: 10px; padding-left: 10px; padding-right: 10px;'>
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                        Ya se ha agregado este vehículo
                                    </p>
                                </div>`;
            contPage.insertAdjacentHTML('beforeend',templateMessage);
            setTimeout(()=>{
                document.getElementById('divMessageSelectSomething').remove();
            },2000);
        }
        else{
            let contPage = document.querySelector('.contPage');
            let templateMessage = `<div id='divMessageAdded' class="divMessageAdded" style='position: absolute; bottom: 5%; right: 2%;'>
                                    <p style='background: #1ed51e; color: #ffffff; border-radius: 10px; padding-left: 10px; padding-right: 10px;'>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        Se ha agregado exitosamente
                                    </p>
                                </div>`;
            contPage.insertAdjacentHTML('beforeend',templateMessage);

            let id = $btn.id.split('_')[1];
            let description = document.getElementById(`DESCRIPCION_${id}`).textContent;
            let price = document.getElementById(`PRECIO_${id}`).textContent;
            let tramsmition = document.getElementById(`TRANSMICION_${id}`).textContent;
            let type = document.getElementById(`TIPO_${id}`).textContent;
            let brand = document.getElementById(`MARCA_${id}`).textContent;
            let image = document.getElementById(`tdImgView_${id}`).src;
            
            let divToCards = document.getElementById('divToCards');
            let templateCard = `<div id='divCard_${id}' class="col-lg-4 col-md-4 col-sm-6 col-sx-12" style='margin-bottom: 2%;'>
                                    <span id="removeCard_${id}" class="closeModal" style='color: #ffffff; position: relative; right: 7%;'>&times;</span>
                                    <div class="cardEstimate">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <p> <strong>DESCRIPCIÓN:</strong> ${description} </p>
                                            <p> <strong>PRECIO:</strong> ${price} </p>
                                            <p> <strong>TRANSMISIÓN:</strong> ${tramsmition} </p>
                                            <p> <strong>TIPO:</strong> ${type} </p>
                                            <p> <strong>MARCA:</strong> ${brand} </p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <img id="imgPreview" src="${image}" alt="Imagen" class="imgViewCard"/>
                                        </div>
                                    </div>
                                </div>`;
            divToCards.insertAdjacentHTML('afterbegin',templateCard);

            let removeCard = document.getElementById(`removeCard_${id}`);
            removeCard.addEventListener('click',()=>{
                let id = removeCard.id.split('_')[1];
                document.getElementById(`divCard_${id}`).remove();
            });

            setTimeout(()=>{
                document.getElementById('divMessageAdded').remove();
            },1000);
        }
    });
});

new Sortable(divToCards, {
	animation: 150,
	ghostClass: 'blue-background-class'
});

btnPrintImage.addEventListener('click',()=>{
    let cardEstimate = document.querySelectorAll('.cardEstimate');
    if(cardEstimate.length>0){
        let divToCards = document.getElementById('divToCards');
        let tempTitle = `<div id='divTitleToImg' style='margin-bottom: 3%;'>
                            <h2>COTIZACIÓN</h2>
                         </div>`;
        let tempMarginBottom = `<div id='divMarginBottom' style='margin-bottom: 3%;'></div>`;
        
        divToCards.insertAdjacentHTML('afterbegin',tempTitle);
        divToCards.insertAdjacentHTML('beforeend',tempMarginBottom);

        html2canvas(divToCards).then(function(canvas) {
            let filename = "Cotización.jpg";
            let link = document.createElement('a');
            link.href = canvas.toDataURL("image/jpg");
            link.download = filename;
            link.click();
            document.getElementById('divTitleToImg').remove();
            document.getElementById('divMarginBottom').remove();
        });
    }
    else{
        let contPage = document.querySelector('.contPage');
        let templateMessage = `<div id='divMessageSelectSomething' class="divMessageSelectSomething" style='position: absolute; bottom: 5%; right: 2%;'>
                                <p style='background: #d51e1e; color: #ffffff; border-radius: 10px; padding-left: 10px; padding-right: 10px;'>
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    Seleccione al menos un vehículo
                                </p>
                               </div>`;
        contPage.insertAdjacentHTML('beforeend',templateMessage);
        setTimeout(()=>{
            document.getElementById('divMessageSelectSomething').remove();
        },2000);
    }
});