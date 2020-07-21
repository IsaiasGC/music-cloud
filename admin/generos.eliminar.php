<?php
	include('header.php');
	if (isset($_GET['id_genero'])) {
		$id_genero=$_GET['id_genero'];
		if (is_numeric($id_genero)) {
			$sql="DELETE FROM genero WHERE id_genero=:id_genero";
			$statement=$web->db->prepare($sql);
			$statement->bindParam(":id_genero", $id_genero);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">El Genero se elimino Correctamente</div>';
		}
	}
	include('footer.php');
?>