<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo constant('URL')?>">
    <img src="<?php echo constant('URL')?>Public/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Parqueadero</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?php echo ($this->active == 'inicio') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo constant('URL') ?>Admin">Inicio</a>
      </li>
      <li class="nav-item <?php echo ($this->active == 'precios') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo constant('URL') ?>Precios">Precios</a>
      </li>
      <li class="nav-item <?php echo ($this->active == 'pagos') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo constant('URL') ?>Pagos">Pago mensualidad</a>
      </li>
      <!--li class="nav-item <?php echo ($this->active == 'clientes') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo constant('URL') ?>Clientes">Clientes</a>
      </li-->
      <li class="nav-item <?php echo ($this->active == 'busqueda') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo constant('URL') ?>Busqueda">Busqueda</a>
      </li>
      <li class="nav-item <?php echo ($this->active == 'usuarios') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo constant('URL') ?>Usuarios">Usuarios</a>
      </li>
      <li class="nav-item <?php echo ($this->active == 'contrasena') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo constant('URL') ?>Contrasena">Cambiar constraseña</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo constant('URL') ?>logout">Salir</a>
      </li>
    </ul>
  </div>
</nav>