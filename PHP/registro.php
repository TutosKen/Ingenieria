<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once('head.php');
    ?>
    <title>Animales</title>
</head>
<body>

<div class="card mx-auto" style="width: 30rem;">
<img class="card-img-top" src="../img/logo.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title text-center">Animales</h5>

    <form action="registro-action.php" method="POST">
        <div class="form-group" id="info-registro">
            <p>Informacion general</p>
            <input type="text" name="email" class="form-control fuente-custom" id="Nombre" placeholder="Nombre">
            <input type="text" name="email" class="form-control fuente-custom" id="Apellido" placeholder="Apellido">
        </div>

        <div class="form-group" id="pass-registro">
            <label class="fuente-custom" for="Contrasenna">Contraseña</label>
            <input type="password" name="pass" class="form-control" id="Contrasenna" placeholder="Contraseña">
        </div>

        <div class="text-center">
            <button type="submit" name="login" class="boton-ln btn btn-sm btn-success">Login</button>
        </div>
        
    </form>
    
  </div>
</div>

<div class="card mx-auto" style="width: 18rem;">
    <div class="card-body">
        <span class="fuente-custom">Nuevo en animales?</span>
        <a href="PHP/registro.php" class="fuente-custom">Registrate</a>
    </div>

</div>

    <?php
        require_once('../JS.php');
    
    ?>
</body>
</html>