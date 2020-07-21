<?php
include('header.php');
if (isset($_GET['id_album'])) {
    $id_album=$_GET['id_album'];
    $id_artista=$_GET['id_artista'];
    if (is_numeric($id_album) && is_numeric($id_artista)) {
        if (isset($_POST['actualizar'])) {
            $album=$_POST['album'];
            $artista=$_POST['artista'];
            if (isset($_FILES['caratula'])) {
                if ($_FILES['caratula']['error']==0) {
                    $caratula=addslashes(file_get_contents($_FILES['caratula']['tmp_name']));
                    $sql="UPDATE album_artista SET caratula=:caratula WHERE id_album=:id_album AND id_artista=:id_artista";
                    $statement=$web->db->prepare($sql);
                    $statement->bindParam(":caratula", $caratula);
                    $statement->bindParam(":id_album", $id_album);
                    $statement->bindParam(":id_artista", $id_artista);
                    $statement->execute();
                    echo '<div class="alert alert-success" role="alert">Se modifico la caratula</div>';
                }
            }
            $al=$web->album($album);
            $ar=$web->artista($artista);

            $al=$web->album($album);
            $ar=$web->artista($artista);
            
            if($al==-1){
                if($album!=""){
                    $sql="INSERT INTO album(album) VALUES(:album)";
                    $stm=$web->db->prepare($sql);
                    $stm->bindParam(":album", $album);
                    if ($stm->execute())
                        $al=$web->album($album);
                    else
                        $al=1;
                }else{
                    $al=1;
                }
            }
            if($ar==-1){
                if($artista!=""){
                    $sql="INSERT INTO artista(artista) VALUES(:artista)";
                    $stm=$web->db->prepare($sql);
                    $stm->bindParam(":artista", $artista);
                    if ($stm->execute())
                        $ar=$web->artista($artista);
                    else
                        $ar=1;
                }else{
                    $ar=1;
                }
            }
            if (count($web->album_artista($al, $ar))==1){
                $sql="UPDATE album_artista SET id_album=:id_album, id_artista=:id_artista WHERE id_album=:id_album AND id_artista=:id_artista";
                $stm=$web->db->prepare($sql);
                $stm->bindParam(":id_album", $al);
                $stm->bindParam(":id_artista", $ar);
                $stm->bindParam(":caratula", $caratula);
                $stm->execute();
                echo '<div class="alert alert-success" role="alert">El Album se modifico Correctamente</div>';
            }else{
                echo '<div class="alert alert-danger" role="Ocurrio un error</div>';
            }

            
        }
        $param=array(':id_album'=>$id_album, ':id_artista'=>$id_artista);
        $album=$web->queryArray("SELECT * FROM album al join album_artista aa using(id_album) join artista ar using(id_artista) WHERE id_album=:id_album AND id_artista=:id_artista", $param);
    }
}
?>
<form action="albumes.actualizar.php?id_album=<?php echo $id_album ?>&id_artista=<?php echo $id_artista ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Album</label>
        <input type="text" class="form-control" name="album" required value="<?php echo $album[0]['album']; ?>">
    </div>
    <div class="form-group">
        <label>Artista</label>
        <input type="text" class="form-control" name="artista" required value="<?php echo $album[0]['artista']; ?>">
    </div>
    <div class="form-group">
        <label>Caratula</label>
        <input type="file" class="filestyle" name="caratula" id="caratula">
    </div>
    <div class="form-group">
        <label>Actual</label>
        <?php
        if ($album[0]['caratula']=="") {
            $caratula=addslashes(file_get_contents("../images/Desconocido.jpg"));
        }else{
            $caratula=$album[0]['caratula'];
        }
        ?>
        <img class="img-fluid mx-auto d-block feat" src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($caratula, 500, 500))); ?>" alt="album">
    </div>
    <div class="form-group">
        <input name="actualizar" class="btn btn-outline-primary" type="submit" value="Modificar">
    </div>
</form>
<?php
include('footer.php');
?>