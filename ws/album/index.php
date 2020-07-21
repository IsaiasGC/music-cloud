<?php
header("Content-Type: application/json");
include('../../core/musiccloud.class.php');
class Album extends Musiccloud{
	
	function __construct(){
		
	}
	function leerAlbumes($id_album=null){
		$sqlPart="";
		$parametros=array();
		if (!is_null($id_album)) {
			if (is_numeric($id_album)) {
				$sqlPart=" WHERE id_album=:id_album";
				$parametros=array(':id_album'=>$id_album);
			}
		}
		$sql="SELECT * FROM album".$sqlPart;
		$datos=$this->queryArray($sql, $parametros);
		return $datos;
	}
	function crearAlbum(){
		$cadena=file_get_contents("php://input");
		$cadena=json_decode($cadena);
		$album=$cadena[0]->album;
		$this->conexion();
		$this->db->beginTransaction();
		$sql="INSERT INTO album(album) VALUES(:album)";
		$stm=$this->db->prepare($sql);
		$stm->bindParam(":album", $album);
		$stm->execute();
		$param=array(":album"=>$album);
		$al=$this->queryArray2($this, "SELECT id_album FROM album WHERE album=:album", $param);
		$id_album=$al[0]['id_album'];
		$datos['estatus']="OK";
		$datos['mensaje']="Se inserto correctamente el album";
		$datos['id_album']=$id_album;
		$this->db->commit();
		return $datos;
	}
	function eliminarAlbumes($id_album){
		if (is_numeric($id_album)) {
			$sql="DELETE FROM album WHERE id_album=:id_album";
			$this->conexion();
			$stm=$this->db->prepare($sql);
			$stm->bindParam(":id_album", $id_album);
			$stm->execute();
			$fila=$stm->rowCount();
			if ($fila>0) {
				$datos['estatus']="OK";
				$datos['mensaje']="Se elimino el album ".$id_album;
			}else{
				$datos['estatus']="NO";
				$datos['mensaje']="No se encontro el album";
			}
		}else{
			$datos['estatus']="NO";
			$datos['mensaje']="Se requiere un id valido";
		}
		return $datos;
	}
	function actualizarAlbum($id_album){
		if (is_numeric($id_album)) {
			$cadena=file_get_contents("php://input");
			$cadena=json_decode($cadena);
			$album=$cadena[0]->album;
			$this->conexion();
			$this->db->beginTransaction();
			$sql="UPDATE album set album=:album WHERE id_album=:id_album";
			$stm=$this->db->prepare($sql);
			$stm->bindParam(":album", $album);
			$stm->bindParam(":id_album", $id_album);
			$stm->execute();
			$datos['estatus']="OK";
			$datos['mensaje']="Se modifico Correctamente el album ".$id_album;
			$this->db->commit();
		}else{
			$datos['estatus']="NO";
			$datos['mensaje']="Se requiere un id valido";
		}
		return $datos;
	}
}
$albumes=new Album;
$metodo=$_SERVER['REQUEST_METHOD'];
switch ($metodo) {
	case 'POST':
		$datos=$albumes->crearAlbum();
		break;
	case 'PUT':
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$albumes->actualizarAlbum($id);
		break;
	case 'DELETE':
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$albumes->eliminarAlbumes($id);
		break;
	case 'GET':
	default:
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$albumes->leerAlbumes($id);
		break;
}
$cadena=json_encode($datos);
echo $cadena;
?>