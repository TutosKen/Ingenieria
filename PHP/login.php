<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('location: /Animales/');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php 
        require_once('head.php');
        
    ?>
    <title>Iniciar sesion animales</title>
</head>
<body>

<div class="card mx-auto border-primary" style="width: 25rem;">
<img class="card-img-top" src="../img/logo.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title text-center">Animales</h5>

        <div class="form-group" id="email-input">
            <label class="fuente-custom" for="Email">Email</label>
            <input type="text" class="form-control form-control-sm" id="Email" placeholder="Correo electronico">
        </div>

        <div class="form-group" id="pass-input">
            <label class="fuente-custom" for="Contrasenna">Contraseña</label>
            <input type="password" class="form-control form-control-sm" id="Contrasenna" placeholder="Contraseña">
        </div>

        <div id="errorInicioSesion" class="alert alert-danger" role="alert" style="display:none;">
            Error usuario o contraseña incorrectos
        </div>

        <div class="text-center">
            <button id="login" class="boton-ln btn btn-sm btn-success">Login</button>
        </div>
    
  </div>
</div>

<div class="card mx-auto border-primary" style="width: 25rem;">
    <div class="card-body">
        <span class="fuente-custom">Nuevo en animales?</span>
        <a href="registro.php" class="fuente-custom">Registrate</a>
    </div>

</div>

<?php
    include('JS.php');
?>
</body>
</html>