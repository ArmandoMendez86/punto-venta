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

					$_SESSION["iniciarSesion"] = "ok";
					$_SESSION["nombre"] = $respuesta["nombre"];
					$_SESSION["usuario"] = $respuesta["usuario"];
					$_SESSION["foto"] = $respuesta["foto"];

					echo '<br><div class="alert alert-success">Bienvenido ' . $respuesta["nombre"] . '</div>';

					echo '	<script>
							setInterval(() => {
								window.location = "inicio";
							}, 1500);
    						</script>
							';
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
		if (
			preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ ]+$/', $_POST["nombre"]) &&
			preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"]) &&
			preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])

		) {

			if (isset($_FILES["nuevaFoto"]["tmp_name"])) {

				$ruta = "";

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
				Swal.fire("Usuario agregado!");
				</script>
			
			';
			}
		} else {
			echo '
				<script>
				Swal.fire("Intentalo de nuevo!");
				</script>
			
			';
		}
	}

	static public function ctrMostrarUsuarios($item, $valor)
	{
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
		return $respuesta;
	}
}
