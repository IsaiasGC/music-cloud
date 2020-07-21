<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="http://localhost/add/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/style.css">

    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Music Clound!</title>
  </head>
  <body ondragstart="return false" onselectstart="return false" oncontextmenu="return false">
    <div class="container-fluid">
      <header>
        <nav class="navbar navbar-dark bg-dark">
          <img src="images/logo.png" class="d-inline-block align-top" height="50" alt="" id="logo">
          <form class="form-inline" id="hdr">
            <div class="form-group">
              <?php if($web->verificarPermiso($_SESSION['correo'], "CRUD")): ?>
              <div class="input-group">
                <a class="btn btn-outline-info" href="admin/">Administrador</a>
              </div>
              <?php endif; ?>
              <a class="d-inline" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                <img src="images/usuario.png" alt="usuario" id="signin">
              </a>
              <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                  <a class="btn btn-danger" href="logout.php">Cerrar Sesion</a>
                </div>
              </div>
            </div>
          </form>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width: 100%;">
            <ul class="navbar-nav mr-auto">
              <!-- <li class="nav-item">
                <a class="nav-link cambiar" href="listas.php">Listas de Reproduccion</a>
              </li> -->
              <li class="nav-item active">
                <a class="nav-link cambiar" href="canciones.php">Canciones<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link cambiar" href="albumes.php">Álbumes</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link cambiar" href="artistas.php">Artistas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link cambiar" href="generos.php">Generos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link icon-file_upload icon cambiar" href="agregar_cancion.php"></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
