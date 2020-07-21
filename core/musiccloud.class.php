<?php
	/**
	 * Class: Musiccloud
	 *@author: Isaias Gonzalez
	 *@date: 2018/10/30
	 *@version: 0.1
	 */
session_start();
class Musiccloud{
	var $db;
	function __construct(){
		
	}
	function conexion(){
		$db_host="127.0.0.1";
		$db_user="admin";
		$db_pass="admin";
		$db_name="music_cloud";
		$this->db=new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
	}
	function queryArray($query, $parametros=array()){
		$this->conexion();
		$datos=array();
		$statement=$this->db->prepare($query);
		if(count($parametros)>0){
			$etiquetas=array_keys($parametros);
			for ($i=0; $i<count($parametros) ; $i++) { 
				$statement->bindParam($etiquetas[$i], $parametros[$etiquetas[$i]]);
			}
		}
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($datos, $fila);
		}
		return $datos;
	}
	function queryArray2($conexion, $query, $parametros=array()){
		$datos=array();
		$statement=$conexion->db->prepare($query);
		if(count($parametros)>0){
			$etiquetas=array_keys($parametros);
			for ($i=0; $i<count($parametros) ; $i++) { 
				$statement->bindParam($etiquetas[$i], $parametros[$etiquetas[$i]]);
			}
		}
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($datos, $fila);
		}
		return $datos;
	}
	public function login($email, $contrasenia){
		$query="SELECT * FROM usuario WHERE correo=:email and contrasenia=:contrasenia";
		$statement=$this->db->prepare($query);
		$statement->bindParam(":email", $email);
		$statement->bindParam(":contrasenia", $contrasenia);
		$resultado=$statement->execute();
		while($log=$statement->fetch(PDO::FETCH_ASSOC)){
			return true;
		}
	}
	public function logout(){
		session_destroy();
	}

	public function obtenerPermisos($email){
		$permisos=array();
		$query="SELECT p.permiso FROM usuario u join rol_usuario ru using(id_usuario) join rol_permiso rp using(id_rol) join permiso p using(id_permiso) WHERE u.correo=:email GROUP BY 1";
		$statement=$this->db->prepare($query);
		$statement->bindParam(":email", $email);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_BOTH)) {
        	array_push($permisos, $fila[0]);
	    }
		return $permisos;
	}
	public function verificarPermiso($email, $permiso){
		$query="SELECT p.permiso FROM usuario u join rol_usuario ru using(id_usuario) join rol_permiso rp using(id_rol) join permiso p using(id_permiso) WHERE u.correo=:email AND p.permiso=:permiso GROUP BY 1";
		$statement=$this->db->prepare($query);
		$statement->bindParam(":email", $email);
		$statement->bindParam(":permiso", $permiso);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_BOTH)) {
        	return true;
	    }
	}
	public function usuario($correo){
		$query='SELECT * FROM usuario WHERE correo=:correo';
		$param=array(":correo"=>$correo);
		$art=$this->queryArray($query, $param);
		if (isset($art[0])) {
			return $art[0]['id_usuario'];
		}else{
			return -1;
		}
	}
	public function artista($artista){
		$query='SELECT * FROM artista WHERE upper(artista)=upper(:artista)';
		$param=array(":artista"=>$artista);
		$art=$this->queryArray($query, $param);
		if (isset($art[0])) {
			return $art[0]['id_artista'];
		}else{
			return -1;
		}
	}
	public function album($album){
		$query='SELECT * FROM album WHERE upper(album)=upper(:album)';
		$param=array(":album"=> $album);
		$alb=$this->queryArray($query, $param);
		if (isset($alb[0])) {
			return $alb[0]['id_album'];
		}else{
			return -1;
		}
	}
	public function album_artista($id_album, $id_artista){
		$query='SELECT * FROM album_artista WHERE id_album=:id_album AND id_artista=:id_artista';
		$param=array(":id_album"=> $id_album, ":id_artista"=> $id_artista);
		$alb=$this->queryArray($query, $param);
		return $alb;
	}
	public function genero($genero){
		$query='SELECT * FROM genero WHERE upper(genero)=upper(:genero)';
		$param=array(":genero"=> $genero);
		$gen=$this->queryArray($query, $param);
		if (isset($gen[0])) {
			return $gen[0]['id_genero'];
		}else{
			return -1;
		}
	}
	function obtenerCanciones($correo){
		$this->conexion();
		$id_usuario=$this->usuario($correo);
		$canciones=array();
		$query='SELECT c.id_cancion as "id_cancion", c.cancion as "cancion", al.album as "album", ar.artista as "artista", ge.genero as "genero" FROM cancion c join album al using(id_album) join artista ar using(id_artista) join genero ge using(id_genero) WHERE id_usuario=:id_usuario';
		$statement=$this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($canciones, $fila);
		}
		return $canciones;
	}
	function obtenerAlbumes($correo){
		$this->conexion();
		$id_usuario=$this->usuario($correo);
		$albumes=array();
		$query='SELECT a.id_album as "id_album", a.album as "album", ar.id_artista as "id_artista", ar.artista as "artista", aa.caratula as "caratula" FROM album_artista aa join album a using(id_album) join artista ar using(id_artista) join cancion c using(id_artista, id_album) WHERE id_usuario=:id_usuario GROUP BY 1, 3 ORDER BY 2, 3';
		$statement=$this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($albumes, $fila);
		}
		return $albumes;
	}
	function obtenerCancionesAlbum($correo, $id_album, $id_artista){
		$this->conexion();
		$id_usuario=$this->usuario($correo);
		$canciones=array();
		$query='SELECT c.id_cancion as "id_cancion", c.cancion as "cancion", al.album as "album", ar.artista as "artista", ge.genero as "genero" FROM cancion c join album al using(id_album) join artista ar using(id_artista) join genero ge using(id_genero) WHERE id_usuario=:id_usuario AND id_album=:id_album AND id_artista=:id_artista';
		$statement=$this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$statement->bindParam(":id_album", $id_album);
		$statement->bindParam(":id_artista", $id_artista);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($canciones, $fila);
		}
		return $canciones;
	}
	function obtenerArtistas($correo){
		$this->conexion();
		$id_usuario=$this->usuario($correo);
		$artistas=array();
		$query='SELECT ar.id_artista as "id_artista", ar.artista as "artista" FROM album_artista aa join artista ar using(id_artista) join cancion c using(id_artista) WHERE id_usuario=:id_usuario GROUP BY 1 ORDER BY 2';
		$statement=$this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($artistas, $fila);
		}
		return $artistas;
	}
	function obtenerAlbumesArtista($correo, $id_artista){
		$this->conexion();
		$id_usuario=$this->usuario($correo);
		$albumes=array();
		$query='SELECT a.id_album as "id_album", a.album as "album", aa.caratula as "caratula" FROM album_artista aa join album a using(id_album) join artista ar using(id_artista) join cancion c using(id_artista, id_album) WHERE id_usuario=:id_usuario AND id_artista=:id_artista GROUP BY 1, 3 ORDER BY 2';
		$statement=$this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$statement->bindParam(":id_artista", $id_artista);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($albumes, $fila);
		}
		return $albumes;
	}
	function obtenerCancionesArtista($correo, $id_artista){
		$this->conexion();
		$id_usuario=$this->usuario($correo);
		$canciones=array();
		$query='SELECT c.id_cancion as "id_cancion", c.cancion as "cancion", a.album as "album", aa.caratula as "caratula", ar.artista as "artista", ge.genero as "genero" FROM album_artista aa join album a using(id_album) join artista ar using(id_artista) join cancion c using(id_artista, id_album) join genero ge using(id_genero) WHERE id_usuario=:id_usuario AND id_artista=:id_artista ORDER BY 1';
		$statement=$this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$statement->bindParam(":id_artista", $id_artista);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($canciones, $fila);
		}
		return $canciones;
	}
	function obtenerGeneros($correo){
		$this->conexion();
		$id_usuario=$this->usuario($correo);
		$generos=array();
		$query='SELECT ge.id_genero as "id_genero", ge.genero as "genero" FROM genero ge join cancion c using(id_genero) WHERE id_usuario=:id_usuario GROUP BY 1 ORDER BY 2';
		$statement=$this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($generos, $fila);
		}
		return $generos;
	}
	function obtenerAlbumesGenero($correo, $id_genero){
		$this->conexion();
		$id_usuario=$this->usuario($correo);
		$albumes=array();
		$query='SELECT a.id_album as "id_album", a.album as "album", aa.caratula as "caratula" FROM album_artista aa join album a using(id_album) join artista ar using(id_artista) join cancion c using(id_artista, id_album) join genero ge using(id_genero) WHERE id_usuario=:id_usuario AND id_genero=:id_genero GROUP BY 1 ORDER BY 2';
		$statement=$this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$statement->bindParam(":id_genero", $id_genero);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($albumes, $fila);
		}
		return $albumes;
	}
	function obtenerCancionesGenero($correo, $id_genero){
		$this->conexion();
		$id_usuario=$this->usuario($correo);
		$canciones=array();
		$query='SELECT c.id_cancion as "id_cancion", c.cancion as "cancion", a.album as "album", aa.caratula as "caratula", ar.artista as "artista", ge.genero as "genero" FROM album_artista aa join album a using(id_album) join artista ar using(id_artista) join cancion c using(id_artista, id_album) join genero ge using(id_genero) WHERE id_usuario=:id_usuario AND id_genero=:id_genero ORDER BY 1';
		$statement=$this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$statement->bindParam(":id_genero", $id_genero);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($canciones, $fila);
		}
		return $canciones;
	}
	function obtenerListas($correo){
		$this->conexion();
		$id_usuario=$this->usuario($correo);
		$listas=array();
		$query='SELECT id_lista, lista FROM lista WHERE id_usuario=:id_usuario ORDER BY 2';
		$statement=$this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($listas, $fila);
		}
		return $listas;
	}
	function obtenerAlbumesLista($correo, $id_lista){
		$this->conexion();
		$id_usuario=$this->usuario($correo);
		$albumes=array();
		$query='SELECT a.id_album as "id_album", a.album as "album", aa.caratula as "caratula" FROM album_artista aa join album a using(id_album) join artista ar using(id_artista) join cancion c using(id_artista, id_album) join genero ge using(id_genero) join cancion_lista cl using(id_cancion) WHERE id_usuario=:id_usuario AND id_lista=:id_lista GROUP BY 1 ORDER BY 2';
		$statement=$this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$statement->bindParam(":id_lista", $id_lista);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($albumes, $fila);
		}
		return $albumes;
	}
	function crearImagen($string){
		$result = imagecreatefromstring($string);
		imagejpeg($result, 'thumbnails.jpg');
	}
	function thumb($string, $newheight, $newwidth){
		$string=stripslashes($string);
		$this->crearImagen($string);
		$file="thumbnails.jpg";
		$file_info = getimagesize($file);
		$img = imagecreatefromjpeg($file);
		// Creamos la miniatura 
		$thumb = imagecreatetruecolor($newwidth, $newheight); 
		// La redimensionamos 
		imagecopyresampled($thumb, $img, 0, 0, 0, 0, $newwidth, $newheight, $file_info[0], $file_info[1]); 
		// La mostramos como jpg
		imagejpeg($thumb, 'thumbnails.jpg');
		$imagen=addslashes(file_get_contents('thumbnails.jpg'));
		unlink('thumbnails.jpg');
		return $imagen;
	}
	/*function obtenerTipoAvion(){
		$this->conexion();
		$aviones=array();
		$query="SELECT * FROM tipo_avion";
		$statement=$this->db->prepare($query);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($aviones, $fila);
	    }
		return $aviones;
	}
	function obtenerPromociones(){
		$promociones=array();
		$query="SELECT * FROM promocion 
			WHERE (now() between fecha_ini and fecha_fin)
			ORDER BY rand()
			LIMIT 2";
		$statement=$this->db->prepare($query);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($promociones, $fila);
	    }
		return $promociones;
	}
	function obtenerNoticias(){
		$promociones=array();
		$query="SELECT * FROM noticia
			ORDER BY fecha desc
			LIMIT 3";
		$statement=$this->db->prepare($query);
		$resultado=$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
        	array_push($promociones, $fila);
	    }
		return $promociones;
	}*/
}
$web=new Musiccloud;
$web->conexion();
?>