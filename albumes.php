<?php
include('core/musiccloud.class.php');
if(!isset($_SESSION['correo'])){
  header("Location: login.php");
}
$albumes=$web->obtenerAlbumes($_SESSION['correo']);
include('header.php');
?>
      <main>
        <?php for($i=0; $i<count($albumes); $i++): ?>
        <a href="album_.php?id_album= <?php echo $albumes[$i]['id_album']; ?>&id_artista=<?php echo $albumes[$i]['id_artista']; ?>" class="cambiar">
          <div class="row feat">
            <div class="col-md-5">
              <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$i]['caratula'], 300, 300))); ?>" class="featurette-image img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 300px; height: 300px;">
            </div>
            <div class="col-md-7">
              <h2 class="featurette-heading"><?php echo $albumes[$i]['album']; ?></h2>
              <p class="lead"><?php echo $albumes[$i]['artista']; ?></p>
            </div>
          </div>
        </a>
        <?php endfor; ?>
      </main>
<?php
include('footer.php');
?>