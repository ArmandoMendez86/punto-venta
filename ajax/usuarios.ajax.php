<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios
{
    //Editar usuario
    public $idUsuario;
    public $activarIdUsuario;
    public $cambiarEstado;

    public function ajaxEditarUsuario()
    {
        $item = "id";
        $valor = $this->idUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
        echo json_encode($respuesta);
    }

    //Activar usuario
    public function ajaxActivarUsuario()
    {
        $tabla = "usuarios";
        $item1 = "estado";
        $valor1 = $this->cambiarEstado;
        $item2 = "id";
        $valor2 = $this->activarIdUsuario;

        $respuesta = ModeloUsuarios::mdlActivarUsuario($tabla, $item1, $valor1, $item2, $valor2);
        echo json_encode($respuesta);
    }
}

//Usuario a editar
if (isset($_POST["idUsuario"])) {
    $editar = new AjaxUsuarios();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxEditarUsuario();
}
//Activar usuario
if (isset($_POST["estado"])) {
    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->cambiarEstado = $_POST["estado"];
    $activarUsuario->activarIdUsuario = $_POST["activarIdUsuario"];
    $activarUsuario->ajaxActivarUsuario();
}
