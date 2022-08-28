
let btnSolicitar = document.getElementById('btn_solicitar');
btnSolicitar.addEventListener('click', ()=>{
    let strNames = document.getElementById('txt_nombres');
    let strSurnames = document.getElementById('txt_apellidos');
    let strDurections = document.getElementById('txt_direccion');
    let strNit = document.getElementById('txt_nit');
    let strTel = document.getElementById('txt_telefono');
    let strEmail = document.getElementById('txt_email');
    let strPass = document.getElementById('txt_password');
    let strConfPass = document.getElementById('txt_confPassword');

    if(strNames.value && strSurnames.value && strDurections.value && strNit.value && 
       strTel.value && strEmail.value && strPass.value && strConfPass.value){
            if(strPass.value === strConfPass.value){
                //Aqui se coloca el user id generado en el emailJS --> Email Templates --> Settings --> Playground --> ABAJO:  emailjs.init('XXXXXXXXXXX')
                (function () {
                    emailjs.init('LHmSHms9_uFwgVS_-');
                })();
                /* 
                Un cliente ha solicitado la creación de una cuenta para el sistema de gestión vehicular.
        
                Datos para el cliente:
                Nombres: {{txt_nombres}}
                Apellidos: {{txt_apellidos}}
                Dirección: {{txt_direccion}}
                NIT: {{txt_nit}}
                Teléfono: {{txt_telefono}}
        
                Datos para el usuario:
                Email: {{txt_email}}
                Contraseña: {{txt_password}}
        
                ==================================
                Seminario de Tecnologías - Concesionario
                ==================================
                */
        
                let myform = $("form#procesar-solicitud");
                myform.submit((event) => {
                    event.preventDefault();
                    
                    Swal.fire({
                        type: 'success',
                        title: 'Enviando...',
                        text: 'Se está procesanod el correo...'
                    });

                    // Cambiar el Service_ID o bien dejar el default_service
                    let service_id = "default_service"; //service_a68fsyk --> Se consigue en: Email Services --> Click en un servicio de Gmail
                    let template_id = "template_fwud5pu"; //Se consigue en: --> Email Templates --> Settings --> Templeta ID
        
                    emailjs.sendForm(service_id, template_id, myform[0])
                        .then(() => {
                            Swal.fire({
                                type: 'success',
                                title: 'Correo enviado',
                                text: 'Refrescando sitio...'
                            });
                            setTimeout(() => {
                                window.location = "./index.php";
                            }, 2000);
                        }, (err) => {
                            alert("Error al enviar el email\r\n Response:\n " + JSON.stringify(err));
                        });
                    return false;
                });
            }
            else{
                Swal.fire({
                    type: 'error',
                    title: 'Lo sentimos',
                    text: 'Las contraseñas ingresadas no son iguales, inténtelo de nuevo'
                });
            }
    }
    else{
        Swal.fire({
            type: 'error',
            title: 'Campos incompletos',
            text: 'Por favor, ingrese todos los campos'
        });
    }
});