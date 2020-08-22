let pedirClientes = async () => {
    let peticion = await fetch(DOMINIO + 'Clientes/get_all');
    $('#modal-editar').modal('hide');

    let respuesta = await peticion.json();
    let tabla = document.getElementById('tabla');
    tabla.innerHTML = "";
    respuesta.map(({ id, placa, nombre, telefono, vehiculo, estado }) => llenarTabla(id, placa, nombre, telefono, vehiculo, estado));
}

let llenarTabla = (id, placa, nombre, telefono, vehiculo, estado) => {
    let tabla = document.getElementById('tabla');

    let tr = document.createElement('tr');

    let tdPlaca = document.createElement('th');
    let tdnombre = document.createElement('td');
    let tdtelefono = document.createElement('td');
    let tdvehiculo = document.createElement('td');
    let tdestado = document.createElement('td');
    let tdopciones = document.createElement('td');

    tdPlaca.innerHTML = placa;
    tdPlaca.setAttribute('scope', 'row');
    tdnombre.innerHTML = nombre;
    tdtelefono.innerHTML = telefono;
    tdvehiculo.innerHTML = vehiculo;
    if (estado == 1) {
        tdestado.classList.add('text-primary');
        tdestado.innerHTML = 'Al día';
    } else {
        tdestado.classList.add('text-danger');
        tdestado.innerHTML = 'Moroso';
    }

    let btn = document.createElement('button');

    btn.classList.add('btn');
    btn.classList.add('btn-light');
    btn.classList.add('text-primary');
    btn.dataset.toggle = "modal";
    btn.dataset.target = "#modal-editar";
    btn.addEventListener('click', () => {
        sessionStorage.setItem('id', id);
        pedirData();
    });

    btn.innerHTML = "Editar"

    tdopciones.appendChild(btn);

    tr.appendChild(tdPlaca);
    tr.appendChild(tdnombre);
    tr.appendChild(tdtelefono);
    tr.appendChild(tdvehiculo);
    tr.appendChild(tdestado);
    tr.appendChild(tdopciones);

    tabla.appendChild(tr);
}


pedirClientes();

//Boton crear:
const btnCrear = document.getElementById('btn-crear');

btnCrear.addEventListener('click', async () => {
    var placa = document.getElementById('placa');
    var nombre = document.getElementById('nombre');
    var telefono = document.getElementById('telefono');
    var mensualidad = document.getElementById('mensualidad');
    var estado = document.getElementById('estado');
    var btnSpan = document.getElementById('btn-span');

    var spinner = '<div class="spinner-border spinner-border-sm"></div>';

    btnSpan.innerHTML = spinner;

    if (placa.value == "") {
        alerta('alert', 'danger', 'Debes llenar el campo placa');
        placa.focus();
    } else if (nombre.value == "") {
        alerta('alert', 'danger', 'Debes llenar el campo nombre');
        nombre.focus();
    } else if (telefono.value == "") {
        alerta('alert', 'danger', 'Debes llenar el campo telefono');
        telefono.focus();
    } else if (mensualidad.value == "") {
        alerta('alert', 'danger', 'Debes llenar el campo vehiculo');
        mensualidad.focus();
    } else if (estado.value == "") {
        alerta('alert', 'danger', 'Debes llenar el campo estado');
        estado.focus();
    } else {

        if (placa.value.length < 6 || placa.value.length > 7) {

            alerta('alert', 'danger', 'Debes ingresar una placa válida');
            placa.focus();


        } else if (telefono.value.length < 7 || telefono.value.length > 10) {

            alerta('alert', 'danger', 'Debes ingresar una número de teléfono válido');
            telefono.focus();


        } else {
            let vehiculo;
            if (placa.value.length == 6) {
                vehiculo = 'Carro';
            } else {
                vehiculo = 'Moto';
            }

            try {
                var fromdata = new FormData();
                fromdata.append('placa', placa.value);
                fromdata.append('nombre', nombre.value);
                fromdata.append('telefono', telefono.value);
                fromdata.append('vehiculo', vehiculo);
                fromdata.append('estado', estado.value);
                fromdata.append('mensualidad', mensualidad.value);


                let peticion = await fetch(DOMINIO + 'Clientes/create', {
                    method: 'POST',
                    body: fromdata
                });

                let respuesta = await peticion.json();

                if (respuesta == 200) {
                    placa.value = "";
                    nombre.value = "";
                    telefono.value = "";
                    vehiculo.value = "";
                    estado.value = "";
                    pedirClientes();
                    $('#modal-crear').modal('hide');
                } else {
                    alerta('alert', 'danger', respuesta);
                }

            } catch (e) {
                console.error(e);
            }
        }
    }

    btnSpan.innerHTML = '';

});


