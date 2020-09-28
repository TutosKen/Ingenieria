<?php
session_start();
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

<div class="card mx-auto bg-light" style="width: 25rem;">
<img class="card-img-top" src="../img/logo.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title text-center">Animales</h5>

    <form action="login-action.php" method="POST">
        <div class="form-group" id="email-input">
            <label class="fuente-custom" for="Email">Email</label>
            <input type="text" name="email" class="form-control form-control-sm" id="Email" placeholder="Correo electronico">
        </div>

        <div class="form-group" id="pass-input">
            <label class="fuente-custom" for="Contrasenna">Contraseña</label>
            <input type="password" name="pass" class="form-control form-control-sm" id="Contrasenna" placeholder="Contraseña">
        </div>

        <div class="text-center">
            <button type="submit" name="login" class="boton-ln btn btn-sm btn-success">Login</button>
        </div>
        
    </form>
    
  </div>
</div>

<div class="card mx-auto" style="width: 25rem;">
    <div class="card-body">
        <span class="fuente-custom">Nuevo en animales?</span>
        <a href="registro.php" class="fuente-custom">Registrate</a>
    </div>

</div>
</body>
</html>