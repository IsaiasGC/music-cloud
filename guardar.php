<?php
include('core/musiccloud.class.php');
$canciones=$_POST['canciones'];
// $player=$_POST['player'];
$_SESSION['playlist']=$canciones;
// $_SESSION['playlist']['player']=$player;
echo "OK";
?>