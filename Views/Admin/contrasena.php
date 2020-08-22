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
        <h1>CAMBIAR CONTRASEÑA</h1>
    </div>
    <div class="row justify-content-center">
        <div class="card col-5 mt-5">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="contrasena-vieja">Contraseña antigua</label>
                        <input type="password" name="contrasena-vieja" id="contrasena-vieja" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contrasena-nueva">Contraseña nueva</label>
                        <input type="password" name="contrasena-nueva" id="contrasena-nueva" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contrasena-confirm">Confirma la contraseña </label>
                        <input type="password" name="contrasena-confirm" id="contrasena-confirm" class="form-control">
                    </div>
                </form>
                <div id="alerta"></div>
                <button class="btn btn-primary col-12" id="btn-actualizar">Actualizar <span id="span-actualizar"></span></button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo constant('URL')?>Public/js/contrasena.js"></script>
<?php require 'Views/Plantilla/Foot.php'; ?>