const pedirDatos = async()=>{
    document.getElementById('table').innerHTML="";

    let peticion = await fetch(DOMINIO+'Admin/get_all');
    let respuesta = await peticion.json();

    
    respuesta.map(({placa,vehiculo,hora_entrada,hora_salida,valor})=>llenarTabla(placa,vehiculo,hora_entrada,hora_salida,valor));

    let pet = await fetch(DOMINIO+'Admin/total');
    let res = await pet.json();

    document.getElementById('total').innerHTML=res[0].total;
}

const llenarTabla=(placa,vehiculo,hora_entrada,hora_salida,valor)=>{
    let tr = document.createElement('tr');
    let tdplaca = document.createElement('td');
    let tdVehiculo = document.createElement('td');
    let tdHoraEntrada = document.createElement('td');
    let tdHoraSalida = document.createElement('td');
    let tdValor = document.createElement('td');

    tdplaca.innerHTML=placa;
    tdVehiculo.innerHTML=vehiculo;
    tdHoraEntrada.innerHTML=hora_entrada;
    tdHoraSalida.innerHTML=hora_salida;
    tdValor.innerHTML=valor;
    
    tr.appendChild(tdplaca);
    tr.appendChild(tdVehiculo);
    tr.appendChild(tdHoraEntrada);
    tr.appendChild(tdHoraSalida);
    tr.appendChild(tdValor);
    document.getElementById('table').appendChild(tr);
}
pedirDatos();