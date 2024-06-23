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

				$tabla = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $_POST["ingPassword"]) {

					$_SESSION["iniciarSesion"] = "ok";

					echo '<br><div class="alert alert-success">Bienvenido ' . $respuesta["nombre"] . '</div>';

					echo '<script>

						setInterval(()=>{
							window.location = "inicio";
						}, 1500)

					</script>';
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

				var_dump($_FILES["nuevaFoto"]["tmp_name"]);

				list($ancho, $alto) = $_FILES["nuevaFoto"]["tmp_name"];

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				$directorio = "vistas/img/usuarios/" . $_POST["usuario"];
				mkdir($directorio, 0755);
				return;
			}

			$tabla = 'usuarios';

			$datos = array(
				"nombre" => $_POST['nombre'],
				"usuario" => $_POST['usuario'],
				"password" => $_POST['password'],
				"perfil" => $_POST['perfil'],
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
}
