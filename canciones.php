<?php
include('core/musiccloud.class.php');
if(!isset($_SESSION['correo'])){
  header("Location: login.php");
}
$canciones=$web->obtenerCanciones($_SESSION['correo']);
include('header.php');
?>
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
            <!-- <tr>
              <td><span class="icon-play_circle_outline btn-lg"></span></td>
              <td>Mi vida</td>
              <td>DLD</td>
              <td>2012</td>
              <td>Alternativo</td>
              <td>4:29</td>
              <td><button class="btn btn-outline-secondary btn-sm" type="button">descargar</button></td>
            </tr> -->
        </ul>
      </main>
<?php
include('footer.php');
?>