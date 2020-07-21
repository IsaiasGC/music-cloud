<?php
include('header.php');
$albumes=$web->queryArray("SELECT al.id_album, al.album, ar.id_artista, ar.artista FROM album al join album_artista aa using(id_album) join artista ar using(id_artista)");
?>
<h1>Albumes</h1>
<a href="albumes.insertar.php" class="btn btn-success">Nuevo Album</a>
<table class="table table-bordered">
	<tr>
		<?php
			if (count($albumes)>0):
				foreach ($albumes[0] as $key => $value):
		?>
					<th><?php echo $key; ?></th>
		<?php 
				endforeach; 
			endif;
		?>
		<th></th>
		<th></th>
	</tr>
	<?php for ($i=0; $i<count($albumes); $i++): ?>
	<tr>
		<?php foreach ($albumes[$i] as $key => $value): ?>
		<td><?php echo $value; ?></td>
		<?php endforeach; ?>
		<td><a href="albumes.actualizar.php?id_album=<?php echo $albumes[$i]['id_album']; ?>&id_artista=<?php echo $albumes[$i]['id_artista']; ?>" class="btn btn-outline-info">Actualizar</a></td>
		<td><a href="albumes.eliminar.php?id_album=<?php echo $albumes[$i]['id_album']; ?>&id_artista=<?php echo $albumes[$i]['id_artista']; ?>" class="btn btn-outline-danger">Eliminar</a></td>
	</tr>
	<?php endfor; ?>
</table>
<?php include('footer.php'); ?>