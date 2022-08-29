let btnSolicitar = document.getElementById('btn_solicitar');
btnSolicitar.addEventListener('click', ()=>{
    let strEmail = document.getElementById('txt_email');
    let divEmailSending = document.getElementById('divEmailSending');
    let newPass = document.getElementById('txt_newPass');
    if(strEmail.value){
        //Aqui se coloca el user id generado en el emailJS --> Email Templates --> Settings --> Playground --> ABAJO:  emailjs.init('XXXXXXXXXXX')
        (function () {
            emailjs.init('LHmSHms9_uFwgVS_-');
        })();
        /* 
        Has solicitado la restauración de tu contraseña

        Tu correo electrónico {{txt_email}} ha solicitado la recuperación de tu contraseña.

        La contraseña nueva que se te ha asignado es:
        {{txt_newPass}}

        ==================================
        Seminario de Tecnologías - Concesionario
        ==================================
        */
        
        const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result1 = '';
        const charactersLength = characters.length;
        for(let i=0; i<20; i++){
            result1 += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        newPass.value = result1;
        
        let myform = $("form#procesar-recuperacion");
        myform.submit((event) => {
            event.preventDefault();
            
            // Cambiar el Service_ID o bien dejar el default_service
            let service_id = "service_kh1sbhc"; //service_a68fsyk --> Se consigue en: Email Services --> Click en un servicio de Gmail
            let template_id = "template_9e4qftf"; //Se consigue en: --> Email Templates --> Settings --> Templeta ID

            emailjs.sendForm(service_id, template_id, myform[0])
                .then(() => {
                    setTimeout(()=>{
                        divEmailSending.classList.remove('divEmailSendingHide');
                    },2000);
                }, (err) => {
                    alert("Error al enviar el email\r\n Response:\n " + JSON.stringify(err));
                });
        });
    }
    else{
        Swal.fire({
            type: 'error',
            title: 'Campos incompletos',
            text: 'Por favor, ingrese todos los campos'
        });
    }
});