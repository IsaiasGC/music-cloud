<?php
include('header.php');
$artistas=$web->queryArray("SELECT * FROM artista");
?>
<h1>Artistas</h1>
<a href="artistas.insertar.php" class="btn btn-success">Nuevo Artista</a>
<table class="table table-bordered">
	<tr>
		<?php
			if (count($artistas)>0):
				foreach ($artistas[0] as $key => $value):
		?>
					<th><?php echo $key; ?></th>
		<?php 
				endforeach; 
			endif;
		?>
		<th></th>
		<th></th>
	</tr>
	<?php for ($i=0; $i<count($artistas); $i++): ?>
	<tr>
		<?php foreach ($artistas[$i] as $key => $value): ?>
		<td><?php echo $value; ?></td>
		<?php endforeach; ?>
		<td><a href="artistas.actualizar.php?id_artista=<?php echo $artistas[$i]['id_artista']; ?>" class="btn btn-outline-info">Actualizar</a></td>
		<td><a href="artistas.eliminar.php?id_artista=<?php echo $artistas[$i]['id_artista']; ?>" class="btn btn-outline-danger">Eliminar</a></td>
	</tr>
	<?php endfor; ?>
</table>
<?php include('footer.php'); ?>