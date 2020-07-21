<?php
header("Content-Type: application/json");
include('../../core/musiccloud.class.php');
class Artista extends Musiccloud{
	
	function __construct(){
		
	}
	function leerArtistas($id_artista=null){
		$sqlPart="";
		$parametros=array();
		if (!is_null($id_artista)) {
			if (is_numeric($id_artista)) {
				$sqlPart=" WHERE id_artista=:id_artista";
				$parametros=array(':id_artista'=>$id_artista);
			}
		}
		$sql="SELECT * FROM artista".$sqlPart;
		$datos=$this->queryArray($sql, $parametros);
		return $datos;
	}
	function crearArtista(){
		$cadena=file_get_contents("php://input");
		$cadena=json_decode($cadena);
		$artista=$cadena[0]->artista;
		$this->conexion();
		$this->db->beginTransaction();
		$sql="INSERT INTO artista(artista) VALUES(:artista)";
		$stm=$this->db->prepare($sql);
		$stm->bindParam(":artista", $artista);
		$stm->execute();
		$param=array(":artista"=>$artista);
		$al=$this->queryArray2($this, "SELECT id_artista FROM artista WHERE artista=:artista", $param);
		$id_artista=$al[0]['id_artista'];
		$datos['estatus']="OK";
		$datos['mensaje']="Se inserto correctamente el artista";
		$datos['id_artista']=$id_artista;
		$this->db->commit();
		return $datos;
	}
	function eliminarArtista($id_artista){
		if (is_numeric($id_artista)) {
			$sql="DELETE FROM artista WHERE id_artista=:id_artista";
			$this->conexion();
			$stm=$this->db->prepare($sql);
			$stm->bindParam(":id_artista", $id_artista);
			$stm->execute();
			$fila=$stm->rowCount();
			if ($fila>0) {
				$datos['estatus']="OK";
				$datos['mensaje']="Se elimino el artista ".$id_artista;
			}else{
				$datos['estatus']="NO";
				$datos['mensaje']="No se encontro el artista";
			}
		}else{
			$datos['estatus']="NO";
			$datos['mensaje']="Se requiere un id valido";
		}
		return $datos;
	}
	function actualizarArtista($id_artista){
		if (is_numeric($id_artista)) {
			$cadena=file_get_contents("php://input");
			$cadena=json_decode($cadena);
			$artista=$cadena[0]->artista;
			$this->conexion();
			$this->db->beginTransaction();
			$sql="UPDATE artista set artista=:artista WHERE id_artista=:id_artista";
			$stm=$this->db->prepare($sql);
			$stm->bindParam(":artista", $artista);
			$stm->bindParam(":id_artista", $id_artista);
			$stm->execute();
			$datos['estatus']="OK";
			$datos['mensaje']="Se modifico Correctamente el artista ".$id_artista;
			$this->db->commit();
		}else{
			$datos['estatus']="NO";
			$datos['mensaje']="Se requiere un id valido";
		}
		return $datos;
	}
}
$artistas=new Artista;
$metodo=$_SERVER['REQUEST_METHOD'];
switch ($metodo) {
	case 'POST':
		$datos=$artistas->crearArtista();
		break;
	case 'PUT':
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$artistas->actualizarArtista($id);
		break;
	case 'DELETE':
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$artistas->eliminarArtista($id);
		break;
	case 'GET':
	default:
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$artistas->leerArtistas($id);
		break;
}
$cadena=json_encode($datos);
echo $cadena;
?>