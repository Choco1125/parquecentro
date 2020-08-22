<?php require 'Views/Plantilla/Head.php'; ?>
<?php
if($_SESSION['rol']=='admin'){
    require 'Views/Plantilla/Menu_admin.php'; 
}else{
    require 'Views/Plantilla/Menu_usuario.php';
}
?>

<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>PAGO MENSUALIDAD</h1>
    </div>
    <div class="row justify-content-end mt-2">
        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalPagar">Agregar pago</button>
    </div>
    <div class="row mt-2">
        <table class="table table-hover text-center ">
            <thead>
                <tr>
                    <th scope="col">Placa</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Fecha de pago</th>
                    <th scope="col">Fecha de finalización</th>
                </tr>
            </thead>
            <tbody id="tbody">
                
            </tbody>
        </table>
    </div>
 

<!-- Modal -->
<div class="modal fade" id="ModalPagar" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar pago de mensualidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="placa">Placa</label>
            <input type="text" class="form-control" placeholder="ASD123" id="placa">
        </div>
        <div class="form-group">
            <label for="placa">Valor</label>
            <input type="number" class="form-control" min="0" id="valor" placeholder="0">
        </div>
        <div class="form-group">
            <label for="placa">Volver a pagar:</label>
            <input type="date" id="fecha_fin" class="form-control" >
        </div>
        <div id="alerta"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-agregar">Agregar <span id="btn-span"></span> </button>
      </div>
    </div>
  </div>
</div>
    <!-- <div class="row justify-content-center mt-5">

        <div class="card col-5">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" name="placa" id="placa" placeholder="ASD123" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="monto">Monto</label>
                        <input type="number" name="monto" id="monto" placeholder="10000" class="form-control" min="0">
                    </div>
                    <div id="alerta"></div>
                </form>
                <button type="button" class="btn btn-primary col-12" id="btn-confirmar">Confirmar pago <span id="span-confirmar"></span></button>
    
            </div>
        </div>
    </div> -->
    <script src="<?php echo constant('URL'); ?>Public/js/pagos.js"></script>
</div>

<?php require 'Views/Plantilla/Foot.php'; ?>