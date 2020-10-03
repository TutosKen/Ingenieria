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
        require_once('../head.php');
        
    ?>
    <title>Recuperar contraseña</title>
</head>
<body>

<div class="card mx-auto border-primary" style="width: 25rem;">
<img class="card-img-top" src="../../img/logo.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title text-center">Animales</h5>

        <div class="form-group" id="password-recover">
            <label class="fuente-custom" for="respuesta">Ingrese su email</label>
            <input type="text" class="form-control form-control-sm" id="emailRecover" placeholder="Email">
        </div>

        <div id="correoEnviado" class="alert alert-success margen" role="alert" style="display:none;">
            Revisa tu correo
        </div>

        <div id="correoNoEnviado" class="alert alert-danger margen" role="alert" style="display:none;">
            Error al enviar el correo
        </div>
        

        <div class="text-center">
            <button id="recuperarContra" class="btn btn-sm btn-success boton-mid-len">Aceptar</button>
            <button id="limpiarFormRecuperarContra" class="btn btn-sm btn-warning boton-mid-len">Limpiar</button>
            <button class="btn btn-danger btn-sm boton-ln mt-3" onclick="window.location.replace('/Animales/')">Cancelar</button>
        </div>
    
  </div>
</div>

</div>

<?php
    require_once('../JS.php');
?>
</body>
</html>