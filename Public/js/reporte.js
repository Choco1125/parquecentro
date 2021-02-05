const desde = document.getElementById('fecha_inico');
const hasta = document.getElementById('fecha_fin');

const printBtn = document.getElementById('btn-print')

// window.open(DOMINIO + "libs/salida.php?", "_blank");


let fecha_final = "";
let fecha_inicio = "";

let entradas;
let mensualidades;
let total;

printBtn.addEventListener('click', () => {
  window.open(DOMINIO + `libs/reporte.php?entradas=${entradas}&mensualidades=${mensualidades}&total=${total}&fecha_inicio=${fecha_inicio}&fecha_final=${fecha_final}`, "_blank");
});

desde.addEventListener('change', () => {

  let formateo = desde.value.split('-');
  if (formateo.length > 1) {
    let date = `${formateo[2]}-${formateo[1]}-${formateo[0]}`;
    fecha_inicio = date;
  } else {
    fecha_inicio = "";
  }
  buscar();
});

hasta.addEventListener('change', () => {

  let formateo = hasta.value.split('-');
  if (formateo.length > 1) {
    let date = `${formateo[2]}-${formateo[1]}-${formateo[0]}`;
    fecha_final = date;
  } else {
    fecha_final = "";
  }
  buscar();
});

// const pedirDatos = async () => {
//   document.getElementById('table').innerHTML = "";

//   let peticion = await fetch(DOMINIO + 'Busqueda/get_all');
//   let respuesta = await peticion.json();

//   respuesta.map(({ placa, vehiculo, hora_entrada, hora_salida, valor, fecha_entrada }) => llenarTabla(placa, vehiculo, hora_entrada, hora_salida, valor, fecha_entrada));
// }

const llenarTabla = (razon, valor) => {
  let tr = document.createElement('tr');
  let tdRazon = document.createElement('td');
  let tdPlaca = document.createElement('td');

  tdRazon.innerHTML = razon;
  tdPlaca.innerHTML = valor;
  tr.appendChild(tdRazon);
  tr.appendChild(tdPlaca);
  document.getElementById('table').appendChild(tr);
}
// pedirDatos();

const setTotal = totalMoney => {
  const total = document.getElementById('total');
  total.innerText = totalMoney;
}

const buscar = async () => {
  console.log('Since:', fecha_inicio, 'Until:', fecha_final);
  if (fecha_inicio !== "" && fecha_final !== "") {
    let formdata = new FormData();
    formdata.append('desde', fecha_inicio);
    formdata.append('hasta', fecha_final);
    document.getElementById('table').innerHTML = "";
    let peticion = await fetch(DOMINIO + 'Busqueda/get_report', {
      method: 'POST',
      body: formdata
    });
    let respuesta = await peticion.json();
    console.log(respuesta);
    llenarTabla('Entradas', respuesta.entradas);
    llenarTabla('Mensualidades', respuesta.mensualidades);
    setTotal(parseInt(respuesta.entradas) + respuesta.mensualidades);
    entradas = respuesta.entradas;
    mensualidades = respuesta.mensualidades;
    total = parseInt(respuesta.entradas) + respuesta.mensualidades;
  }
}