<?php
header("Content-Type: application/json");
include('../../core/musiccloud.class.php');
class Cancion extends Musiccloud{
	
	function __construct(){
		
	}
	function leerCanciones($id_cancion=null){
		$sqlPart="";
		$parametros=array();
		if (!is_null($id_cancion)) {
			if (is_numeric($id_cancion)) {
				$sqlPart=" WHERE id_cancion=:id_cancion";
				$parametros=array(':id_cancion'=>$id_cancion);
			}
		}
		$sql="SELECT * FROM cancion".$sqlPart;
		$datos=$this->queryArray($sql, $parametros);
		return $datos;
	}
	function crearCancion(){
		$cadena=file_get_contents("php://input");
		$cadena=json_decode($cadena);
		$cancion=$cadena[0]->cancion;
		$cancion=str_replace(" ", "_", $cancion);
		$cancion=substr(md5($cancion.rand()), 0, 14)."-".$cancion;
		$usuario=$cadena[0]->usuario->id_usuario;
		$album=$cadena[0]->album->id_album;
		$artista=$cadena[0]->artista->id_artista;
		$genero=$cadena[0]->genero->id_genero;
		$this->conexion();
		$this->db->beginTransaction();
		$sql="INSERT INTO cancion(cancion, id_usuario, id_album, id_artista, id_genero) VALUES(:cancion, :id_usuario, :id_album, :id_artista, :id_genero)";
		$stm=$this->db->prepare($sql);
		$stm->bindParam(":cancion", $cancion);
		$stm->execute();
		$param=array(":cancion"=>$cancion);
		$user=$this->queryArray2($this, "SELECT id_cancion FROM cancion WHERE cancion=:cancion", $param);
		$id_cancion=$user[0]['id_cancion'];
		$datos['estatus']="OK";
		$datos['mensaje']="Se inserto correctamente el cancion y su rol";
		$datos['id_cancion']=$id_cancion;
		$this->db->commit();
		return $datos;
	}
	function eliminarCanciones($id_cancion){
		if (is_numeric($id_cancion)) {
			$sql="DELETE FROM cancion WHERE id_cancion=:id_cancion";
			$this->conexion();
			$stm=$this->db->prepare($sql);
			$stm->bindParam(":id_cancion", $id_cancion);
			$stm->execute();
			$fila=$stm->rowCount();
			if ($fila>0) {
				$datos['estatus']="OK";
				$datos['mensaje']="Se elimino la cancion ".$id_cancion;
			}else{
				$datos['estatus']="NO";
				$datos['mensaje']="No se encontro la cancion";
			}
		}else{
			$datos['estatus']="NO";
			$datos['mensaje']="Se requiere un id valido";
		}
		return $datos;
	}
	function actualizarCancion($id_cancion){
		if (is_numeric($id_cancion)) {
			$cadena=file_get_contents("php://input");
			$cadena=json_decode($cadena);
			$cancion=$cadena[0]->cancion;
			$album=$cadena[0]->album->id_album;
			$artista=$cadena[0]->artista->id_artista;
			$genero=$cadena[0]->genero->id_genero;
			$this->conexion();
			$this->db->beginTransaction();
			$contrasenia=md5($contrasenia);
			$sql="UPDATE cancion set cancion=:cancion, id_album=:id_album, id_artista=:id_artista, id_genero=:id_genero WHERE id_cancion=:id_cancion";
			$stm=$this->db->prepare($sql);
			$stm->bindParam(":cancion", $cancion);
			$stm->bindParam(":id_album", $id_album);
			$stm->bindParam(":id_artista", $id_artista);
			$stm->bindParam(":id_genero", $id_genero);
			$stm->bindParam(":id_cancion", $id_cancion);
			$stm->execute();
			$datos['estatus']="OK";
			$datos['mensaje']="Se modifico Correctamente la cancion ".$id_cancion;
			$this->db->commit();
		}else{
			$datos['estatus']="NO";
			$datos['mensaje']="Se requiere un id valido";
		}
		return $datos;
	}
}
$canciones=new Cancion;
$metodo=$_SERVER['REQUEST_METHOD'];
switch ($metodo) {
	case 'POST':
		$datos=$canciones->crearCancion();
		break;
	case 'PUT':
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$canciones->actualizarCancion($id);
		break;
	case 'DELETE':
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$canciones->eliminarCanciones($id);
		break;
	case 'GET':
	default:
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$canciones->leerCanciones($id);
		break;
}
$cadena=json_encode($datos);
echo $cadena;
?>