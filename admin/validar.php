<?php
	include('../core/musiccloud.class.php');
	if (isset($_POST["login"])) {
		$correo=$_POST["email"];
		$contrasenia=md5($_POST["contrasenia"]);
		if($web->login($correo, $contrasenia)){
			$_SESSION['correo']=$correo;
			$_SESSION['playlist']=null;
			if ($web->verificarPermiso($_SESSION['correo'], "CRUD")) {
		      header("Location: index.php");
		    }else{
		    	$web->logout();
		    	header("Location: ../canciones.php");
		    }
		}else{
			$web->logout();
			header('Location: login.php');
		}
	}else{
		$web->logout();
		header('Location: login.php');
	}
?>