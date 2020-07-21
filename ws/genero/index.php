<?php
header("Content-Type: application/json");
include('../../core/musiccloud.class.php');
class Genero extends Musiccloud{
	
	function __construct(){
		
	}
	function leerGeneros($id_genero=null){
		$sqlPart="";
		$parametros=array();
		if (!is_null($id_genero)) {
			if (is_numeric($id_genero)) {
				$sqlPart=" WHERE id_genero=:id_genero";
				$parametros=array(':id_genero'=>$id_genero);
			}
		}
		$sql="SELECT * FROM genero".$sqlPart;
		$datos=$this->queryArray($sql, $parametros);
		return $datos;
	}
	function crearGenero(){
		$cadena=file_get_contents("php://input");
		$cadena=json_decode($cadena);
		$genero=$cadena[0]->genero;
		$this->conexion();
		$this->db->beginTransaction();
		$sql="INSERT INTO genero(genero) VALUES(:genero)";
		$stm=$this->db->prepare($sql);
		$stm->bindParam(":genero", $genero);
		$stm->execute();
		$param=array(":genero"=>$genero);
		$al=$this->queryArray2($this, "SELECT id_genero FROM genero WHERE genero=:genero", $param);
		$id_genero=$al[0]['id_genero'];
		$datos['estatus']="OK";
		$datos['mensaje']="Se inserto correctamente el genero";
		$datos['id_genero']=$id_genero;
		$this->db->commit();
		return $datos;
	}
	function eliminarGenero($id_genero){
		if (is_numeric($id_genero)) {
			$sql="DELETE FROM genero WHERE id_genero=:id_genero";
			$this->conexion();
			$stm=$this->db->prepare($sql);
			$stm->bindParam(":id_genero", $id_genero);
			$stm->execute();
			$fila=$stm->rowCount();
			if ($fila>0) {
				$datos['estatus']="OK";
				$datos['mensaje']="Se elimino el genero ".$id_genero;
			}else{
				$datos['estatus']="NO";
				$datos['mensaje']="No se encontro el genero";
			}
		}else{
			$datos['estatus']="NO";
			$datos['mensaje']="Se requiere un id valido";
		}
		return $datos;
	}
	function actualizarGenero($id_genero){
		if (is_numeric($id_genero)) {
			$cadena=file_get_contents("php://input");
			$cadena=json_decode($cadena);
			$genero=$cadena[0]->genero;
			$this->conexion();
			$this->db->beginTransaction();
			$sql="UPDATE genero set genero=:genero WHERE id_genero=:id_genero";
			$stm=$this->db->prepare($sql);
			$stm->bindParam(":genero", $genero);
			$stm->bindParam(":id_genero", $id_genero);
			$stm->execute();
			$datos['estatus']="OK";
			$datos['mensaje']="Se modifico Correctamente el genero ".$id_genero;
			$this->db->commit();
		}else{
			$datos['estatus']="NO";
			$datos['mensaje']="Se requiere un id valido";
		}
		return $datos;
	}
}
$generos=new Genero;
$metodo=$_SERVER['REQUEST_METHOD'];
switch ($metodo) {
	case 'POST':
		$datos=$generos->crearGenero();
		break;
	case 'PUT':
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$generos->actualizarGenero($id);
		break;
	case 'DELETE':
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$generos->eliminarGenero($id);
		break;
	case 'GET':
	default:
		$id=(isset($_GET['id']))?$_GET['id']:null;
		$datos=$generos->leerGeneros($id);
		break;
}
$cadena=json_encode($datos);
echo $cadena;
?>