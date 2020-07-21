<?php
include('header.php');
$generos=$web->queryArray("SELECT * FROM genero");
?>
<h1>Generos</h1>
<a href="generos.insertar.php" class="btn btn-success">Nuevo Genero</a>
<table class="table table-bordered">
	<tr>
		<?php
			if (count($generos)>0):
				foreach ($generos[0] as $key => $value):
		?>
					<th><?php echo $key; ?></th>
		<?php 
				endforeach; 
			endif;
		?>
		<th></th>
		<th></th>
	</tr>
	<?php for ($i=0; $i<count($generos); $i++): ?>
	<tr>
		<?php foreach ($generos[$i] as $key => $value): ?>
		<td><?php echo $value; ?></td>
		<?php endforeach; ?>
		<td><a href="generos.actualizar.php?id_genero=<?php echo $generos[$i]['id_genero']; ?>" class="btn btn-outline-info">Actualizar</a></td>
		<td><a href="generos.eliminar.php?id_genero=<?php echo $generos[$i]['id_genero']; ?>" class="btn btn-outline-danger">Eliminar</a></td>
	</tr>
	<?php endfor; ?>
</table>
<?php include('footer.php'); ?>