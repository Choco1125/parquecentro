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
          <td class="oscuro">Fecha inicio:</td>
          <td><?php echo $_GET['fecha_inicio'] ?></td>
        </tr>
        <tr>
          <td class="oscuro">Hora fin:</td>
          <td><?php echo $_GET['fecha_final'] ?></td>
        </tr>
        <tr>
          <td class="oscuro">Entradas:</td>
          <td><?php echo $_GET['entradas'] ?></td>
        </tr>
        <tr>
          <td class="oscuro">Mensualidades:</td>
          <td><?php echo $_GET['mensualidades'] ?></td>
        </tr>
        <tr>
          <td class="oscuro">Total:</td>
          <td><?php echo $_GET['total'] ?></td>
        </tr>
      </table>
    </section>
  </main>

  <script>
    window.print();
  </script>
</body>

</html>