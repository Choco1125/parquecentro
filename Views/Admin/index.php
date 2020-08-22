<?php require 'Views/Plantilla/Head.php'; ?>
<?php require 'Views/Plantilla/Menu_admin.php'; ?>

<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>PANEL DE CONTROL</h1>
    </div>
    <div class="row mt-5 justify-content-end">
        <p>Dinero en caja: <span id="total">0</span></p>
    </div>
    <div class="row mt-1 justify-content-center">
        <table class="table table-striped text-center">
            <thead>
                <th scope="col">Placa</th>
                <th scope="col">Tipo vehículo</th>
                <th scope="col">Hora entrada</th>
                <th scope="col">Hora salida</th>
                <th scope="col">Valor</th>
            </thead>
            <tbody id="table">
               
            </tbody>
        </table>
    </div>
</div>
<script src="<?php echo constant('URL')?>Public/js/admin.js"></script>
<?php require 'Views/Plantilla/Foot.php'; ?>