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
    <title>Registro animales</title>
</head>
<body>
    <?php
        require_once('navbar.php');
    ?>
<div class="card mx-auto border-primary" style="width: 40rem;">
<img class="card-img-top" src="../img/logo.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title text-center">Animales</h5>

    <form action="acciones.php" method="POST">
        <div class="form-group" id="nombreyap">
            <p>Complete la siguiente informacion</p>
            <input type="text" name="email" class="form-control" name="nombre" placeholder="Nombre" required>
            <input type="text" name="email" class="form-control" name="apellido" placeholder="Apellido" required>
        </div>

        <div class="form-group" id="info-registro">
            <input type="text" name="cedula" class="form-control fuente-custom" name="cedula" placeholder="Cedula(opcional)">
            <textarea name="direccion" cols="30" rows="5" class="margen form-control resize-none" placeholder="Direccion(opcional)"></textarea>
            <input type="text" class="form-control margen" placeholder="Telefono(opcional)">
            <input type="text" id="User" class="form-control margen" placeholder="Nombre de usuario">
            <input type="password" class="form-control margen" placeholder="Contraseña">
            <input type="password" class="form-control margen" placeholder="Confirmar contraseña">
        </div>

        <div class="form-group">
            <select required class="form-control" name="PreguntaSecreta" style="margin-bottom:10px;">
                <option disabled selected hidden>Escoge una pregunta</option>
                <option>¿Cual es tu libro favorito?</option>
                <option>¿Cual es tu pelicula favorita?</option>
                <option>¿Que nombre tenia tu primer mascota?</option>
                <option>¿En que ciudad naciste?</option>
                <option>¿Cual fue la primera compañia para la que trabajaste?</option>
            </select>
            <input type="text" class="form-control" placeholder="Respuesta">
        </div>

        <div class="text-center">
            <button type="submit" name="login" class="boton-ln btn btn-sm btn-success">Registrarse</button>
        </div>
        
    </form>
    
  </div>
</div>

<div class="tarjeta card mx-auto border-primary" style="width: 40rem;">
    <div class="card-body text-center">
        <span class="fuente-custom">Ya tienes cuenta?</span>
        <a href="login.php" class="fuente-custom">Inicia sesion</a>
    </div>

</div>

    <?php
        require_once('../JS.php');
    
    ?>
</body>
</html>