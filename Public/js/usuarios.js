let pedirUsuarios = async () =>{
    document.getElementById('tablaUsuarios').innerHTML="";
    
    let peticion = await fetch(DOMINIO+'Usuarios/get_users');

    let response = await peticion.json();

    response.map(({id,usuario,rol,estado})=>llenarTabla(id,usuario,rol,estado));
    

}

pedirUsuarios();

let llenarTabla = (id,usuario,rol,estado)=>{
    let tablaUsuarios = document.getElementById('tablaUsuarios');

    
    let tr = document.createElement('tr');
    let tdUsuario= document.createElement('td');
    let tdrol= document.createElement('td');
    let tdestado= document.createElement('td');
    let tdopciones= document.createElement('td');
    let btneditar= document.createElement('button');

    if(rol=="admin"){
        tdrol.innerHTML="Administrador";
    }else{
        tdrol.innerHTML="Usuario";
    }
    tdUsuario.innerHTML=usuario;

    if(estado==0){
        tdestado.classList.add('text-danger');
        tdestado.innerHTML='Inactivo';
    }else{
        tdestado.classList.add('text-primary');
        tdestado.innerHTML='Activo';
    }
    btneditar.innerHTML='Editar';

    btneditar.classList.add('btn');
    btneditar.classList.add('btn-light');
    btneditar.classList.add('text-primary');

    btneditar.dataset.toggle='modal';
    btneditar.dataset.target='#ModalEditar';
    btneditar.addEventListener('click',()=>sessionStorage.setItem('id',id));
    tdopciones.appendChild(btneditar);

    tr.appendChild(tdUsuario);
    tr.appendChild(tdrol);
    tr.appendChild(tdestado);
    tr.appendChild(tdopciones);

    tablaUsuarios.appendChild(tr);
}


document.getElementById('btn-crear').addEventListener('click',async e=>{
    e.preventDefault();

    const usuario = document.getElementById('usuario');
    const rol = document.getElementById('rol');
    const estado = document.getElementById('estado');
    const btnSpan = document.getElementById('btn-span');

    
    
    if(usuario.value == ""){
        alerta('alert-crear','danger','Debes llenar el campo de usuario');
        usuario.focus();
    }else if(rol.value==""){
        alerta('alert-crear','danger','Debes seleccionar un rol');
        rol.focus();
    }else if(estado.value==""){
        alerta('alert-crear','danger','Debes seleccionar un estado');
        estado.focus();
    }else{
        try{
            let spinner = '<div class="spinner-border spinner-border-sm"></div>';
            btnSpan.innerHTML+=spinner;
            let formdata = new FormData();
            formdata.append('usuario',usuario.value);
            formdata.append('rol',rol.value);
            formdata.append('estado',estado.value);

            let peticion = await fetch(DOMINIO+'Usuarios/create',{
                method: 'POST',
                body: formdata
            });

            let respuesta = await peticion.json();
            if(respuesta==200){
                usuario.value="";
                rol.value="";
                estado.value="";
                pedirUsuarios();
                $('#ModalCrear').modal('hide')
            }else{

                alerta('alert-crear','danger',respuesta);
            }
            
        }catch(err){
            alerta('alert-crear','success','Error al intentar guardar datos');
            console.error(err);
        }

        btnSpan.innerHTML="";


    }

    // btnSpan.innerHTML='';

    
});

let alerta = (id,tipo,texto) => {
    const alert = document.getElementById(id);
    let alerta = document.createElement('div');
    alerta.classList.add('alert');
    alerta.classList.add('alert-'+tipo);
    alerta.innerHTML = texto;
    
    alert.appendChild(alerta);

    setTimeout(()=>alert.removeChild(alerta),2000);
}

let spinner = ()=>{
    let spinner = document.createElement('div');
    spinner.classList.add('spinner-border');
}

let pedirUsuario = async ()=>{
    let formdata = new FormData();
    formdata.append('id',sessionStorage.getItem('id'));

    let peticion = await fetch(DOMINIO+'Usuarios/get_user',{
        method: 'POST',
        body: formdata
    });

    let response = await peticion.json();

    return response;
}

document.getElementById('ModalEditar').addEventListener('focus',async ()=>{
    let {usuario,rol,estado} =  await pedirUsuario();

    const usuarioEditar = document.getElementById('usuario-editar');
    const rolEditar = document.getElementById('rol-editar');
    const estadoEditar = document.getElementById('estado-editar');

    usuarioEditar.value=usuario;
    rolEditar.value=rol;
    estadoEditar.value=estado;
});

document.getElementById('btn-actualizar').addEventListener('click',async e=>{
    e.preventDefault();

    const usuarioEditar = document.getElementById('usuario-editar');
    const rolEditar = document.getElementById('rol-editar');
    const estadoEditar = document.getElementById('estado-editar');
    const btnSpanActualizar = document.getElementById('btn-span-actualizar');

    
    
    if(usuarioEditar.value == ""){
        alerta('alert-editar','danger','El campo usuario no debe estar vacío');
        usuario.focus();
    }else if(rolEditar.value==""){
        alerta('alert-editar','danger','Debes seleccionar un rol');
        rol.focus();
    }else if(estadoEditar.value==""){
        alerta('alert-editar','danger','Debes seleccionar un estado');
        estado.focus();
    }else{
        try{
            let spinner = '<div class="spinner-border spinner-border-sm"></div>';
            btnSpanActualizar.innerHTML+=spinner;
            let formdata = new FormData();

            formdata.append('id',sessionStorage.getItem('id'));
            formdata.append('usuario',usuarioEditar.value);
            formdata.append('rol',rolEditar.value);
            formdata.append('estado',estadoEditar.value);

            let peticion = await fetch(DOMINIO+'Usuarios/update',{
                method: 'POST',
                body: formdata
            });

            let respuesta = await peticion.json();
            if(respuesta==200){
                usuarioEditar.value="";
                rolEditar.value="";
                estadoEditar.value="";
                sessionStorage.removeItem('id');
                pedirUsuarios();
                $('#ModalEditar').modal('hide');
            }else{

                alerta('alert-editar','danger',respuesta);
            }
            
        }catch(err){
            alerta('alert-editar','success','Error al intentar actualizar datos');
            console.error(err);
        }

        btnSpanActualizar.innerHTML="";


    }

    // btnSpan.innerHTML='';

    
});

document.getElementById('btn-eliminar').addEventListener('click', async () => {

    const btnSpan = document.getElementById('btn-span-eliminar');

    try {
        let spinner = '<div class="spinner-border spinner-border-sm"></div>';
        btnSpan.innerHTML += spinner;
        let formdata = new FormData();
        formdata.append('id', sessionStorage.getItem('id'));

        let peticion = await fetch(DOMINIO + 'Usuarios/delete', {
            method: 'POST',
            body: formdata
        });

        let respuesta = await peticion.json();
        if (respuesta == 200) {
            pedirUsuarios();
            $('#confirmar').modal('hide');
            sessionStorage.removeItem('id');
        } else {
            $('#ModalEditar').modal('show');

            alerta('alert-editar', 'danger', respuesta);
        }

    } catch (err) {
        alerta('alert-editar', 'danger', 'Error al intentar guardar datos');
        console.error(err);
    }

    btnSpan.innerHTML = "";
});

