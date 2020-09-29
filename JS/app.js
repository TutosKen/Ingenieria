$(document).ready(function(){

    $("#login").click(function(){
        $.post("/Animales/PHP/acciones.php",{
            email: $("#Email").val(),
            pass: $("#Contrasenna").val()
        }, function(data,status){
            if (data == "Valido") {
                window.location.replace("/Animales/");
            }else{
                $("#errorInicioSesion").show();
            }
        });
    });

    $("#buscar").keyup(function() { 
        $.post("/Animales/PHP/acciones.php",{
            busqueda: $("#buscar").val()
        }, function(data,status){
            $("#noResult").remove();
            $(".col-md-3").remove();
            $(data).insertAfter("#barraBusqueda");
        });
    });

    $("#emailRegistro").focusout(function(){
        $.post("/Animales/PHP/acciones.php",{
            verEmail: $("#emailRegistro").val()
        }, function(data,status){
            if (data == "Existe") {
                $("#emailExistente").show();
            }else{
                $("#emailExistente").hide();
            }
        });
    });

    $("#usuarioRegistro").focusout(function(){
        $.post("/Animales/PHP/acciones.php",{
            verUsuario: $("#usuarioRegistro").val()
        }, function(data,status){
            if (data == "Existe") {
                $("#usuarioExistente").show();
            }else{
                $("#usuarioExistente").hide();
            }
        });
    });

    $("#cedulaRegistro").focusout(function(){
        $.post("/Animales/PHP/acciones.php",{
            verCedula: $("#cedulaRegistro").val()
        }, function(data,status){
            if (data == "Existe") {
                $("#cedulaExistente").show();
            }else{
                $("#cedulaExistente").hide();
            }
        });
    });

    $("#confPassRegistro").focusout(function(){
        var pass = $("#passRegistro").val();
        var confPass = $("#confPassRegistro").val();

        if (pass != confPass) {
            $("#contraNoCoincide").show();
        }else{
            $("#contraNoCoincide").hide();
        }
    });
    
    $("#passRegistro").focusout(function(){
        var pass = $("#passRegistro").val();
        var confPass = $("#confPassRegistro").val();

        if (pass != confPass) {
            $("#contraNoCoincide").show();
        }else{
            $("#contraNoCoincide").hide();
        }
    });


    $("#registrarse").click(function(){
        if ($("#emailRegistro").val() != "" && $("#nombreRegistro").val() != "" && $("#apellidoRegistro").val()!= "" &&  $("#usuarioRegistro").val() != ""  && $("#passRegistro").val() != "" && $("#confPassRegistro").val() && parseInt($("#PreguntaSecretaRegistro").val()) != 0 && $("#cedulaRegistro").val() != "") {
            $.post("/Animales/PHP/acciones.php",{
                Nombre: $("#nombreRegistro").val(),
                Apellido: $("#apellidoRegistro").val(),
                Email: $("#emailRegistro").val(),
                Cedula: $("#cedulaRegistro").val(),
                Direccion: $("#direccionRegistro").val(),
                Telefono: $("#telefonoRegistro").val(),
                UsuarioR: $("#usuarioRegistro").val(),
                Pass: $("#passRegistro").val(),
                ConfPass: $("#confPassRegistro").val(),
                Pregunta: parseInt($("#PreguntaSecretaRegistro").val()), 
                Respuesta: $("#respuestaRegistro").val()
                
            }, function(data,status){
                if (data == "Exito") {
                    window.location.replace("/Animales/");
                }
            });   
        }else{
            $("#camposIncompletos").show();
        }

    });

    $("#recuperarContra").click(function(){
        if (!$("#emailRecover").val()) {
            $("#correoVacio").show();
        }else{
            $.post("/Animales/PHP/acciones.php",{
                respuestaS: $("#respuestaS").val()
            }, function(data,status){
                if (data == "Exito") {
                    $("#correoEnviado").show();
                    $("#correoNoEnviado").hide();
                }else{
                    $("#correoNoEnviado").show();
                    $("#correoEnviado").hide();
                }
            });
        }
    });

    $("#emailRecover").keyup(function(){
        $.post("/Animales/PHP/acciones.php",{
            emailRecover: $("#emailRecover").val()
        }, function(data,status){
            $("#correoVacio").hide();
            $("#preguntaS").remove();
            $("#respuestaS").remove();
            $(data).insertAfter("#emailRecover");

        });
    });

    $("#limpiarFormRecuperarContra").click(function(){
        $("#preguntaS").remove();
        $("#respuestaS").remove();
        $("#emailRecover").val('');

        $("#correoEnviado").hide();
        $("#correoVacio").hide();
        $("#correoNoEnviado").hide();

        $("#emailRecover").removeAttr('disabled');


    });
 
});