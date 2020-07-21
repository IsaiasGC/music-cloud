<?php
include('header.php');
if (isset($_POST['actualizar'])) {
    $artista=$_POST['artista'];

    $sql="INSERT into artista(artista) values(:artista)";
    $statement=$web->db->prepare($sql);
    $statement->bindParam(":artista", $artista);
    $statement->execute();

    echo '<div class="alert alert-success" role="alert">El Artista se inserto Correctamente</div>';
}
?>
<form action="artistas.insertar.php" method="post">
    <div class="form-group">
        <label>Artista</label>
        <input type="text" class="form-control" name="artista" required>
    </div>
    <div class="form-group">
        <input name="actualizar" class="btn btn-outline-primary" type="submit" value="Insertar">
    </div>
</form>
<?php
include('footer.php');
?>