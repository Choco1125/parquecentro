<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            font-family: 12px;
            text-align: center;
        }

        table {
            text-align: left;
        }

        .oscuro {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php date_default_timezone_set('America/Bogota'); ?>
    <header>
        <h1>Parqueadero Parquicentro</h1>
        <p>Jose Fernando Escobar Serna</p>
        <p>NIT. 16077884_3</p>
        <p id="actual"></p>
        <p>Pago mensualidad</p>
    </header>

    <main>
        <section>
            <table>
                <tr>
                    <td class="oscuro">Fecha de pago:</td>
                    <td id="fecha"></td>
                </tr>  
                <tr>
                    <td class="oscuro">Fecha de finalización mensualidad:</td>
                    <td id="fechaF"></td>
                </tr> 
                <tr>
                    <td class="oscuro">Placa:</td>
                    <td id="placa"></td>
                </tr>
                <tr>
                    <td class="oscuro">Valor:</td>
                    <td id="cobro"></td>
                </tr>              
            </table>
        </section>
    </main>
    
    <script>
        let fecha = new Date();

        let dia = fecha.getDate().toString();
        if(dia.length==1){
            dia = 0 + fecha.getDate().toString()
        }
        let mes = parseInt(fecha.getMonth());
        mes++;
        mes = mes.toString();
        if(mes.length==1){
            mes = 0 + mes;
        }
	
 let hora = parseInt(fecha.getHours());

        document.getElementById('placa').innerHTML=localStorage.getItem('placa');
        document.getElementById('cobro').innerHTML=localStorage.getItem('valor');
        document.getElementById('fecha').innerHTML=`${dia}-${mes}-${fecha.getFullYear()}`;
        document.getElementById('fechaF').innerHTML=localStorage.getItem('fecha_fin');
        document.getElementById('actual').innerHTML=`${dia}-${mes}-${fecha.getFullYear()}`;

        window.print();
    </script>
</body>

</html>