<?php
	include('header.php');
	if (isset($_GET['id_artista'])) {
		$id_artista=$_GET['id_artista'];
		if (is_numeric($id_artista)) {
			$sql="DELETE FROM artista WHERE id_artista=:id_artista";
			$statement=$web->db->prepare($sql);
			$statement->bindParam(":id_artista", $id_artista);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">El Artista se elimino Correctamente</div>';
		}
	}
	include('footer.php');
?>