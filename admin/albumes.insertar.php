<?php
include('header.php');
if (isset($_POST['actualizar'])) {
    $album=$_POST['album'];
    $artista=$_POST['artista'];
    $caratula=null;
    $al=$web->album($album);
    $ar=$web->artista($artista);
    if (isset($_FILES['caratula'])) {
        if ($_FILES['caratula']['error']==0) {
            $ext=strtolower(substr($_FILES['caratula']['name'],strrpos($_FILES['caratula']['name'],".")));
            if ($ext==".jpg" || $ext==".png") {
                $caratula=addslashes(file_get_contents($_FILES['caratula']['tmp_name']));
            }else{
                echo '<div class="alert alert-danger" role="alert">La extencion no es valida('.$ext.')</div>';
            }
        }else{
            $caratula="";
        }
    }
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
    if (count($web->album_artista($al, $ar))==0){
        $sql="INSERT INTO album_artista(id_album, id_artista, caratula) VALUES(:id_album, :id_artista, :caratula)";
        $stm=$web->db->prepare($sql);
        $stm->bindParam(":id_album", $al);
        $stm->bindParam(":id_artista", $ar);
        $stm->bindParam(":caratula", $caratula);
        $stm->execute();
        echo '<div class="alert alert-success" role="alert">El Album se inserto Correctamente</div>';
    }else{
        echo '<div class="alert alert-danger" role="alert">El Album ya existe</div>';
    }
}
?>
<form action="albumes.insertar.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Album</label>
        <input type="text" class="form-control" name="album" required>
    </div>
    <div class="form-group">
        <label>Artista</label>
        <input type="text" class="form-control" name="artista" required>
    </div>
    <div class="form-group">
        <label>Caratula</label>
        <input type="file" class="filestyle" name="caratula" id="caratula">
    </div>
    <div class="form-group">
        <input name="actualizar" class="btn btn-outline-primary" type="submit" value="Insertar">
    </div>
</form>
<?php
include('footer.php');
?>