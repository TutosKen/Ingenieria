<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <title>Animales</title>
</head>
<body>

<div class="card mx-auto" style="width: 18rem;">
<img class="card-img-top" src="img/logo.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title text-center">Animales</h5>

    <form action="PHP/login.php" method="POST">
        <div class="form-group" id="email-input">
            <label class="fuente-custom" for="Email">Email</label>
            <input type="text" name="email" class="form-control fuente-custom" id="Email" placeholder="Correo electronico">
        </div>

        <div class="form-group" id="pass-input">
            <label class="fuente-custom" for="Contrasenna">Contraseña</label>
            <input type="password" name="pass" class="form-control" id="Contrasenna" placeholder="Contraseña">
        </div>

        <div class="text-center">
            <button type="submit" name="login" class="boton-ln btn btn-sm btn-success">Login</button>
        </div>
        
    </form>
    
  </div>
</div>
<br>
<div class="card mx-auto" style="width: 18rem;">
    <div class="card-body">
        <span class="fuente-custom">Nuevo en animales?</span>
        <a href="PHP/registro.php" class="fuente-custom">Registrate</a>
    </div>

</div>


    <script src="JS/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" 
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</body>
</html>