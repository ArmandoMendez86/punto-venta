<?php

class ControladorProductos
{


    /*=============================================
	MOSTRAR PRODUCTOS O PRODUCTO
	=============================================*/
    static public function ctrMostrarProductos($item, $valor)
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

        return $respuesta;
    }
}
