<?php
	include('header.php');
	if (isset($_GET['id_album'])) {
		$id_album=$_GET['id_album'];
		$id_artista=$_GET['id_artista'];
		if (is_numeric($id_album) && is_numeric($id_artista)) {
			$sql="DELETE FROM album_artista WHERE id_album=:id_album AND id_artista=:id_artista";
			$statement=$web->db->prepare($sql);
			$statement->bindParam(":id_album", $id_album);
			$statement->bindParam(":id_artista", $id_artista);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">El Album se elimino Correctamente</div>';
		}
	}
	include('footer.php');
?>