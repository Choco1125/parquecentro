const carro = document.getElementById('carro').addEventListener('click', e => setId(e.target.id));
const moto = document.getElementById('moto').addEventListener('click', e => setId(e.target.id));
const nocheCarro = document.getElementById('noche_carro').addEventListener('click', e => setId(e.target.id));
const nocheMoto = document.getElementById('noche_moto').addEventListener('click', e => setId(e.target.id));
const diaCarro = document.getElementById('dia_carro').addEventListener('click', e => setId(e.target.id));
const diaMoto = document.getElementById('dia_moto').addEventListener('click', e => setId(e.target.id));

const setId = id => sessionStorage.setItem('tipo', id);

const actualizar = document.getElementById('actualizar');

actualizar.addEventListener('click', async () => {
    var span = document.getElementById('span');

    span.innerHTML = "<div class='spinner-border spinner-border-sm'></div>";
    var columna = sessionStorage.getItem('tipo');
    var valor = document.getElementById('valor');

    if (valor.value == "") {
        alerta('alerta', 'danger', 'Debes llenar el campo valor');
        valor.focus();
    } else {

        var formdata = new FormData();

        formdata.append('campo', columna);
        formdata.append('valor', valor.value);

        var peticion = await fetch(DOMINIO + 'Precios/update', {
            method: 'POST',
            body: formdata
        });

        var respuesta = await peticion.json();

        if (respuesta == 200) {
            pedirValores();
            sessionStorage.removeItem('tipo');
            valor.value = "";
            $('#modal-precio').modal('hide');
            
        } else {
            alerta('alert', 'danger', respuesta);
        }
    }

    span.innerHTML = "";


});

let alerta = (id, tipo, texto) => {
    var alerta = document.getElementById(id);
    let div = document.createElement('div');
    div.classList.add('alert');
    div.classList.add('alert-' + tipo);
    div.innerHTML = texto;

    alerta.appendChild(div);

    setTimeout(() => alerta.removeChild(div), 2000);
}

const pedirValores = async () => {
    var peticion = await fetch(DOMINIO + 'Precios/get_valores');
    var respuesta = await peticion.json();

    var precioCarro = document.getElementById('precio-carro');
    var precioMoto = document.getElementById('precio-moto');
    var precioNocheCarro = document.getElementById('precio-noche-carro');
    var precioNocheMoto = document.getElementById('precio-noche-moto');
    var precioDiaCarro = document.getElementById('precio-dia-carro');
    var precioDiaMoto = document.getElementById('precio-dia-moto');
  

    precioCarro.innerHTML=respuesta.carro;
    precioMoto.innerHTML=respuesta.moto;
    precioNocheCarro.innerHTML=respuesta.noche_carro;
    precioNocheMoto.innerHTML=respuesta.noche_moto;
    precioDiaCarro.innerHTML=respuesta.dia_carro;
    precioDiaMoto.innerHTML=respuesta.dia_moto;


}


pedirValores();