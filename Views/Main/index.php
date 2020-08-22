<?php require 'Views/Plantilla/Head.php'; ?>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="card p-2 col-4">
            <div class="card-body">
                <h4 class="card-title text-center">
                    INICIO DE SESIÓN
                </h4>
                <form class="mt-4">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" require placeholder="Usuario" id="usuario">
                    </div>
                    <div class="form-group">
                        <label for="contrasena">Contraseña</label>
                        <input type="password" class="form-control" require placeholder="Contraseña" id="contrasena">
                    </div>
                </form>
                <div id="alerta"></div>
                <button class="btn btn-primary col-12" id="btn-loggear">Ingresar <span id="span-ingresar"></span></button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo constant('URL')?>Public/js/main.js"></script>
<?php require 'Views/Plantilla/Foot.php'; ?>