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
    </header>

    <main>
        <section>
            <table>
                <tr>
                    <td class="oscuro">Fecha ingreso:</td>
                    <td id="fecha"></td>
                </tr>  
                <tr>
                    <td class="oscuro">Hora ingreso:</td>
                    <td id="horaE"><?php echo date('H:i');?></td>
                </tr> 
                <tr>
                    <td class="oscuro">Placa:</td>
                    <td id="placa"></td>
                </tr>
                <tr>
                    <td class="oscuro">Valor Hora:</td>
                    <td id="cobro"></td>
                </tr>              
            </table>
        </section>
        <footer>
            <p style="font-size: 11px">Se le informa a la clientela, no se responde por objetos personales dejados dentro de el vehículo<br>por favor dejarlo con llave.</p>
        </footer>
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
        let tipo = 'AM';
        if(hora>12){
            tipo = 'PM';
            hora-=12;
        }
        document.getElementById('placa').innerHTML=localStorage.getItem('placa');
        document.getElementById('cobro').innerHTML=localStorage.getItem('cobro');
        document.getElementById('fecha').innerHTML=`${dia}-${mes}-${fecha.getFullYear()}`;
        document.getElementById('actual').innerHTML=`${dia}-${mes}-${fecha.getFullYear()} ${hora}:${fecha.getMinutes()} ${tipo}`;
        document.getElementById('horaE').innerHTML=`${hora}:${fecha.getMinutes()} ${tipo}`;

        window.print();
    </script>
</body>

</html>