<?php
include('core/musiccloud.class.php');
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="http://localhost/add/bootstrap/css/bootstrap.min.css">
    <link href="css/signin.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="images/favicon.ico">

    <title>Music Clound!</title>
  </head>
  <body>
    <div class="container-fluid">
      <nav class="navbar fixed-top navbar-light bg-light">
          <a class="carousel-control-prev" role="button" href="index.php">
            <img src="images/regresar.png" width="50" alt="regresar">
          </a>
          <a class="carousel-control-next" role="button" href="registrar.php" id="registrar">Registrar</a>
      </nav>
      <section class="text-center">
        <div class="row">
          <div class="col-sm-12">
            <form class="form-signin" action="validar.php" method="POST">
              <img class="mb-4" src="images/usuario.png" alt=" usuario" width="110" height="80">
              <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesion</h1>
              <label for="inputEmail" class="sr-only">E-mail</label>
              <input type="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus name="email">
              <label for="inputPassword" class="sr-only">Contraseña</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required name="contrasenia">
              <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Ingresar</button>
              <a class="mt-5 mb-3 text-muted" href="recuperar.php">¿Olvidaste tu contraseña?</a>
            </form>
          </div>
        </div>
      </section>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="http://localhost/add/jquery-3.3.1.slim.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
    <script src="http://localhost/add/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
    <script src="http://localhost/add/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>