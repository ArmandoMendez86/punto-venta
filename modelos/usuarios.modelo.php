<?php

require_once "conexion.php";

class ModeloUsuarios
{

	/*=============================================
	MOSTRAR USUARIOS O USUARIO
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor)
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
	INGRESAR USUARIO
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

		$columns = array_keys($data);
		$columns = implode(', ', $columns);

		$fields = [];
		$params = [];

		foreach ($data as $key => $value) {
			$fields[] = "{$key} = ?";
			$params[] = $value;
		}

		$id = $data['id'];
		$params[] = intval($id);

		$fields = implode(', ', $fields);

		$sql = "UPDATE venta_servicio SET {$fields} WHERE id = ?";
		$stmt = Conexion::conectar()->prepare($sql);

		if ($stmt) {
			$types = str_repeat('s', count($params) - 1) . 'i';
			$stmt->bindParam($types, ...$params);
			$stmt->execute();
		}
	}
}
