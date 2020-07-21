<?php
  include('../core/musiccloud.class.php');
  if (isset($_SESSION['correo'])) {
    if (!$web->verificarPermiso($_SESSION['correo'], "CRUD")) {
      header("Location: login.php");
    }
  }else{
    header("Location: login.php");
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="http://localhost/add/bootstrap/css/bootstrap.min.css">
    <link href="../font/css/open-iconic-bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/style.css">

    <link rel="shortcut icon" href="../images/favicon.ico">
    <title>Administrador Music Clound!</title>
  </head>
  <body>
    <div class="container-fluid">
      <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="index.php"><img src="../images/logo.png" class="d-inline-block align-top" height="50" alt="logo" id="logo"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  catalogos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="usuarios.php">Usuarios</a>
                  <a class="dropdown-item" href="generos.php">Generos</a>
                  <a class="dropdown-item" href="artistas.php">Artistas</a>
                  <a class="dropdown-item" href="albumes.php">Albumes</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <a class="btn btn-outline-danger my-2 my-sm-0" href="../logout.php">Cerrar Sesion</a>
            </form>
          </div>
        </nav>
      </header>