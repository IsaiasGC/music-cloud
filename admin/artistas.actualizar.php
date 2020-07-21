<?php
include('header.php');
if (isset($_GET['id_artista'])) {
    $id_artista=$_GET['id_artista'];
    if (is_numeric($id_artista)) {
        if (isset($_POST['actualizar'])) {
            $artista=$_POST['artista'];

            $sql="UPDATE artista SET artista=:artista WHERE id_artista=:id_artista";
            $statement=$web->db->prepare($sql);
            $statement->bindParam(":artista", $artista);
            $statement->bindParam(":id_artista", $id_artista);
            $statement->execute();

            echo '<div class="alert alert-success" role="alert">El Artista se modifico Correctamente</div>';
        }
        $param=array(':id_artista'=>$id_artista);
        $artista=$web->queryArray("SELECT * FROM artista WHERE id_artista=:id_artista", $param);
    }
}
?>
<form action="artistas.actualizar.php?id_artista=<?php echo $id_artista ?>" method="post">
    <div class="form-group">
        <label>Artista</label>
        <input type="text" class="form-control" name="artista" required value="<?php echo $artista[0]['artista']; ?>">
    </div>
    <div class="form-group">
        <input name="actualizar" class="btn btn-outline-primary" type="submit" value="Modificar">
    </div>
</form>
<?php
include('footer.php');
?>