<?php
include('core/musiccloud.class.php');
if(!isset($_SESSION['correo'])){
  header("Location: login.php");
}
$listas=$web->obtenerListas($_SESSION['correo']);
include('header.php');
?>
      <main>
        <?php for($i=0; $i<count($listas); $i++): ?>
        <div class="row listas">
          <?php for($j=0; $j<4; $j++): ?>
          <div class="col-xl-3">
            <?php
            if($i<count($listas)):
              $albumes=$web->obtenerALbumesLista($_SESSION['correo'], $listas[$i]['id_lista']);
              $a=0;
            ?>
            <div class="thumbnail">
              <a href="lista_.php?id_lista=<?php echo $listas[$i]['id_lista'] ?>">
                <div class="img-t-b">
                  <div class="img-left">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$a]['caratula'], 100, 100))); ?>" class="featurette-image img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 100px; height: 100px;">
                  </div>
                  <div class="img-rigth">
                    <?php $a=($a+1<count($albumes))?$a+1:0; ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$a]['caratula'], 100, 100))); ?>" class="featurette-image img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 100px; height: 100px;">
                  </div>
                </div>
                <div class="img-t-b">
                  <div class="img-left">
                    <?php $a=($a+1<count($albumes))?$a+1:0; ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$a]['caratula'], 100, 100))); ?>" class="featurette-image img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 100px; height: 100px;">
                  </div>
                  <div class="img-rigth">
                    <?php $a=($a+1<count($albumes))?$a+1:0; ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode(stripslashes($web->thumb($albumes[$a]['caratula'], 100, 100))); ?>" class="featurette-image img-fluid mx-auto" data-holder-rendered="true" alt="lista 1" style="width: 100px; height: 100px;">
                  </div>
                </div>
              </a>
            </div>
            <div class="caption">
              <h5><?php echo $listas[$i]['lista']; ?></h5>
            </div>
            <?php $i++; endif; ?>
          </div>
          <?php endfor; ?>
        </div>
        <?php endfor; ?>
      </main>
<?php
include('footer.php');
?>