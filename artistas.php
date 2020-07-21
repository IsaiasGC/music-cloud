<?php
include('core/musiccloud.class.php');
if(!isset($_SESSION['correo'])){
  header("Location: login.php");
}
$artistas=$web->obtenerArtistas($_SESSION['correo']);
include('header.php');
?>
      <main>
        <?php 
        foreach($artistas as $key => $artista):
          $albumes=$web->obtenerAlbumesArtista($_SESSION['correo'], $artista['id_artista']);
          $num=0;
        ?>
        <a href="artista_.php?id_artista=<?php echo $artista['id_artista']; ?>" class="cambiar">
          <div class="row feat">
            <div class="col-md feat">
              <div class="img-t-b2">
                  <div class="img-left2">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$num]['caratula'], 150, 150))); ?>" data-holder-rendered="true" alt="lista 1" style="width: 150px; height: 150px;">
                  </div>
                  <?php $num=(($num+1)<count($albumes))?$num+1:0; ?>
                  <div class="img-rigth2">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$num]['caratula'], 150, 150))); ?>" class="img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 150px; height: 150px;">
                  </div>
                </div>
                <div class="img-t-b2">
                  <?php $num=(($num+1)<count($albumes))?$num+1:0; ?>
                  <div class="img-left2">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$num]['caratula'], 150, 150))); ?>" class="img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 150px; height: 150px;">
                  </div>
                  <?php $num=(($num+1)<count($albumes))?$num+1:0; ?>
                  <div class="img-rigth2">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$num]['caratula'], 150, 150))); ?>" class="img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 150px; height: 150px;">
                  </div>
                </div>
            </div>
            <div class="col-md feat">
              <h2 class="featurette-heading"><?php echo $artista['artista']; ?></h2>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
      </main>
<?php
include('footer.php');
?>