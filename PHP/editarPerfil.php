<?php
session_start();
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
        require_once("../DB/Conectar.php");

        $conn = New Conexion;
        $infoUsuario = $conn->getInfoUsuario($_SESSION['IDUsuario']);

        while($row = mysqli_fetch_assoc($infoUsuario)) {
            $Nombre = $row['Nombre'];
            $Apellido = $row['Apellido'];
            $Correo = $row['Email'];
            $Cedula = $row['Cedula'];
            $Direccion = $row['Direccion'];
            $Telefono = $row['Telefono'];
            $UserName = $row['Nick'];
            $NuevaContra = $row['Clave'];
            $Pregunta = $row['FK_Pregunta'];
            $Respuesta = $row['RespuestaSecreta'];
        }
    ?>
<div class="card mx-auto border-primary" style="width: 40rem;">
  <div class="card-body">
    <h5 class="card-title text-center">Editar perfil</h5>
    <div class="form-group" id="nombreyap">
        <input type="text" id="nombreRegistro" class="form-control" value="<?php echo $Nombre?>" placeholder="Nombre">
        <input type="text" id="apellidoRegistro" class="form-control" placeholder="Apellido" value="<?php echo $Apellido?>">
    </div>

    <div class="form-group" id="info-registro">
        <input type="text" id="emailRegistro" class="form-control fuente-custom" placeholder="Correo electronico" value="<?php echo $Correo?>">
        <div id="emailExistente" class="alert alert-danger margen" role="alert" style="display:none;">
            El correo electronico se encuentra en uso
        </div>
        <input type="text" id="cedulaRegistro" class="form-control fuente-custom margen" placeholder="Cedula" value="<?php echo $Cedula?>">
        <div id="cedulaExistente" class="alert alert-danger margen" role="alert" style="display:none;">
        La cedula se encuentra en uso
        </div>
        <textarea id="direccionRegistro" cols="30" rows="5" class="margen form-control resize-none" placeholder="Direccion(opcional)"><?php echo $Direccion?></textarea>
        <input id="telefonoRegistro" type="text" class="form-control margen" placeholder="Telefono(opcional)" value="<?php echo $Telefono?>">
        <input type="text" id="usuarioRegistro" value="<?php echo $UserName?>" class="form-control margen" placeholder="Nombre de usuario" maxlength="25">

        <div id="usuarioExistente" class="alert alert-danger margen" role="alert" style="display:none;">
            El nombre de usuario se encuentra en uso
        </div>
        
        <input type="password" id="passRegistro" class="form-control margen" placeholder="Nueva contraseña" value="<?php echo $NuevaContra?>">
        <input type="password" id="confPassRegistro" class="form-control margen" placeholder="Confirmar contraseña" value="<?php echo $NuevaContra?>">
        <div id="contraNoCoincide" class="alert alert-danger margen" role="alert" style="display:none;">
            Las contraseñas no coinciden
        </div>
    </div>

    <div class="form-group">
        <select required class="form-control" id="PreguntaSecretaRegistro" style="margin-bottom:10px;">
            <option value='1' <?php echo ($Pregunta == 1) ? "selected" : "" ?>>¿Cual es tu libro favorito?</option>
            <option value='2' <?php echo ($Pregunta == 2) ? "selected" : "" ?> >¿Cual es tu pelicula favorita?</option>
            <option value='3' <?php echo ($Pregunta == 3) ? "selected" : "" ?> >¿Que nombre tenia tu primer mascota?</option>
            <option value='4' <?php echo ($Pregunta == 4) ? "selected" : "" ?> >¿En que ciudad naciste?</option>
            <option value='5' <?php echo ($Pregunta == 5) ? "selected" : "" ?> >¿Cual fue la primera compañia para la que trabajaste?</option>
        </select>
            <input type="text" id="respuestaRegistro" class="form-control" placeholder="Respuesta" required value="<?php echo $Respuesta?>">
    </div>

        <div id="infoModificada" class="alert alert-success margen" role="alert" style="display:none;">
            Datos actualizados
        </div>
        
        <div id="camposIncompletos" class="alert alert-danger margen" role="alert" style="display:none;">
            Debe completar los campos requeridos
        </div>
    
        <div id="contBtnModificar" class="text-center" style="padding:5px;">
            <button id="modificarUsuario" class="boton-ln btn btn-sm btn-success">Editar</button>
            <button class="boton-ln btn btn-sm btn-danger mt-2" onclick="window.location.replace('/Animales/PHP/perfil.php?IDUsuario=<?php echo $_SESSION['IDUsuario'];?>');">Cancelar</button>
        </div>
            

    </div>
</div>

    <?php
        include('JS.php');
    ?>
</body>
</html>