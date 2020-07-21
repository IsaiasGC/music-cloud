<?php
include('core/musiccloud.class.php');
if(isset($_SESSION['correo'])){
  header("Location: canciones.php");
}
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
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Music Clound!</title>
  </head>
  <body  ondragstart="return false" onselectstart="return false" oncontextmenu="return false">
    <div class="container-fluid">
      <header id="hlog">
        <div class="row">
          <div class="col-md-12">
            <a href="login.php" role="button" id="log">Iniciar Sesión</a>
          </div>
        </div>
      </header>
      <section id="inicio">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item">
              <img class="first-slide" src="images/prueba1.jpg" alt="First slide">
              <div class="container">
                <div class="carousel-caption text-left" style="color: white;">
                  <h1>Somos jovenes pero no inexpertos.</h1>
                  <p>Creamos cosas aplicaciones que satisfagan nuestras necesidades.</p>
                  <p><a class="btn btn-lg btn-primary" href="acercade.php" role="button">Acerca de</a></p>
                </div>
              </div>
            </div>
            <div class="carousel-item active" >
              <img class="second-slide" src="images/prueba2.jpg" alt="Second slide">
              <div class="container">
                <div class="carousel-caption" style="color: white;">
                  <h1>Tu musica favorita.</h1>
                  <p>Sincroniza tu musica favorita para tenerla en todos tus dispositivos.</p>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <img class="third-slide" src="images/prueba3.jpg" alt="Third slide">
              <div class="container">
                <div class="carousel-caption text-right" style="color: white;">
                  <h1>Pruebanos.</h1>
                  <p>Veras que somos los mejores en lo que hacemos.</p>
                  <p><a class="btn btn-lg btn-primary" href="registrar.php" role="button">Registrar</a></p>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="container marketing">

          <hr class="featurette-divider">

          <div class="row featurette">
            <div class="col-md-7">
              <h2 class="featurette-heading">Tus Canciones. <span class="text-muted">A donde quieras.</span></h2>
              <p class="lead">Sincroniza y escucha tus canciones, de una manera facil y sencilla.</p>
            </div>
            <div class="col-md-5">
              <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Mexico" src="images/index1.png" data-holder-rendered="true">
            </div>
          </div>

          <hr class="featurette-divider">

          <div class="row featurette">
            <div class="col-md-7 order-md-2">
              <h2 class="featurette-heading">Haz tus playlist.</h2>
              <p class="lead">Acomoda tus canciones para toda ocacion, y compartelas con tus amigos.</p>
            </div>
            <div class="col-md-5 order-md-1">
              <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="USA" src="images/index2.png" data-holder-rendered="true">
            </div>
          </div>

          <hr class="featurette-divider">
          <!-- /END THE FEATURETTES -->
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
    <script src="http://localhost/add/bootstrap/js/bootstrap.min.js"></script></script>
  </body>
</html>