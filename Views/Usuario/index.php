<?php require 'Views/Plantilla/Head.php'; ?>
<?php require 'Views/Plantilla/Menu_usuario.php'; ?>

<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>CONTROL ENTRADAS Y SALIDAS</h1>
    </div>
    <div class="row justify-content-end">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-entrada">Entrada</button>
        <button class="btn btn-danger ml-1" data-toggle="modal" data-target="#modal-salida">Salida</button>
    </div>
    <div class="row mt-5 justify-content-center">
        <table class="table table-striped text-center">
            <thead>
                <th scope="col">Placa</th>
                <th scope="col">Tipo vehículo</th>
                <th scope="col">Hora entrada</th>
            </thead>
            <tbody id="table">
               
            </tbody>
        </table>
    </div>


    <!-- modales -->

    <!-- Modal entrada -->
    <div class="modal fade" id="modal-entrada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Entrada de vehículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div>
                            <div class="form-gruop">
                                <label for="placa">Placa</label>
                                <input type="text" name="placa" id="placa" placeholder="ADS123" class="form-control" maxlength="7">
                            </div>
                            <div class="form-group">
                                <label for="precio">Tipo cobro</label>
                                <select name="precio" id="precio" class="custom-select">
                                    <option value="carro">Hora carro</option>
                                    <option value="moto">Hora moto</option>
                                    <option value="dia_carro">Día carro</option>
                                    <option value="dia_moto">Día moto</option>
                                    <option value="noche_carro">Noche carro</option>
                                    <option value="noche_moto">Noche moto</option>
                                    <option value="mensualidad">Mensualidad</option>
                                </select>

                            </div>
                        </div>
                    </form>
                    <div id="alerta" class="mt-2"></div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary col-12" id="btn-Entrada">Guardar <span id="span-entrada"></span> </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal salida -->
    <div class="modal fade" id="modal-salida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Salida de vehículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="placa-salida">Placa</label>
                            <input type="text" class="form-control" placeholder="ASD123" name="placa-salida" id="placa-salida" maxlength="7">
                        </div>
                        <div id="advert"></div>
                    </form>

                        <h4>
                            Tiempo total: <strong id="horas"></strong>
                        </h4>
                        <h5>
                            Total: <strong id="total"></strong>
                        </h5>
                        <form>
                            <div class="form-group">
                                <label for="efectivo">Efectivo</label>
                                <input type="number" class="form-control" id="efectivo">
                            </div>
                        </form>
                        <p>Cambio: <span id="cambio">0</span></p>
                        <div id="alerta2"></div>
                        <div class="row justify-content-center">
                            <button class="col-10 btn btn-primary" id="btn-pagar">Finzalizar <span id="span-finalizar"></span></button>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo constant('URL');?>Public/js/usuario.js"></script>
<?php require 'Views/Plantilla/Foot.php'; ?>