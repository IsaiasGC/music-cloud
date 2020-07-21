<?php
header("Content-Type: application/json");
include('../../core/musiccloud.class.php');
class Usuario extends Musiccloud{
	
	function __construct(){
		
	}
	function leerUsuarios($id_usuario=null){
		$sqlPart="";
		$parametros=array();
		if (!is_null($id_usuario)) {
			if (is_numeric($id_usuario)) {
				$sqlPart=" WHERE id_usuario=:id_usuario";
				$parametros=array(':id_usuario'=>$id_usuario);
			}
		}
		$sql="SELECT * FROM usuario".$sqlPart;
		$datos=$this->queryArray($sql, $parametros);
		return $datos;
	}
	function crearUsuario(){
		$cadena=file_get_contents("php://input");
		$cadena=json_decode($cadena);
		$correo=$cadena[0]->correo;
		$contrasenia=md5($cadena[0]->contrasenia);
		$nombre=$cadena[0]->nombre;
		$usuario=$cadena[0]->usuario;
		$this->conexion();
		$this->db->beginTransaction();
		$sql="INSERT INTO usuario(correo, contrasenia, nombre, usuario) VALUES(:correo, :contrasenia, :nombre, :usuario)";
		$stm=$this->db->prepare($sql);
		$stm->bindParam(":correo", $correo);
		$stm->bindParam(":contrasenia", $contrasenia);
		$stm->bindParam(":nombre", $nombre);
		$stm->bindParam(":usuario", $usuario);
		$stm->execute();
		$param=array(":correo"=>$correo);
		$user=$this->queryArray2($this, "SELECT id_usuario FROM usuario WHERE correo=:correo", $param);
		$id_usuario=$user[0]['id_usuario'];
		$sql="INSERT INTO rol_usuario(id_rol, id_usuario) VALUES(:id_rol, :id_usuario)";
		$stm=$this->db->prepare($sql);
		$stm->bindParam(":id_rol", $cadena[0]->rol->id_rol);
		$stm->bindParam(":id_usuario", $id_usuario);
		$stm->execute();
		$datos['estatus']="OK";
		$datos['mensaje']="Se inserto correctamente el usuario y su rol";
		$datos['id_usuario']=$id_usuario;
		$this->db->commit();
		return $datos;
	}
	function eliminarUsuarios($id_usuario){
		if (is_numeric($id_usuario)) {
			$sql="DELETE FROM usuario WHERE id_usuario=:id_usuario";
			$this->conexion();
			$stm=$this->db->prepare($sql);
			$stm->bindParam(":id_usuario", $id_usuario);
			$stm->execute();
			$fila=$stm->rowCount();
			if ($fila>0) {
				$datos['estatus']="OK";
				$datos['mensaje']="Se elimino el Usuario ".$id_usuario;
			}else{
				$datos['estatus']="NO";
				$datos['mensaje']="No se encontro el usuario";
			}
		}else{
			$datos['estatus']="NO";
			$datos['mensaje']="Se requiere un id valido";
		}
		return $datos;
	}
	function actualizarUsuario($id_usuario){
		if (is_numeric($id_usuario)) {
			$cadena=file_get_contents("php://input");
			$cadena=json_decode($cadena);
			$correo=$cadena[0]->correo;
			$contrasenia=$cadena[0]->contrasenia;
			$nombre=$cadena[0]->nombre;
			$usuario=$cadena[0]->usuario;
			$this->conexion();
			$this->db->beginTransaction();
			if(strlen($contrasenia)>0){
				$contrasenia=md5($contrasenia);
				$sql="UPDATE usuario set correo=:correo, contrasenia=:contrasenia, nombre=:nombre, usuario=:usuario WHERE id_usuario=:id_usuario";
				$stm=$this->db->prepare($sql);
				$stm->bindParam(":contrasenia", $contrasenia);
			}else{
				$sql="UPDATE usuario set correo=:correo, nombre=:nombre, usuario=:usuario WHERE id_usuario=:id_usuario";
				$stm=$this->db->prepare($sql);
			}
			$stm->bindParam(":correo", $correo);
			$stm->bindParam(":nombre", $nombre);
			$stm->bindParam(":usuario", $usuario);
			$stm->bindParam(":id_usuario", $id_usuario);
			$stm->execute();
			$datos['estatus']="OK";
			$datos['mensaje']="Se modifico Correctamente el usuario ".$id_usuario;
			$this->db->commit();
		}else{
			$datos['estatus']="NO";
			$datos['mensaje']="Se requiere un id valido";
		}
		return $datos;
	}
}
$usuarios=new Usuario;
$metodo=$_SERVER['REQUEST_METHOD'];
switch ($metodo) {
	case 'POST':
		$datos=$usuarios->crearUsuario();
		break;
	case 'PUT':
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$usuarios->actualizarUsuario($id);
		break;
	case 'DELETE':
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$usuarios->eliminarUsuarios($id);
		break;
	case 'GET':
	default:
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$usuarios->leerUsuarios($id);
		break;
}
$cadena=json_encode($datos);
echo $cadena;
?>