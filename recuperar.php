<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';
include('core/musiccloud.class.php');

$correo=(isset($_POST['correo']))?$_POST['correo']:null;

if (!is_null($correo)) {
	$sql='SELECT * FROM usuario WHERE correo=:correo';
	$user=$web->queryArray($sql, array(":correo"=>$correo));
	$llave=md5($correo.rand(1,90000).crypt("uekelele","cosa").rand(1,50)).md5(crypt("anitalavalatina","otra").sha1("murcielago").soundex("doremifasido").rand(1,12312));
	if (isset($user[0])) {
		$sql='UPDATE usuario SET llave=:llave WHERE correo=:correo';
		$stm=$web->db->prepare($sql);
		$stm->bindParam(":llave", $llave);
		$stm->bindParam(":correo", $correo);
		if($stm->execute()){
  		$mail = new PHPMailer;
  		$mail->isSMTP();
  		// $mail->SMTPDebug = 2;
  		$mail->Host = 'smtp.gmail.com';
  		$mail->Port = 587;
  		$mail->SMTPSecure = 'tls';
  		$mail->SMTPAuth = true;
  		$mail->Username = "15030094@itcelaya.edu.mx";
  		$mail->Password = "J17isaiasGC@+-";
  		$mail->setFrom('15030094@itcelaya.edu.mx', 'Musiccloud Supporter');
  		$mail->addAddress($correo, $user[0]['usuario']);
  		$mail->Subject = 'Restauracion de contraseña';
  		$mail->msgHTML('Estimado usuario '.$user[0]['nombre'].', a continuacion encontrara un vinculo para recuperrar su contraseña:<br /><br /><a href="http://localhost/musiccloud/restablecer.php?llave='.$llave.'"> Restablecer contraseña</a>');
  		$mail->AltBody = 'This is a plain-text message body';
  		if (!$mail->send()) {
  		    echo "Mailer Error: " . $mail->ErrorInfo;
  		} else {
  		    echo "Message sent!";
  		}
		}else{
			print_r($stm->errorInfo());
			die("<br /> No se actualizo, llave: ".$llave);
		}
	}else{
		die("El correo no existe");
	}
}
?>
<!doctype html>
<html lang="es">
  <head>

    <!-- Optional JavaSc-->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="css/signin.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="images/favicon.ico">
    <title>AirplaneMX</title>
  </head>
  <body class="text-center">
    <div class="container-fluid">
      <header>
        <nav class="navbar fixed-top navbar-light bg-light">
          <a class="carousel-control-prev" role="button" href="login.php">
            <img src="images/regresar.png" width="50" alt="regresar">
          </a>
        </nav>
      </header>
      <section>
        <div class="row">
          <div class="col-sm-12">
            <form class="form-signin" method="POST" action="recuperar.php">
              <img class="mb-4" src="images/usuario.png" alt=" usuario" width="72" height="72">
              <h1 class="h3 mb-3 font-weight-normal">Reestablecer Contraseña</h1>
              <label for="inputEmail" class="sr-only">E-mail</label>
              <input type="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus name="correo">
              <button class="btn btn-lg btn-primary btn-block" type="submit" name="log">Recuperar</button>
              <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
            </form>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>