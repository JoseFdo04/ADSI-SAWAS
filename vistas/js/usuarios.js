	/*=============================================
	SUBIR LA FOTO PARA EL USUARIO
	=============================================*/

    $(".nuevaFoto").change(function(){
        
        var imagen = this.files[0];
       
        
    /*=============================================
	VALIDACION FORMATO DE IMAGEN
	=============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

        $(".nuevaFoto").val("");

            swal({
                title: "Error al subir la imagen",
                text: "¡solo es adminito formato JPG ó PNG!",
                type: "error",
                confirmButtonText: "¡Cerrar!"
             });

         }else if(imagen["size"] >15000000){

            $(".nuevaFoto").val("");

            swal({
                title: "Error al subir la imagen",
                text: "¡El tamaño de la imagen debe ser de maximo 15 MB!",
                type: "error",
                confirmButtonText: "¡Cerrar!"
             });

        

         }else{

            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);

            $(datosImagen).on("load", function(event){

                var rutaImagen = event.target.result;

                $(".previsualizar").attr("src", rutaImagen);
            })

         }

    })


        /*=============================================
	EDITAR USUARIO
	=============================================*/


    $(".btnEditarUsuario").click(function(){

        var idUsuario = $(this).attr("idUsuario");
       

        var datos = new FormData();
        datos.append("idUsuario",idUsuario);

        $.ajax({
            url:"ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

			$("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPerfil").html(respuesta["perfil"]);
            $("#editarPerfil").val(respuesta["perfil"]);
            $("#fotoActual").val(respuesta["foto"]);

            $("#passwordActual").val(respuesta["password"]);
            
            if(respuesta["foto"] != ""){

                $(".previsualizar").attr("src",respuesta["foto"]);

            }

            }

        });
        
    })


        /*=============================================
	ACTIVAR USUARIO
	=============================================*/

    $(".btnActivar").click(function(){

        var idUsuario = $(this).attr("idUsuario");
        var estadoUsuario = $(this).attr("estadoUsuario");

        var datos = new FormData();
            datos.append("activarId", idUsuario);
            datos.append("activarUsuario", estadoUsuario);

            $.ajax({
                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){


                }

            })


            if(estadoUsuario == 0){

                $(this).removeClass('btn-success');
                $(this).addClass('btn-danger');
                $(this).html('Desactivado');
                $(this).attr('estadoUsuario',1);

            }else{

                $(this).addClass('btn-success');
                $(this).removeClass('btn-danger');
                $(this).html('Activado');
                $(this).attr('estadoUsuario',0);
            }

    })


    /*=============================================
	ELIMINAR USUARIO
	=============================================*/

    $(".btnEliminarUsuario").click(function(){

        var idUsuario = $(this).attr("idUsuario");
        var fotoUsuario = $(this).attr("fotoUsuario");
        var usuario = $(this).attr("usuario");

        swal({
            title: '¿Esta Seguro que desea BORRAR el usuario?',
            text: "¡Sino lo esta presione CANCELAR!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Si, borrar Usuario',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar'
         }).then((result)=>{


            if(result.value){

                window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
            }



         })


     })



