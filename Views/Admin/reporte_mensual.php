<?php require 'Views/Plantilla/Head.php'; ?>
<?php
if ($_SESSION['rol'] == 'admin') {
  require 'Views/Plantilla/Menu_admin.php';
} else {
  require 'Views/Plantilla/Menu_usuario.php';
}
?>

<div class="container">
  <div class="row justify-content-center mt-3">
    <h1>PANEL DE REPORTE</h1>
  </div>
  <div class="row justify-content-end mt-5">
    <form>
      <div class="form-row">
        <div class="col">
          <label for="fecha_inico">Desde</label>
          <input type="date" class="form-control" id="fecha_inico">
        </div>
        <div class="col">
          <label for="fecha_fin">Hasta</label>
          <input type="date" class="form-control" id="fecha_fin">
        </div>
      </div>
    </form>
  </div>
  <div class="row my-2 justify-content-end">
    <button class="btn btn-outline-primary" id="btn-print">
      Imprimir
    </button>
  </div>
  <div class="row mt-3 justify-content-center">
    <table class="table table-striped text-center">
      <thead>
        <th scope="col">Razón</th>
        <th scope="col">Valor</th>
      </thead>
      <tbody id="table">

      </tbody>
      <tfoot>
        <tr>
          <td scope="col">Total</td>
          <td scope="col" id="total"></td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<script src="<?php echo constant('URL') ?>Public/js/reporte.js"></script>
<?php require 'Views/Plantilla/Foot.php'; ?>