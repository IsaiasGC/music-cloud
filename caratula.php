<?php
include('core/musiccloud.class.php');
$cancion=$_POST['cancion'];
$cancion=substr($cancion, strrpos($cancion, "/")+1);
$cancion=substr($cancion, 0, strrpos($cancion, "."));
$sql="SELECT caratula FROM cancion c join album_artista using(id_album, id_artista) WHERE cancion=:cancion";
$caratula=$web->queryArray($sql, array(":cancion"=>$cancion));

// echo $cancion;
echo base64_encode(stripslashes($web->thumb($caratula[0]['caratula'], 500, 500)));
?>