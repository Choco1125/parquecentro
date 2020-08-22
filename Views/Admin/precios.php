<?php require 'Views/Plantilla/Head.php'; ?>
<?php require 'Views/Plantilla/Menu_admin.php'; ?>

<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>PRECIOS</h1>
    </div>
    <div class="row justify-content-around mt-4">
        <div class="card text-center mt-3 ml-1 mr-1 col-3" style="width: 17rem;">
            <div class="card-body">
                <h4 class="card-title">
                    Hora Carro
                </h4>
                <p class="card-content" id="precio-carro">
                    0
                </p>
                <button class="btn btn-light text-primary" id="carro" data-toggle="modal" data-target="#modal-precio">
                    Editar
                </button>
            </div>
        </div>
        <div class="card text-center mt-3 ml-1 mr-1 col-3" style="width: 17rem;">
            <div class="card-body">
                <h4 class="card-title">
                    Hora Moto
                </h4>
                <p class="card-content" id="precio-moto">
                    0
                </p>
                <button class="btn btn-light text-primary" id="moto" data-toggle="modal" data-target="#modal-precio">
                    Editar
                </button>
            </div>
        </div>
        <div class="card text-center mt-3 ml-1 mr-1 col-3" style="width: 17rem;">
            <div class="card-body">
                <h4 class="card-title">
                    Noche Carro 
                </h4>
                <p class="card-content" id="precio-noche-carro">
                    0
                </p>
                <button class="btn btn-light text-primary" data-toggle="modal" id="noche_carro" data-target="#modal-precio">
                    Editar
                </button>
            </div>
        </div>
        <div class="card text-center mt-3 ml-1 mr-1 col-3" style="width: 17rem;">
            <div class="card-body">
                <h4 class="card-title">
                    Noche Moto
                </h4>
                <p class="card-content" id="precio-noche-moto">
                    0
                </p>
                <button class="btn btn-light text-primary" data-toggle="modal" id="noche_moto" data-target="#modal-precio">
                    Editar
                </button>
            </div>
        </div>
        <div class="card text-center mt-3 ml-1 mr-1 col-3" style="width: 17rem;">
            <div class="card-body">
                <h4 class="card-title">
                    Día Carro
                </h4>
                <p class="card-content" id="precio-dia-carro">
                    0
                </p>
                <button class="btn btn-light text-primary" data-toggle="modal" id="dia_carro" data-target="#modal-precio">
                    Editar
                </button>
            </div>
        </div>
        <div class="card text-center mt-3 ml-1 mr-1 col-3" style="width: 17rem;">
            <div class="card-body">
                <h4 class="card-title">
                    Día Moto
                </h4>
                <p class="card-content" id="precio-dia-moto">
                    0
                </p>
                <button class="btn btn-light text-primary" data-toggle="modal" id="dia_moto" data-target="#modal-precio">
                    Editar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-precio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar precio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" placeholder="1000" class="form-control" min="0" id="valor">
                        </div>
                    </form>
                    <div id="alerta"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="actualizar">Actualizar <span id="span"></span></button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo constant('URL') ?>Public/js/precios.js"></script>
</div>

<?php require 'Views/Plantilla/Foot.php'; ?>