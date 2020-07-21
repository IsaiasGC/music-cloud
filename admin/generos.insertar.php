<?php
include('header.php');
if (isset($_POST['actualizar'])) {
    $genero=$_POST['genero'];

    $sql="INSERT into genero(genero) values(:genero)";
    $statement=$web->db->prepare($sql);
    $statement->bindParam(":genero", $genero);
    $statement->execute();

    echo '<div class="alert alert-success" role="alert">El Genero se inserto Correctamente</div>';
}
?>
<form action="generos.insertar.php" method="post">
    <div class="form-group">
        <label>Genero</label>
        <input type="text" class="form-control" name="genero" required>
    </div>
    <div class="form-group">
        <input name="actualizar" class="btn btn-outline-primary" type="submit" value="Insertar">
    </div>
</form>
<?php
include('footer.php');
?>