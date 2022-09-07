<?php

class ControladorUsuarios{

	
	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

			
				$cifrar = crypt($_POST["ingPassword"], '$2a$07$usesomesillystringforsalt$');

                $tabla = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $cifrar){

					if($respuesta["estado"] ==1){

                    $_SESSION["iniciarSesion"] = "ok";
					$_SESSION["id"] = $respuesta["id"];
					$_SESSION["nombre"] = $respuesta["nombre"];
					$_SESSION["usuario"] = $respuesta["usuario"];
					$_SESSION["foto"] = $respuesta["foto"];
					$_SESSION["perfil"] = $respuesta["perfil"];

					echo '<script>

						window.location = "inicio";

					</script>';

					}else{

						echo '<br>
						<div class="alert alert-danger">El usuario no esta activado</div>';

					}

                }else{

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

                

                }
            }

	    }	
    }

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario(){
		if(isset($_POST["nuevoUsuario"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			  preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			  preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					directorio para almacenar foto del usuario
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

					mkdir($directorio, 0755);

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

							/*=============================================
							GUARDAR IMAGEN EN EL DIRECTORIO
							=============================================*/

							$aleatorio = mt_rand(100,999);
							$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
							$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){
							
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
							
					}
						
				}

				$tabla = "usuarios";

					//CIFRAR CONTRASEÑA
				$cifrar = crypt($_POST["nuevoPassword"], '$2a$07$usesomesillystringforsalt$');

				$datos = array("nombre" => $_POST["nuevoNombre"],
							   "usuario" => $_POST["nuevoUsuario"],
							   "password" => $cifrar,
							   "perfil" => $_POST["nuevoPerfil"]);


				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						swal({

							type: "success",
							title: "¡Usuario Almacenado Correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "usuarios";

							}
						});

						</script>';

				}

					
			  }else{

				echo '<script>

						swal({

							type: "error",
							title: "¡Campo usuario no puede estar vacido ni puede contener caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "usuarios";

							}
						});

						</script>';

			  }
			

		}


	}

		/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){ 

		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================================
	EDITAR USUARIO
	=============================================*/

	public function ctrEditarUsuario(){

		if(isset ($_POST["editarUsuario"])){	
		
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				
	/*=============================================
	VALIDAR IMAGEN
	=============================================*/


				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					directorio para almacenar foto del usuario
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					/*=============================================
					PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);
					}
						
					/*=============================================
					de acuerdo al tipo de imagen aplicamos las funciones de php
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

							/*=============================================
							GUARDAR IMAGEN EN EL DIRECTORIO
							=============================================*/

							$aleatorio = mt_rand(100,999);
							$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";
							$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){
							
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";
						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);		

					}
						
				}

				$tabla = "usuarios";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$cifrar = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$');

					}else{

						echo '<script>

							swal({

								type: "error",
								title: "¡La contraseña no puede estar vacio ni puede contener caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

								}).then((result)=>{

									if(result.value){

									window.location = "usuarios";

									}
								})

						</script>';
					}

				}else{

						$cifrar = $passwordActual; 

				}

				$datos = array("nombre" => $_POST["editarNombre"],
								"usuario" => $_POST["editarUsuario"],
								"password" => $cifrar,
								"perfil" => $_POST["editarPerfil"],
								"foto" => $ruta);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);


				if($respuesta == "ok"){

					echo '<script>

						swal({

							type: "success",
							title: "¡Usuario Editado Correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "usuarios";

							}
						});

						</script>';

				}

			}else{

				echo '<script>

				swal({

					type: "error",
					title: "¡el nombre no puede ir vacio o llevar  caracteres especiales!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then((result)=>{

					if(result.value){

						window.location = "usuarios";

					}
				});

				</script>';

			}
		}
	
	}


		/*=============================================
			ELIMINAR USUARIO
		=============================================*/


		static public function ctrBorrarUsuario(){ 

			if(isset($_GET["idUsuario"])){

				$tabla ="usuarios";
				$datos = $_GET["idUsuario"];

				if($_GET["fotoUsuario"] != ""){

					unlink($_GET["fotoUsuario"]);
					rmdir('vistas/img/usuarios/'.$GET["usuario"]);

				}

				$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						swal({

							type: "success",
							title: "¡Usuario ha sido borrado Correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "usuarios";

							}
						});

						</script>';

				}

			}
		}

}