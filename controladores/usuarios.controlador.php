<?php

class ControladorUsuarios
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/
	public function ctrIngresoUsuario()
	{

		if (isset($_POST["ingUsuario"])) {

			if (
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
			) {

				$contraseñaIngresada = $_POST["ingPassword"];

				$tabla = "usuarios";
				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				// Obtén el usuario desde la base de datos
				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				// Verifica que el usuario exista y la contraseña sea correcta
				if ($respuesta && password_verify($contraseñaIngresada, $respuesta["password"])) {

					if ($respuesta["estado"] == 1) {
						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["foto"] = $respuesta["foto"];


						date_default_timezone_set("America/Mexico_City");
						$fecha = date("Y-m-d");
						$hora = date("H:i:s");

						$fechaActual = $fecha . " " . $hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;
						$item2 = "id";
						$valor2 = $respuesta["id"];

						$registrarUltimoLogin = ModeloUsuarios::mdlActivarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						if ($registrarUltimoLogin == "ok") {
							echo '<br><div class="alert alert-success">Bienvenido ' . $respuesta["nombre"] . '</div>';

							echo '	<script>
									setInterval(() => {
										window.location = "inicio";
									}, 1500);
									</script>
									';
						}
					} else {
						echo '<br><div class="alert alert-danger">Cuenta inactiva</div>';
					}
				} else {
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
				}
			}
		}
	}

	/*=============================================
	CREAR USUARIO
	=============================================*/
	static public function ctrCrearUsuario()
	{
		if ($_POST["usuario"]) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ ]+$/', $_POST["nombre"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])

			) {

				//Validar imagen

				$ruta = "";

				if (isset($_FILES["nuevaFoto"]["tmp_name"])) {


					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					$directorio = "vistas/img/usuarios/" . $_POST["usuario"];
					mkdir($directorio, 0755);

					//imagen tipo jpeg

					if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {

						$aleatorio = mt_rand(100, 999);
						$ruta = "vistas/img/usuarios/" . $_POST["usuario"] . "/" . $aleatorio . ".jpeg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);

						// Libera memoria
						imagedestroy($origen);
						imagedestroy($destino);
					}
					//imagen tipo png

					if ($_FILES["nuevaFoto"]["type"] == "image/png") {

						$aleatorio = mt_rand(100, 999);
						$ruta = "vistas/img/usuarios/" . $_POST["usuario"] . "/" . $aleatorio . ".png";
						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);

						// Libera memoria
						imagedestroy($origen);
						imagedestroy($destino);
					}
				}

				$tabla = 'usuarios';

				// Paso 1: Recibir la contraseña del usuario
				$contraseña = $_POST["password"];

				// Paso 2: Encriptar la contraseña usando password_hash
				$hash = password_hash($contraseña, PASSWORD_BCRYPT);


				$datos = array(
					"nombre" => $_POST['nombre'],
					"usuario" => $_POST['usuario'],
					"password" => $hash,
					"perfil" => $_POST['perfil'],
					"foto" => $ruta,
				);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				if ($respuesta == 'ok') {
					echo '
					<script>
					window.location = "usuarios";
					</script>
				
				';
				}
			} else {
				echo '
					<script>
					window.location = "usuarios";
					</script>
				';
			}
		}
	}

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/
	static public function ctrMostrarUsuarios($item, $valor)
	{
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/
	static public function ctrEditarUsuario()
	{
		if (isset($_POST["editarNombre"]) && !empty($_POST["editarNombre"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ ]+$/', $_POST["editarNombre"])) {

				// VALIDAR IMAGEN
				$ruta = "";
				$datos = array();

				$datos["nombre"] = $_POST["editarNombre"];
				$datos["usuario"] = $_POST["editarUsuario"];

				if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					$directorio = "vistas/img/usuarios/" . $_POST["editarUsuario"];

					if (!empty($_POST["fotoActual"])) {
						unlink($_POST["fotoActual"]);
					}

					if (!is_dir($directorio)) {
						mkdir($directorio, 0755);
					}

					// IMAGEN TIPO JPEG
					if ($_FILES["editarFoto"]["type"] == "image/jpeg") {
						$aleatorio = mt_rand(100, 999);
						$ruta = "vistas/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".jpeg";
						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);

						// Libera memoria
						imagedestroy($origen);
						imagedestroy($destino);

						$datos["foto"] = $ruta;
					}

					// IMAGEN TIPO PNG
					if ($_FILES["editarFoto"]["type"] == "image/png") {
						$aleatorio = mt_rand(100, 999);
						$ruta = "vistas/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".png";
						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);

						// Libera memoria
						imagedestroy($origen);
						imagedestroy($destino);

						$datos["foto"] = $ruta;
					}
				}

				if ($_POST["editarPerfil"] != "") {
					$datos["perfil"] = $_POST["editarPerfil"];
				}

				$contraseña = $_POST["editarPassword"];
				$hash = "";

				if ($_POST["editarPassword"] != "") {
					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
						$hash = password_hash($contraseña, PASSWORD_BCRYPT);
						$datos["password"] = $hash;
					} else {
						echo '
							<script>
							Swal.fire("La contraseña no cumple los requisitos!");
							</script>
						';
						// Return para salir del método si la contraseña no es válida
						return;
					}
				}

				$datos["id"] = $_POST["idUsuario"];

				$respuesta = ModeloUsuarios::mdlEditarUsuario($datos);

				if ($respuesta == "ok") {
					echo '
						<script>
						window.location = "usuarios";
						</script>
					';
				}
			} else {
				echo '
					<script>
					Swal.fire({
						icon: "error",
						title: "Oops...",
						text: "Los campos no pueden contener caracteres especiales!",
					});
					setTimeout(()=>{
						window.location = "usuarios";
					}, 1500)
					</script>
				';
			}
		}
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/
	static public function ctrBorrarUsuario()
	{
		if (isset($_GET["idUsuario"])) {
			$tabla = "usuarios";
			$datos = $_GET["idUsuario"];

			if ($_GET["fotoUsuario"] != "") {
				unlink($_GET["fotoUsuario"]);
				rmdir("vistas/img/usuarios/" . $_GET["usuario"]);
			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);
			if ($respuesta == "ok") {
				echo '
					<script>
						window.location = "usuarios";
					</script>
				';
			}
		}
	}
}
