<?php
include('core/musiccloud.class.php');
if(!isset($_SESSION['correo'])){
  header("Location: login.php");
}
$generos=$web->obtenerGeneros($_SESSION['correo']);
include('header.php');
?>
      <main>
        <?php
        for($i=0; $i<count($generos); $i++):
          $albumes=$web->obtenerALbumesGenero($_SESSION['correo'], $generos[$i]['id_genero']);
          $a=0;
        ?>
        <a href="genero_.php?id_genero=<?php echo $generos[$i]['id_genero']; ?>" class="cambiar">
          <div class="row feat">
            <div class="col-md feat">
              <div class="img-t-b2">
                  <div class="img-left2">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$a]['caratula'], 150, 150))); ?>" class="img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 150px; height: 150px;">
                  </div>
                  <div class="img-rigth2">
                    <?php $a=($a+1<count($albumes))?$a+1:0; ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$a]['caratula'], 150, 150))); ?>" class="img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 150px; height: 150px;">
                  </div>
                </div>
                <div class="img-t-b2">
                  <div class="img-left2">
                    <?php $a=($a+1<count($albumes))?$a+1:0; ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$a]['caratula'], 150, 150))); ?>" class="img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 150px; height: 150px;">
                  </div>
                  <div class="img-rigth2">
                    <?php $a=($a+1<count($albumes))?$a+1:0; ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$a]['caratula'], 150, 150))); ?>" class="img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 150px; height: 150px;">
                  </div>
                </div>
            </div>
            <div class="col-md feat">
              <h2 class="featurette-heading"><?php echo $generos[$i]['genero']; ?></h2>
            </div>
          </div>
        </a>
        <?php endfor; ?>
      </main>
<?php
include('footer.php');
?>