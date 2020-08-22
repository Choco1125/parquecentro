<?php require 'Views/Plantilla/Head.php'; ?>
<?php require 'Views/Plantilla/Menu_admin.php'; ?>

<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>USUARIOS</h1>
    </div>
    <div class="row justify-content-end mt-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalCrear">Crear</button>
    </div>
    <div class="row mt-2">
        <table class="table table-hover text-center">
            <thead>
                <th scope="col">Usuario</th>
                <th scope="col">Rol</th>
                <th scope="col">Estado</th>
                <th scope="col"></th>
            </thead>
            <tbody id="tablaUsuarios">

            </tbody>
        </table>
    </div>


    <!-- crear usuario -->

    <div class="modal fade" id="ModalCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Usuario Nuevo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate id="form-crear">
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuario" id="usuario" placeholder="Usuario" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>

                            <select class="custom-select" id="rol">
                                <option selected value="">Selecciona un rol</option>
                                <option value="admin">Administrador</option>
                                <option value="usuario">Usuario</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>

                            <select class="custom-select" id="estado">
                                <option selected value="">Selecciona un estado</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </form>
                    <div id="alert-crear"></div>
                    <button type="button" class="btn btn-primary col-12" id="btn-crear">Crear <span id="btn-span"></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- editar usuario -->

    <div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate id="form-editar">
                        <div class="form-group">
                            <label for="usuario-editar">Usuario</label>
                            <input type="text" name="usuario-editar" id="usuario-editar" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>

                            <select class="custom-select" id="rol-editar">
                                <option value="admin">Administrador</option>
                                <option value="usuario">Usuario</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>

                            <select class="custom-select" id="estado-editar">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </form>
                    <div id="alert-editar"></div>
                    <button type="button" class="btn btn-primary col-12" id="btn-actualizar">Actualizar <span id="btn-span-actualizar"></span></button>
                    <button type="button" class="btn btn-danger mt-1 col-12" data-toggle="modal" data-target="#confirmar" onclick="$('#ModalEditar').modal('hide');">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás deguro que quieres eliminar el usuario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-eliminar">Sí, eliminar <span id="btn-span-eliminar"></span></button>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="<?php echo constant('URL') ?>Public/js/usuarios.js"></script>
<?php require 'Views/Plantilla/Foot.php'; ?>