<?php

class ControladorCategorias
{


    /*=============================================
	CREAR CATEGORÍA
	=============================================*/
    static public function ctrCrearCategoria()
    {

        if (isset($_POST["categoria"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ ]+$/', $_POST["categoria"])
            ) {

                $tabla = "categorias";

                $datos = $_POST["categoria"];

                $respuesta = ModeloCategorias::mdlCrearCategoria($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '
                    <script>
                    window.location = "categorias";
                    </script>
                ';
                }
            } else {
                echo '
					<script>
					Swal.fire({
						icon: "error",
						title: "Oops...",
						text: "La categoría no puede ir vacía o tener caracteres especiales!",
					});
					</script>
				';
            }
        }
    }

    /*=============================================
	MOSTRAR CATEGORÍA O CATEGORIAS
	=============================================*/
    static public function ctrMostrarCategorias($item, $valor)
    {
        $tabla = "categorias";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
	EDITAR CATEGORIA
	=============================================*/
    static public function ctrEditarCategoria()
    {
        if (isset($_POST["editarCategoria"]) && !empty($_POST["editarCategoria"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ ]+$/', $_POST["editarCategoria"])) {

                $tabla = "categorias";
                $datos = array(
                    "id" => $_POST["idCategoria"],
                    "categoria" => $_POST["editarCategoria"]
                );
                $respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '
						<script>
						window.location = "categorias";
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
						window.location = "categorias";
					}, 1500)
					</script>
				';
            }
        }
    }

    /*=============================================
	BORRAR CATEGORIA
	=============================================*/
    static public function ctrBorrarCategoria()
    {
        if (isset($_GET["idCategoria"])) {
            $tabla = "categorias";
            $datos = $_GET["idCategoria"];

            $respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);
            if ($respuesta == "ok") {
                echo '
					<script>
						window.location = "categorias";
					</script>
				';
            }
        }
    }
}
