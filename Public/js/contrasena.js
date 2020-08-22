let alerta = (id, tipo, texto) => {
    const alert = document.getElementById(id);
    let alerta = document.createElement('div');
    alerta.classList.add('alert');
    alerta.classList.add('alert-' + tipo);
    alerta.innerHTML = texto;

    alert.appendChild(alerta);

    setTimeout(() => alert.removeChild(alerta), 2000);
}


const btnActualizar = document.getElementById('btn-actualizar');

btnActualizar.addEventListener('click',async ()=>{
    let contrasena = document.getElementById('contrasena-vieja');
    let contrasenaNueva = document.getElementById('contrasena-nueva');
    let contrasenaConfirm = document.getElementById('contrasena-confirm');
    let span = document.getElementById('span-actualizar');

    span.innerHTML='<div class="spinner-border spinner-border-sm"></div>';
    if(contrasena.value==""){
        alerta('alerta','danger','Debes ingresar tu contraseña');
        contrasena.focus();
    }else if(contrasenaNueva.value==""){
        alerta('alerta','danger','Debes ingresar una contraseña nueva');
        contrasenaNueva.focus();
    }else if(contrasenaConfirm.value==""){
        alerta('alerta','danger','Debes volver a ingresar contraseña nueva');
        contrasenaConfirm.focus();
    }else if(contrasenaConfirm.value != contrasenaNueva.value){
        alerta('alerta','danger','Las contraseñas no coinciden');
        contrasenaConfirm.focus();
    }else {
        let formdata = new FormData();

        formdata.append('vieja',contrasena.value);
        formdata.append('nueva',contrasenaNueva.value);

        let peticion = await fetch(DOMINIO+'/contrasena/actualizar',{
            method: 'POST',
            body: formdata
        });

        let respuesta = await peticion.text();

        console.log(respuesta);
    }

    span.innerHTML="";
});