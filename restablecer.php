<?php
include('core/musiccloud.class.php');
if (isset($_GET['llave'])) {
	$llave=$_GET['llave'];
	$datos=$web->queryArray("SELECT * FROM usuario WHERE llave=:llave", array(":llave"=>$llave));
	if (isset($datos[0])) {
		if (isset($_POST['recuperar'])) {
			$contrasenia=md5($_POST['contrasenia']);
			$sql="UPDATE usuario SET contrasenia=:contrasenia , llave=null WHERE llave=:llave";
			$stm=$web->db->prepare($sql);
			$stm->bindParam(":contrasenia", $contrasenia);
			$stm->bindParam(":llave", $llave);
			if($stm->execute()){
				header("Location: login.php");
			}else{
				print_r($stm->errorInfo());
				die();
			}
		}
	}else{
		die("La llave expiro");
	}
}else{
	die();
}
?>
<!doctype html>
<html lang="es">
  <head>

    <!-- Optional JavaSc-->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="css/signin.css">
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="../images/favicon.ico">
    <title>AirplaneMX</title>
  </head>
  <body class="text-center">
    <div class="container-fluid">
      <header>
        <div class="row">
          <div class="col-sm-6" id="regresar">
            <p><a class="btn btn-outline-danger" href="index.php" role="button">Regresar</a></p>
          </div>
          <div class="col-sm-6" id="registrar">
            <p><a class="btn btn-outline-secondary" href="#" role="button">Registrarte</a></p>
          </div>
        </div>
      </header>
      <section>
        <div class="row">
          <div class="col-sm-12">
            <form class="form-signin" method="POST" action="restablecer.php?llave=<?php echo $llave; ?>">
              <img class="mb-4" src="images/usuario.png" alt=" usuario" width="72" height="72">
              <h1 class="h3 mb-3 font-weight-normal">Recuperar</h1>
              <label for="inputPassword" class="sr-only">Contraseña</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required name="contrasenia">
              <input class="btn btn-lg btn-primary btn-block" type="submit" name="recuperar" value="Recuperar">
              <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
            </form>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>