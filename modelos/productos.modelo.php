<?php

require_once "conexion.php";

class ModeloProductos
{

    /*=============================================
	MOSTRAR PRODUCTOS O PRODUCTO
	=============================================*/
    static public function mdlMostrarProductos($tabla, $item, $valor)
    {

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            if (is_int($valor)) {
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            } else {
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            }

            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    /*=============================================
	INGRESAR PRODUCTO
	=============================================*/
    static public function mdlIngresarUsuario($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto) VALUES(:nombre, :usuario, :password, :perfil, :foto)");

        $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos['usuario'], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos['password'], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos['perfil'], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos['foto'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }


    /*=============================================
	EDITAR USUARIO
	=============================================*/
    public static function mdlEditarUsuario($data)
    {
        $fields = [];
        $params = [];

        foreach ($data as $key => $value) {
            if ($key != 'id') {
                $fields[] = "{$key} = ?";
                $params[] = $value;
            }
        }

        $fields = implode(', ', $fields);
        $sql = "UPDATE usuarios SET {$fields} WHERE id = ?";
        $params[] = $data['id'];  // Añadir el ID al final del array de parámetros

        $stmt = Conexion::conectar()->prepare($sql);

        if ($stmt) {
            foreach ($params as $index => $param) {
                $stmt->bindValue($index + 1, $param);
            }
            $stmt->execute();
            return "ok";
        } else {
            return "error";
        }
    }


    /*=============================================
	BORRAR PRODUCTO
	=============================================*/
    public static function mdlBorrarUsuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id =:id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }
}
