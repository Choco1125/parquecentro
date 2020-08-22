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
        <h1>PANEL DE BÚSQUEDA</h1>
    </div>
    <div class="row justify-content-end mt-5">
        <form>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Placa" id="placa" maxlength="7">
                </div>
                <div class="col">
                    <input type="date" class="form-control" id="fecha">
                </div>
            </div>
        </form>
    </div>
    <div class="row mt-3 justify-content-center">
        <table class="table table-striped text-center">
            <thead>
                <th scope="col">Placa</th>
                <th scope="col">Tipo vehículo</th>
                <th scope="col">Hora entrada</th>
                <th scope="col">Hora salida</th>
                <th scope="col">Valor</th>
                <th scope="col">Fecha entrada</th>
            </thead>
            <tbody id="table">

            </tbody>
        </table>
    </div>
</div>
<script src="<?php echo constant('URL') ?>Public/js/busqueda.js"></script>
<?php require 'Views/Plantilla/Foot.php'; ?>