let alerta = (id, tipo, texto) => {
    const alert = document.getElementById(id);
    let alerta = document.createElement('div');
    alerta.classList.add('alert');
    alerta.classList.add('alert-' + tipo);
    alerta.innerHTML = texto;

    alert.appendChild(alerta);

    setTimeout(() => alert.removeChild(alerta), 2000);
}


let pedirData = async () => {

    let { placa, nombre, telefono, vehiculo, estado, mensualidad } = await pedirCliente();

    let placaEditar = document.getElementById('placa-editar');
    let nombreEditar = document.getElementById('nombre-editar');
    let telefonoEditar = document.getElementById('telefono-editar');
    let vehiculoEditar = document.getElementById('vehiculo-editar');
    let estadoEditar = document.getElementById('estado-editar');
    let mensualidadEditar = document.getElementById('mensualidad-editar');


    placaEditar.value = placa;
    nombreEditar.value = nombre;
    telefonoEditar.value = telefono;
    estadoEditar.value = estado;
    mensualidadEditar.value = mensualidad;


};


let pedirCliente = async () => {
    let id = sessionStorage.getItem('id');
    let formdata = new FormData();
    formdata.append('id', id);

    let peticion = await fetch(DOMINIO + 'Clientes/get', {
        method: 'POST',
        body: formdata
    });

    let respuesta = await peticion.json();

    return respuesta;
}

document.getElementById('btn-actualizar').addEventListener('click', async () => {
    let spinner = '<div class="spinner-border spinner-border-sm"></div>';

    var btnSpinner = document.getElementById('btn-espan-editar');
    btnSpinner.innerHTML = spinner;

    var placa = document.getElementById('placa-editar');
    var nombre = document.getElementById('nombre-editar');
    var telefono = document.getElementById('telefono-editar');
    var mensualidad = document.getElementById('mensualidad-editar');
    var estado = document.getElementById('estado-editar');

    if (placa.value == "") {
        alerta('alert-editar', 'danger', 'Debes llenar el campo placa');
        placa.focus()
    } else if (nombre.value == "") {
        alerta('alert-editar', 'danger', 'Debes llenar el campo nombre');
        nombre.focus()
    } else if (telefono.value == "") {
        alerta('alert-editar', 'danger', 'Debes llenar el campo telefono');
        telefono.focus()
    } else if (mensualidad.value == "") {
        alerta('alert-editar', 'danger', 'Debes llenar el campo de mensualidad');
        mensualidad.focus()
    } else {
        if (placa.value.length < 6 || placa.value.length > 7) {
            alerta('alert-editar', 'danger', 'Debes ingresar una placa válida');
            placa.focus();
        } else if (telefono.value.length < 7 || telefono.value.length > 10) {
            alerta('alert-editar', 'danger', 'Debes ingresar una número de teléfono válido');
            telefono.focus();
        } else {
            let vehiculo;
            if (placa.value.length == 6) {
                vehiculo = 'Carro';
            } else {
                vehiculo = 'Moto';
            }
            try {
                let fromdata = new FormData();
                fromdata.append('id', sessionStorage.getItem('id'));
                fromdata.append('placa', placa.value);
                fromdata.append('nombre', nombre.value);
                fromdata.append('telefono', telefono.value);
                fromdata.append('vehiculo', vehiculo);
                fromdata.append('estado', estado.value);
                fromdata.append('mensualidad', mensualidad.value);

                let peticion = await fetch(DOMINIO + 'Clientes/update', {
                    method: 'POST',
                    body: fromdata
                });

                let respuesta = await peticion.json();

                if (respuesta == 200) {
                    sessionStorage.removeItem('id');
                    placa.value = "";
                    nombre.value = "";
                    telefono.value = "";
                    vehiculo.value = "";
                    estado.value = "";
                    mensualidad.value = "";
                    estado.value = "";
                    pedirClientes();
                    $('#modal-editar').modal('hide');
                } else {
                    alerta('alert-editar', 'danger', respuesta);
                }
            } catch (e) {
                console.error(e);
            }
        }
    }

    btnSpinner.innerHTML = '';
});

document.getElementById('btn-confrimar').addEventListener('click', async () => {


    try {
        var span = document.getElementById('span-confirmar');

        span.innerHTML = "<div class='spinner-border spinner-border-sm'></div>";

        let fromdata = new FormData();
        fromdata.append('id', sessionStorage.getItem('id'));

        let peticion = await fetch(DOMINIO + 'Clientes/delete', {
            method: 'POST',
            body: fromdata
        });



        let respuesta = await peticion.json();



        if (respuesta == 200) {
            pedirClientes();
            sessionStorage.removeItem('id');
            placa.value = "";
            nombre.value = "";
            telefono.value = "";
            vehiculo.value = "";
            estado.value = "";
        } else {
            alerta('alert-editar', 'danger', respuesta);
        }
    } catch (e) {
        console.error(e);
    }
    span.innerHTML = "";

});