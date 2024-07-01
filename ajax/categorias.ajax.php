<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias
{
    //Editar usuario
    public $idCategoria;
    public $activarIdUsuario;
    public $cambiarEstado;
    public $validarUsuario;

    public function ajaxEditarCategoria()
    {
        $item = "id";
        $valor = $this->idCategoria;
        $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);
        echo json_encode($respuesta);
    }
}

/*=============================================
	CATEGORIA A EDITAR
	=============================================*/
if (isset($_POST["idCategoria"])) {
    $editar = new AjaxCategorias();
    $editar->idCategoria = $_POST["idCategoria"];
    $editar->ajaxEditarCategoria();
}
