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
            $(data).insertAfter("#btnFiltro");
        });
    });

    $(".especial").click(function() {
        var nombreCat = $(this).html();
        $.post("/Animales/PHP/acciones.php",{
            NombreCat: nombreCat
        }, function(data,status){
            $("#noResult").remove();
            $(".col-md-3").remove();
            $(data).insertAfter("#btnFiltro");
        });
    });

    $("#emailRegistro").keyup(function(){
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

    $("#usuarioRegistro").keyup(function(){
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

    $("#cedulaRegistro").keyup(function(){
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

    $("#confPassRegistro").keyup(function(){
        var pass = $("#passRegistro").val();
        var confPass = $("#confPassRegistro").val();

        if (pass != confPass) {
            $("#contraNoCoincide").show();
        }else{
            $("#contraNoCoincide").hide();
        }
    });
    
    $("#passRegistro").keyup(function(){
        var pass = $("#passRegistro").val();
        var confPass = $("#confPassRegistro").val();

        if (pass != confPass) {
            $("#contraNoCoincide").show();
        }else{
            $("#contraNoCoincide").hide();
        }
    });

    $("#contBtnRegistro").mouseover(function() {
        if ($("#emailExistente").is(":visible") || $("#usuarioExistente").is(":visible") || $("#cedulaExistente").is(":visible") || $("#contraNoCoincide").is(":visible")) {
            $("#registrarse").attr('disabled','');
        }else{
            $("#registrarse").removeAttr('disabled');
        }
    });

    $("#contBtnModificar").mouseover(function() {
        if ($("#emailExistente").is(":visible") || $("#usuarioExistente").is(":visible") || $("#cedulaExistente").is(":visible") || $("#contraNoCoincide").is(":visible")) {
            $("#modificarUsuario").attr('disabled','');
        }else{
            $("#modificarUsuario").removeAttr('disabled');
        }
    });

    $("#modificarPerfil").click(function() {
        window.location.replace("/Animales/PHP/editarPerfil.php");
    });


    $("#contBtnModificar").focusout(function(){
        $("#infoModificada").hide();
    });

    $("#modificarUsuario").click(function(){
        if ($("#emailRegistro").val() != "" && $("#nombreRegistro").val() != "" && $("#apellidoRegistro").val()!= "" &&  $("#usuarioRegistro").val() != ""  && $("#passRegistro").val() != "" && $("#confPassRegistro").val() && parseInt($("#PreguntaSecretaRegistro").val()) != 0 && $("#cedulaRegistro").val() != "") {
            $.post("/Animales/PHP/acciones.php",{
                NombreEditado: $("#nombreRegistro").val(),
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
                    $("#infoModificada").show();
                }
            });   
        }else{
            $("#camposIncompletos").show();
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

    $("#eliminarCuenta").click(function() {
        $.post("/Animales/PHP/acciones.php",{
            EliminarCuenta: 'true'
        }, function(data,status){
            if (data == "Exito") {
                window.location.replace("/Animales/");
            }
        });
    });

    $("#URI").keyup(function() {
        var imagen = $("#preview");
        $("#subirImagen").val('');

        if ($("#URI").val() == '') {
            imagen.attr("src","/Animales/img/imgsPagina/default.jpg");
        }else{
            imagen.attr("src",$("#URI").val());   
        }
    });

    $("#agregarImagen").click(function (){
        var cats = [];
        var fd = new FormData(); 
        var tituloImg  = $("#titulo").val();
        var URIImg = $("#URI").val();
        var descImg = $("#desc").val();
        var tagsImg = $("#tags").val();
        var files = $('#subirImagen')[0].files[0]; 

        $('input:checked').each(function (){
            cats.push($(this).val());
        });
        cats.join(',');

        fd.append('file', files); 
        fd.append('cat',cats);
        fd.append('titulo',tituloImg);
        fd.append('URI',URIImg);
        fd.append('desc',descImg);
        fd.append('tags',tagsImg);

        $.ajax({ 
            url: '/Animales/PHP/agregarImagen.php', 
            type: 'post', 
            data: fd, 
            contentType: false, 
            processData: false, 
            success: function(response){ 
                if(response != 0){ 
                    $("#publicacionCorrecta").show();
                } 
                else{ 
                    $("#errorSubida").show();
                } 
            }, 
        }); 

        $("#subirImagen").val('');
        $("#URI").val('');
        $("#titulo").val('');
        $("#desc").val('');
        $("#tags").val('');
        $("input:checked").prop("checked", false);
        $("#preview").attr('src','/Animales/img/imgsPagina/default.jpg')

    });


    $("#subirImagen").click(function() {
        $("#URI").val('');
    });
 

    $("#SubidaPost").mouseover(function(){
        if ((!$('#subirImagen').val() && !$("#URI").val()) || !$("#titulo").val() || $('input:checkbox:checked').length == 0) {
            $("#agregarImagen").attr('disabled','');
        }else{
            $("#agregarImagen").removeAttr('disabled');
        }
    });

    $("#SubidaPost").mouseover(function(){
        if ($('input:checkbox:checked').length == 0) {
            $("#errorCat").show();
        }else{
            $("#errorCat").hide();
        }
    });

    $("#URI").focusout(function(){
        if ((!$('#subirImagen').val() && !$("#URI").val())){
            $("#errorArchivo").show();
        }else{
            $("#errorArchivo").hide();
        }
    });

    $("#titulo").focusout(function(){
        if (!$("#titulo").val()) {
            $("#errorTitulo").show();
        }else{
            $("#errorTitulo").hide();
        }
    });
});