<?php require 'Views/Plantilla/Head.php'; ?>
<?php require 'Views/Plantilla/Menu_admin.php'; ?>

<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>CLIENTES</h1>
    </div>
    <div class="row justify-content-end">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-crear">Agregar</button>
    </div>
    <div class="row mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">PLACA</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Vehículo</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="tabla">


            </tbody>
        </table>
    </div>
    <!-- modal crear -->
    <div class="modal fade" id="modal-crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="placa">Placa</label>
                            <input type="text" class="form-control" name="placa" id="placa" maxlength="7">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="tel" class="form-control" name="telefono" id="telefono" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="mensualidad">Valor Mensualidad</label>
                            <input type="number" id="mensualidad" placeholder="0" min="0" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="custom-select" name="estado" id="estado">
                                <option value="">Selecciona un tipo de estado</option>
                                <option value="1">Al día</option>
                                <option value="0">Moroso</option>
                            </select>
                        </div>
                    </form>
                    <div id="alert"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary col-12" id="btn-crear">Guardar <span id="btn-span"></span> </button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal editar -->
    <div class="modal fade" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="placa-editar">Placa</label>
                            <input type="text" class="form-control" id="placa-editar" name="placa-editar" maxlength="7">
                        </div>
                        <div class="form-group">
                            <label for="nombre-editar">Nombre</label>
                            <input type="text" class="form-control" id="nombre-editar" name="nombre-editar">
                        </div>
                        <div class="form-group">
                            <label for="telefono-editar">Teléfono</label>
                            <input type="text" class="form-control" id="telefono-editar" name="telefono-editar" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="mensualidad-editar">Valor Mensualidad</label>
                            <input type="number" id="mensualidad-editar" placeholder="0" min="0" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="estado-editar">Estado</label>
                            <select class="custom-select" id="estado-editar" name="estado-editar">
                                <option value="1">Al día</option>
                                <option value="0">Moroso</option>
                            </select>
                        </div>
                    </form>
                    <div id="alert-editar"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirmar" data-dismiss="modal">Eliminar</button>
                    <button type="button" class="btn btn-primary" id="btn-actualizar">Actualizar <span id="btn-espan-editar"></span></button>
                </div>
            </div>
        </div>
    </div>

 
    <!-- Modal confrimar -->
    <div class="modal fade" id="modal-confirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Seguro que deseas eliminar este usuario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="btn-confrimar" data-dismiss="modal">Sí, eliminar <span id="span-confirmar"></span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo constant('URL') ?>Public/js/cliente.js"></script>
<?php require 'Views/Plantilla/Foot.php'; ?>