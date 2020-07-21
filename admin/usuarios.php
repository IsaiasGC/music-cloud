<?php
include('header.php');
$usuarios=$web->queryArray("SELECT u.id_usuario, u.usuario, u.correo, u.contrasenia as contraseña, u.nombre, r.rol FROM usuario u left join rol_usuario ru using(id_usuario) left join rol r using(id_rol) GROUP BY 1, 6");
?>
<h1>usuarios</h1>
<a href="usuarios.insertar.php" class="btn btn-success">Nuevo usuario</a>
<table class="table table-bordered">
	<tr>
		<?php
			if (count($usuarios)>0):
				foreach ($usuarios[0] as $key => $value):
		?>
					<th><?php echo $key; ?></th>
		<?php 
				endforeach; 
			endif;
		?>
		<th></th>
		<th></th>
	</tr>
	<?php for ($i=0; $i<count($usuarios); $i++): ?>
	<tr>
		<?php foreach ($usuarios[$i] as $key => $value): ?>
		<td><?php echo $value; ?></td>
		<?php endforeach; ?>
		<td><a href="usuarios.actualizar.php?id_usuario=<?php echo $usuarios[$i]['id_usuario']; ?>" class="btn btn-outline-info">Actualizar</a></td>
		<td><a href="usuarios.eliminar.php?id_usuario=<?php echo $usuarios[$i]['id_usuario']; ?>" class="btn btn-outline-danger">Eliminar</a></td>
	</tr>
	<?php endfor; ?>
</table>
<?php include('footer.php'); ?>