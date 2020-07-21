<?php
include('core/musiccloud.class.php');
$cancion=$_POST['cancion'];
$cancion=substr($cancion,strrpos($cancion,"/"));
$sql="DELETE FROM cancion WHERE cancion=:cancion";
$stm=$web->db->prepare($sql);
$stm->bindParam(":cancion", $cancion);
$stm->execute();
$row=$stm->rowCount();
if($row>0){
	unlink("music/".$cancion.".mp3");
	echo "Cancion eliminada";
}else{
	echo "No se pudo eliminar la cancion";
}

?>