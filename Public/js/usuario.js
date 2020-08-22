const pedirDatos = async () => {
  document.getElementById("table").innerHTML = "";
  let peticion = await fetch(DOMINIO + "Usuario/get");

  let respuesta = await peticion.json();
  respuesta.map(({ placa, vehiculo, hora_entrada }) =>
    llenarTabla(placa, vehiculo, hora_entrada)
  );
};

const llenarTabla = (placa, vehiculo, hora_entrada) => {
  let tr = document.createElement("tr");
  let tdplaca = document.createElement("td");
  let tdVehiculo = document.createElement("td");
  let tdHoraEntrada = document.createElement("td");

  tdplaca.innerHTML = placa;
  tdVehiculo.innerHTML = vehiculo;
  tdHoraEntrada.innerHTML = hora_entrada;

  tr.appendChild(tdplaca);
  tr.appendChild(tdVehiculo);
  tr.appendChild(tdHoraEntrada);
  document.getElementById("table").appendChild(tr);
};
pedirDatos();

const btnEntrar = document.getElementById("btn-Entrada");

const alerta = (id, tipo, texto) => {
  const alert = document.getElementById(id);
  let alerta = document.createElement("div");
  alerta.classList.add("alert");
  alerta.classList.add("alert-" + tipo);
  alerta.innerHTML = texto;

  alert.appendChild(alerta);

  setTimeout(() => alert.removeChild(alerta), 2000);
};

btnEntrar.addEventListener("click", async () => {
  const placa = document.getElementById("placa");
  const precio = document.getElementById("precio");
  const spinner = document.getElementById("span-entrada");

  spinner.innerHTML = "<div class='spinner-border spinner-border-sm'></div>";

  if (placa.value == "") {
    alerta("alerta", "danger", "Debes ingresar una placa");
    placa.focus();
  } else if (placa.value.length < 6 || placa.value.length > 7) {
    alerta("alerta", "danger", "Debes ingresar una placa válida");
    placa.focus();
  } else if (precio.value == "") {
    alerta("alerta", "danger", "Debes ingresar un tipo válido");
  } else {
    var formdata = new FormData();
    var vehiculo = placa.value.length == 6 ? "Carro" : "Moto";
    formdata.append("placa", placa.value);
    formdata.append("vehiculo", vehiculo);
    formdata.append("precio", precio.value);
    try {
      var peticion = await fetch(DOMINIO + "Usuario/entrada", {
        method: "POST",
        body: formdata,
      });

      var respuesta = await peticion.json();

      if (respuesta.estado == 200) {
        let p = placa.value;
        placa.value = "";
        precio.value = "carro";

        pedirDatos();
        $("#modal-entrada").modal("hide");
        localStorage.setItem("placa", p);
        localStorage.setItem("cobro", respuesta.valor);
        // window.open(DOMINIO+'libs/entrada.php?'+ `placa=${p}&cobro=${respuesta.valor}`, '_blank');
        window.open(DOMINIO + "libs/entrada.php", "_blank");
      } else {
        alerta("alerta", "danger", respuesta);
      }
    } catch (error) {
      console.error(error);
    }
  }

  spinner.innerHTML = "";
});

const placaSalida = document.getElementById("placa-salida");

placaSalida.addEventListener("keyup", async () => {
  if (placaSalida.value.length > 5) {
    try {
      var formdata = new FormData();
      formdata.append("placa", placaSalida.value);

      var peticion = await fetch(DOMINIO + "Usuario/salida", {
        method: "POST",
        body: formdata,
      });

      var respuesta = await peticion.json();
      console.log(respuesta);

      if (typeof respuesta == "object") {
        var { id, vehiculo, horas, total, fecha, precio } = respuesta;
        document.getElementById("horas").innerHTML = horas;
        document.getElementById("total").innerHTML = total;
        var efectivo = document.getElementById("efectivo");

        efectivo.dataset.valor = total;
        efectivo.dataset.vehiculo = vehiculo;
        efectivo.setAttribute("min", total);
        efectivo.setAttribute("placeholder", total);

        var btnPagar = document.getElementById("btn-pagar");

        btnPagar.dataset.id = id;
        btnPagar.dataset.fecha = fecha;
        btnPagar.dataset.precio = precio;
      } else {
        alerta("advert", "danger", respuesta);

        var efectivo = document.getElementById("efectivo");
        efectivo.dataset.valor = "";
        document.getElementById("horas").innerHTML = "";
        document.getElementById("total").innerHTML = "";
        var btnPagar = document.getElementById("btn-pagar");
        btnPagar.dataset.id = "";
        btnPagar.dataset.fecha = "";
      }
    } catch (error) {
      console.error(error);
    }
  }
});

var efectivo = document.getElementById("efectivo");

efectivo.addEventListener("keyup", (e) => {
  let valor = e.target.value;
  let total = parseInt(e.target.dataset.valor);
  document.getElementById("cambio").innerHTML = 0;

  if (valor >= total) {
    document.getElementById("cambio").innerHTML = valor - total;
  }
});

var btnPagar = document.getElementById("btn-pagar");

btnPagar.addEventListener("click", async () => {
  let total = parseInt(efectivo.dataset.valor);
  if (efectivo.value == "") {
    alerta("alerta2", "danger", "No se ingresó valor");
    efectivo.focus();
  } else if (efectivo.value < total) {
    alerta("alerta2", "danger", "Dinero insuficiente");
    efectivo.focus();
  } else {
    try {
      let formdata = new FormData();

      formdata.append("id", btnPagar.dataset.id);
      formdata.append("total", total);
      let peticion = await fetch(DOMINIO + "usuario/salir", {
        method: "POST",
        body: formdata,
      });

      let repuesta = await peticion.text();
      console.log(repuesta);
      if (repuesta == 200) {
        let id = btnPagar.dataset.id;
        let fecha = btnPagar.dataset.fecha;
        let precio = btnPagar.dataset.precio;
        const spantotal = document.getElementById("total");
        const horas = document.getElementById("horas");
        let placa = placaSalida.value;
        let efect = efectivo.value;
        let tot = spantotal.innerHTML;
        let hor = horas.innerHTML;
        let cambio = document.getElementById("cambio").innerHTML;

        placaSalida.value = "";
        efectivo.value = "";
        efectivo.dataset.valor = "";
        spantotal.innerHTML = "";
        horas.innerHTML = "";
        btnPagar.dataset.id = "";
        btnPagar.dataset.fecha = "";
        btnPagar.dataset.precio = "";

        document.getElementById("cambio").innerHTML = "";
        pedirDatos();
        $("#modal-salida").modal("hide");
        localStorage.setItem("id", id);
        localStorage.setItem("placa", placa);
        localStorage.setItem("efectivo", efect);
        localStorage.setItem("total", tot);
        localStorage.setItem("horas", hor);
        localStorage.setItem("cambio", cambio);
        localStorage.setItem("fecha", fecha);
        localStorage.setItem("precio", precio);
        window.open(DOMINIO + "libs/salida.php?", "_blank");
        //window.open(DOMINIO+'libs/salida.php?'+ `id=${id}&placa=${placa}&efectivo=${efect}&total=${tot}&horas=${hor}&cambio=${cambio}&fecha=${fecha}&precio=${precio}`, '_blank');
      }
    } catch (error) {
      console.error(error);
    }
  }
});
