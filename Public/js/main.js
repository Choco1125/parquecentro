let alerta = (id, tipo, texto) => {
    const alert = document.getElementById(id);
    let alerta = document.createElement('div');
    alerta.classList.add('alert');
    alerta.classList.add('alert-' + tipo);
    alerta.innerHTML = texto;

    alert.appendChild(alerta);

    setTimeout(() => alert.removeChild(alerta), 2000);
}


const btnLoggar = document.getElementById('btn-loggear'); 

btnLoggar.addEventListener('click', async ()=>{
    let usuario = document.getElementById('usuario');
    let contrasena = document.getElementById('contrasena');
    let span = document.getElementById('span-ingresar');

    span.innerHTML= "<div class='spinner-border spinner-border-sm'></div>";

    if(usuario.value==""){
        alerta('alerta','danger','Debes ingresar un usuario');
        usuario.focus();
    }else if(contrasena.value==""){
        alerta('alerta','danger','Debes ingresar una contraseña');
        contrasena.focus();
    }else{

        let formdata = new FormData();
        formdata.append('usuario',usuario.value);
        formdata.append('password',contrasena.value);

        let peticion = await fetch(DOMINIO+'Main/loggear',{
            method: 'POST',
            body: formdata
        });

        let respuesta = await peticion.json();

        

        if(respuesta==200){
            window.location.href=DOMINIO;
        }else if(respuesta==100){
            alerta('alerta','danger','Contraseña incorrecta');
        }else{
            alerta('alerta','danger',respuesta);
        }
    }

    span.innerHTML="";
});