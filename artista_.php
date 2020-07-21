<?php
include('core/musiccloud.class.php');
if(!isset($_SESSION['correo'])){
  header("Location: login.php");
}
if(!isset($_GET['id_artista'])) {
  header("Location: canciones.php");
}
$id_artista=$_GET['id_artista'];
$canciones=$web->obtenerCancionesArtista($_SESSION['correo'], $id_artista);
$albumes=$web->obtenerAlbumesArtista($_SESSION['correo'], $id_artista);
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
      <main>
        <a href="artistas.php" class="icon-arrow_back icon cambiar"></a>
        <br /><h3>Albumes</h3>
        <hr class="featurette-divider">
        <?php for ($i=0; $i<count($albumes); $i++): ?>
        <div class="row">
          <?php
          for ($j=0; $j<4 ; $j++):
            if ($i<count($albumes)):
          ?>
          <div class="col-xl-3">
            <div class="thumbnail text-center">
              <a href="album_.php?id_album= <?php echo $albumes[$i]['id_album']; ?>&id_artista=<?php echo $id_artista; ?>">
                <div>
                  <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$i]['caratula'], 200, 200))); ?>" class="featurette-image img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 200px; height: 200px;">
                </div>
                <div class="caption">
                  <h5><?php echo $albumes[$i]['album']; ?></h5>
                </div>
              </a>
            </div>
          </div>
          <?php
            endif;
            $i++;
          endfor;
          ?>
        </div>
        <?php endfor; ?>
        <br /><h3>Canciones</h3>
        <hr class="featurette-divider">
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