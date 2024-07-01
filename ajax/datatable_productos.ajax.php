<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductos
{
    /*=============================================
	MOSTRAR TABLA PRODUCTOS
	=============================================*/
    public function mostrarTablaProductos()
    {

        $botones = "<div class='text-center'><button class='btn btn-warning btnEditarProducto' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto'><i class='fa fa-times'></i></button></div>";

        $item = null;
        $valor = null;

        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

        $datosJson = '
        {
            "data":[';

        for ($i = 0; $i < count($productos); $i++) {
            $imagen = "<img src='" . $productos[$i]["imagen"] . "' width='40px'>";
            $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . $imagen . '",
                    "' . $productos[$i]["codigo"] . '",
                    "' . $productos[$i]["descripcion"] . '",
                    "' . $productos[$i]["id_categoria"] . '",
                    "' . $productos[$i]["stock"] . '",
                    "' . $productos[$i]["precio_compra"] . '",
                    "' . $productos[$i]["precio_venta"] . '",
                    "' . $productos[$i]["ventas"] . '",
                    "' . $productos[$i]["fecha"] . '",
                    "' . $botones . '"
                ],';
        }

        //$datosJson = substr($datosJson, 0, -1);
        $datosJson .= ']}';

        echo $datosJson;
    }
}


/*=============================================
	ACTIVAR TABLA PRODUCTOS
	=============================================*/
$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();
