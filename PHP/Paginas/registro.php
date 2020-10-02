<?php
session_start();
if (isset($_SESSION['IDUsuario'])) {
    header('location: /Animales/');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php 
        require_once('../head.php');
    ?>
    <title>Registro animales</title>
</head>
<body>
    <?php
        require_once('../navbar.php');
    ?>
<div class="card mx-auto border-primary" style="width: 40rem;">
<img class="card-img-top" src="../../img/logo.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title text-center">Animales</h5>

        <div class="form-group" id="nombreyap">
            <p>Complete la siguiente informacion</p>
            <input type="text" id="nombreRegistro" class="form-control" placeholder="Nombre">
            <input type="text" id="apellidoRegistro" class="form-control" placeholder="Apellido">
        </div>

        <div class="form-group" id="info-registro">
            <input type="text" id="emailRegistro" class="form-control fuente-custom" placeholder="Correo electronico">
            <div id="emailExistente" class="alert alert-danger margen" role="alert" style="display:none;">
                El correo electronico se encuentra en uso
            </div>
            <input type="text" id="cedulaRegistro" class="form-control fuente-custom margen" placeholder="Cedula">
            <div id="cedulaExistente" class="alert alert-danger margen" role="alert" style="display:none;">
            La cedula se encuentra en uso
            </div>
            <textarea id="direccionRegistro" cols="30" rows="5" class="margen form-control resize-none" placeholder="Direccion(opcional)"></textarea>
            <input id="telefonoRegistro" type="text" class="form-control margen" placeholder="Telefono(opcional)">
            <input type="text" id="usuarioRegistro" class="form-control margen" placeholder="Nombre de usuario" maxlength="25">
            <div id="usuarioExistente" class="alert alert-danger margen" role="alert" style="display:none;">
                El nombre de usuario se encuentra en uso
            </div>
            <input type="password" id="passRegistro" class="form-control margen" placeholder="Contraseña">
            <input type="password" id="confPassRegistro" class="form-control margen" placeholder="Confirmar contraseña">
            <div id="contraNoCoincide" class="alert alert-danger margen" role="alert" style="display:none;">
            Las contraseñas no coinciden
            </div>
        </div>

        <div class="form-group">
            <select required class="form-control" id="PreguntaSecretaRegistro" style="margin-bottom:10px;">
                <option disabled selected hidden>Escoge una pregunta</option>
                <option value='1'>¿Cual es tu libro favorito?</option>
                <option value='2'>¿Cual es tu pelicula favorita?</option>
                <option value='3'>¿Que nombre tenia tu primer mascota?</option>
                <option value='4'>¿En que ciudad naciste?</option>
                <option value='5'>¿Cual fue la primera compañia para la que trabajaste?</option>
            </select>
            <input type="text" id="respuestaRegistro" class="form-control" placeholder="Respuesta" required>
        </div>

        <div id="camposIncompletos" class="alert alert-danger margen" role="alert" style="display:none;">
            Debe completar los campos requeridos
        </div>

        <div id="contBtnRegistro" class="text-center" style="padding:5px;">
            <button id="registrarse" class="boton-ln btn btn-sm btn-success">Registrarse</button>
        </div>
    
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