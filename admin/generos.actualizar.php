<?php
include('header.php');
if (isset($_GET['id_genero'])) {
    $id_genero=$_GET['id_genero'];
    if (is_numeric($id_genero)) {
        if (isset($_POST['actualizar'])) {
            $genero=$_POST['genero'];

            $sql="UPDATE genero SET genero=:genero WHERE id_genero=:id_genero";
            $statement=$web->db->prepare($sql);
            $statement->bindParam(":genero", $genero);
            $statement->bindParam(":id_genero", $id_genero);
            $statement->execute();

            echo '<div class="alert alert-success" role="alert">El Genero se modifico Correctamente</div>';
        }
        $param=array(':id_genero'=>$id_genero);
        $genero=$web->queryArray("SELECT * FROM genero WHERE id_genero=:id_genero", $param);
    }
}
?>
<form action="generos.actualizar.php?id_genero=<?php echo $id_genero ?>" method="post">
    <div class="form-group">
        <label>Genero</label>
        <input type="text" class="form-control" name="genero" required value="<?php echo $genero[0]['genero']; ?>">
    </div>
    <div class="form-group">
        <input name="actualizar" class="btn btn-outline-primary" type="submit" value="Modificar">
    </div>
</form>
<?php
include('footer.php');
?>