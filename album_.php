<?php
include('core/musiccloud.class.php');
if(!isset($_SESSION['correo'])){
  header("Location: login.php");
}
if(!(isset($_GET['id_album']) && isset($_GET['id_artista']))) {
  header("Location: albumes.php");
}
$id_artista=$_GET['id_artista'];
$id_album=$_GET['id_album'];
$canciones=$web->obtenerCancionesAlbum($_SESSION['correo'], $id_album, $id_artista);
$album=$web->album_artista($id_album, $id_artista);
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
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/style.css">

    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Music Clound!</title>
  </head>
  <body  ondragstart="return false" onselectstart="return false" oncontextmenu="return false">
    <div class="container-fluid">
      <header>
        <div class="row">
          <div class="col-md-3 mb-4">
            <a href="albumes.php" class="icon-arrow_back icon cambiar"></a>
          </div>
          <div class="col-md-6">
            <img class="img-fluid mx-auto d-block feat" src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($album[0]['caratula'], 500, 500))); ?>" alt="album">
          </div>
          <div class="col-md-3 alb">
            <h3><?php echo $canciones[0]['album']; ?></h3>
            <h4><?php echo $canciones[0]['artista']; ?></h4>
          </div>
        </div>
      </header>
      <main>
        <ul class="biblioteca" id="biblioteca">
            <li>
              <div class="row">
                <div class="col-sm-11">
                  <div class="row">
                    <div class="col-sm-3"><strong>titulo</strong></div>
                    <div class="col-sm-3"><strong>album</strong></div>
                    <div class="col-sm-3"><strong>artista</strong></div>
                    <div class="col-sm-3"><strong>genero</strong></div>
                  </div>
                </div>
                <div class="col-sm-1"> </div>
              </div>
            </li>
            <?php
            for ($i=0; $i<count($canciones); $i++):
            ?>
            <li class="cancion">
              <div class="row">
                <div class="col-sm-11">
                  <a href="http://localhost/musiccloud/music/<?php echo $canciones[$i]['cancion'] ?>.mp3" class="escuchar">
                  <div class="row">
                    <div class="col-sm-3"><p><?php echo str_replace("_", " ", substr($canciones[$i]['cancion'], 15)); ?></p></div>
                    <div class="col-sm-3"><p><?php echo $canciones[$i]['album']; ?></p></div>
                    <div class="col-sm-3"><p><?php echo $canciones[$i]['artista']; ?></p></div>
                    <div class="col-sm-3"><p><?php echo $canciones[$i]['genero']; ?></p></div>
                  </div>
                  </a>
                </div>
                <div class="col-sm-1">
                  <div class="row">
                    <div class="col-sm-6">
                      <a href="music/<?php echo $canciones[$i]['cancion']; ?>.mp3" download="<?php echo str_replace("_", " ", substr($canciones[$i]['cancion'], 15)); ?>.mp3" class="icon-cloud_download icon"></a>
                    </div>
                    <div class="col-sm-6">
                      <div class="btn-group" role="group">
                        <a href="#" id="more" class="icon-more_vert icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                        <div class="dropdown-menu" aria-labelledby="more">
                          <a class="dropdown-item eliminar" href="<?php echo $canciones[$i]['cancion']; ?>">Eliminar Cancion</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          <?php endfor; ?>
        </ul>
      </main>
<?php
include('footer.php');
?>