const placa = document.getElementById('placa');
const fecha = document.getElementById('fecha');

let fecha_final = "";

placa.addEventListener('keyup', () => {

    buscar();
});

fecha.addEventListener('change', () => {

    let formateo = fecha.value.split('-');
    if (formateo.length > 1) {
        let date = `${formateo[2]}-${formateo[1]}-${formateo[0]}`;
        fecha_final = date;
    } else {
        fecha_final = "";
    }
    buscar();
});

const pedirDatos = async () => {
    document.getElementById('table').innerHTML = "";

    let peticion = await fetch(DOMINIO + 'Busqueda/get_all');
    let respuesta = await peticion.json();

    respuesta.map(({ placa, vehiculo, hora_entrada, hora_salida, valor, fecha_entrada }) => llenarTabla(placa, vehiculo, hora_entrada, hora_salida, valor, fecha_entrada));
}

const llenarTabla = (placa, vehiculo, hora_entrada, hora_salida, valor, fecha_entrada) => {
    let tr = document.createElement('tr');
    let tdplaca = document.createElement('td');
    let tdVehiculo = document.createElement('td');
    let tdHoraEntrada = document.createElement('td');
    let tdHoraSalida = document.createElement('td');
    let tdValor = document.createElement('td');
    let tdFechaEntrada = document.createElement('td');

    tdplaca.innerHTML = placa;
    tdVehiculo.innerHTML = vehiculo;
    tdHoraEntrada.innerHTML = hora_entrada;
    tdHoraSalida.innerHTML = hora_salida;
    tdValor.innerHTML = valor;
    tdFechaEntrada.innerHTML = fecha_entrada;
    tr.appendChild(tdplaca);
    tr.appendChild(tdVehiculo);
    tr.appendChild(tdHoraEntrada);
    tr.appendChild(tdHoraSalida);
    tr.appendChild(tdValor);
    tr.appendChild(tdFechaEntrada);
    document.getElementById('table').appendChild(tr);
}
pedirDatos();

const buscar = async () => {
    if (placa.value !== "" || fecha_final !== "") {
        let formdata = new FormData();
        formdata.append('placa', placa.value);
        formdata.append('fecha', fecha_final);
        document.getElementById('table').innerHTML = "";
        let peticion = await fetch(DOMINIO + 'Busqueda/buscar', {
            method: 'POST',
            body: formdata
        });
        let respuesta = await peticion.json();

        respuesta.map(({ placa, vehiculo, hora_entrada, hora_salida, valor, fecha_entrada }) => llenarTabla(placa, vehiculo, hora_entrada, hora_salida, valor, fecha_entrada));

    } else {
        pedirDatos();
    }



}

