let alerta = (id, tipo, texto) => {
    const alert = document.getElementById(id);
    let alerta = document.createElement('div');
    alerta.classList.add('alert');
    alerta.classList.add('alert-' + tipo);
    alerta.innerHTML = texto;

    alert.appendChild(alerta);

    setTimeout(() => alert.removeChild(alerta), 2000);
}

const btnConfirmar = document.getElementById('btn-confirmar');

const btnPagar = document.getElementById('btn-agregar');

btnPagar.onclick = async ()=>{
    let placa = document.getElementById('placa');
    let valor = document.getElementById('valor');
    let span = document.getElementById('btn-span');
    span.innerHTML='<div class="spinner-border spinner-border-sm"></div>';
    if(placa.value == ""){
        placa.focus();
        alerta('alerta','danger','Debes ingresar una placa.');
    }else if(valor.value == "" || valor.value==0){
        valor.focus();
        alerta('alerta','danger','Debes ingresar un valor.');
    }else if(placa.value.length< 6 || placa.value.length > 7){
        placa.focus();
        alerta('alerta','danger','Debes ingresar una pláca válida');
    }else{
        let fechaFin = document.getElementById('fecha_fin');
        try {
            let formdata = new FormData();
            formdata.append('placa',placa.value);
            formdata.append('valor',valor.value);
            formdata.append('fecha_fin',fechaFin.value);

            let peticion = await fetch(DOMINIO+'Pagos/add',{
                method: "POST",
                body:formdata
            });

            let respuesta = await peticion.json();

            localStorage.setItem('placa',placa.value);
            localStorage.setItem('valor',valor.value);
            localStorage.setItem('fecha_fin',fecha_fin.value);
            if(respuesta == 200){

                $('#ModalPagar').modal('hide');
                cargar();
                window.open(DOMINIO+'libs/mensualidad.php', '_blank');
                placa.value = "";
                valor.value = "";
            }else{
                alerta('alerta','danger',respuesta);

            }
        } catch (err) {
            console.error(err);            
        }
    }
    span.innerHTML='';

}

const cargar = async () =>{
    const table = document.getElementById('tbody');
    try {
        const res = await fetch(DOMINIO + 'Pagos/get_all');
        const data = await res.json();
        table.innerHTML=""; 
        data.map(({placa,fecha_pago,valor,fecha_fin})=>{
            let tr = document.createElement('tr');
            let tdPlaca = document.createElement('td');
            let tdValor = document.createElement('td');
            let tdFecha = document.createElement('td');
            let tdFechaFin = document.createElement('td');

            tdPlaca.innerHTML = placa;
            tdValor.innerHTML = valor;
            tdFecha.innerHTML = fecha_pago;
            tdFechaFin.innerHTML = fecha_fin;

            tr.appendChild(tdPlaca);
            tr.appendChild(tdValor);
            tr.appendChild(tdFecha);
            tr.appendChild(tdFechaFin);

            table.appendChild(tr);
        });
    } catch (err) {
        console.error(err);
    }

}

cargar();

// btnConfirmar.addEventListener('click',async ()=>{
//     var span = document.getElementById('span-confirmar');
//     span.innerHTML="<div class='spinner-border spinner-border-sm'></div>";


//     var placa = document.getElementById('placa');
//     var monto = document.getElementById('monto');

//     if(placa.value==""){
//         alerta('alerta','danger','Debes ingreasar una placa');
//         placa.focus();
//     }else if(monto.value==""){
//         alerta('alerta','danger','Debes ingreasar una monto');
//         monto.focus();
//     }else{
//         if(placa.value.length <6 || placa.value.length >7){
//             alerta('alerta','danger','Debes ingreasar una placa válida');
//             placa.focus();
//         }else{
//             try {
//                 var formdata = new FormData();
//                 formdata.append('placa',placa.value);
//                 formdata.append('monto',monto.value);


//                 var peticion = await fetch(DOMINIO+'Pagos/pagar',
//                     {
//                         method: 'POST',
//                         body: formdata      
//                     }
//                 );
//                 var respuesta = await peticion.json();

//                 if(respuesta==200){
//                     alerta('alerta','success','Guardado');
//                     placa.value="";
//                     monto.value="";
//                 }else{
//                     alerta('alerta','danger',respuesta);

//                 }
//             } catch (error) {
//                 console.log(error);
//             }
//         }
//     }
//     span.innerHTML='';
// });
