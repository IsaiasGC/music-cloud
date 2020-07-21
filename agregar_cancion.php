<?php
	include('core/musiccloud.class.php');
	if(!isset($_SESSION['correo'])){
	  header("Location: login.php");
	}
	if(isset($_POST['enviar'])){
		$id_usuario=$web->usuario($_SESSION['correo']);
		$titulo=$_POST['titulo'];
		$artista=$_POST['artista'];
		$album=$_POST['album'];
		$genero=$_POST['genero'];

		if($_FILES['cancion']['error']==0){
			$MAX_SIZE=100000000;
			$file_type_sound=$_FILES['cancion']['type'];
			$file_name_sound=$_FILES['cancion']['name'];
			$file_ext_sound=strtolower(substr($file_name_sound,strrpos($file_name_sound,".")));
			$uploadDir_sound="music/";
			if ($titulo=="") {
				$titulo=substr($file_name_sound,0 ,strrpos($file_name_sound,"."));
			}
			$titulo=str_replace(" ", "_", $titulo);
			$titulo=substr(md5($titulo.rand()), 0, 14)."-".$titulo;
			$uploadFile_sound=$uploadDir_sound.$titulo.$file_ext_sound;

			if($_FILES['cancion']['size']<=$MAX_SIZE && $file_ext_sound=='.mp3'){
				$al=$web->album($album);
				$ar=$web->artista($artista);
				$ge=$web->genero($genero);

				move_uploaded_file($_FILES['cancion']['tmp_name'], $uploadFile_sound);
				
				if ($_FILES['caratula']['error']==0) {
					$ext=strtolower(substr($_FILES['caratula']['name'],strrpos($_FILES['caratula']['name'],".")));
					if ($ext==".jpg" || $ext==".png") {
						$caratula=addslashes(file_get_contents($_FILES['caratula']['tmp_name']));
					}else{
						echo '<div class="alert alert-danger" role="alert">La extencion no es valida('.$ext.')</div>';
					}
				}else{
					$caratula="";
				}
				if($al==-1){
					if($album!=""){
						$sql="INSERT INTO album(album) VALUES(:album)";
						$stm=$web->db->prepare($sql);
						$stm->bindParam(":album", $album);
						if ($stm->execute())
							$al=$web->album($album);
						else
							$al=1;
					}else{
						$al=1;
					}
				}
				if($ar==-1){
					if($artista!=""){
						$sql="INSERT INTO artista(artista) VALUES(:artista)";
						$stm=$web->db->prepare($sql);
						$stm->bindParam(":artista", $artista);
						if ($stm->execute())
							$ar=$web->artista($artista);
						else
							$ar=1;
					}else{
						$ar=1;
					}
				}
				if (count($web->album_artista($al, $ar))==0){
					$sql="INSERT INTO album_artista(id_album, id_artista, caratula) VALUES(:id_album, :id_artista, :caratula)";
					$stm=$web->db->prepare($sql);
					$stm->bindParam(":id_album", $al);
					$stm->bindParam(":id_artista", $ar);
					$stm->bindParam(":caratula", $caratula);
					$stm->execute();
				}else{
					$car=$web->album_artista($al, $ar);
					if ($car[0]['caratula']=="" && $caratula!="") {
						$sql="UPDATE album_artista SET caratula=:caratula WHERE id_album=:id_album AND id_artista=:id_artista";
						$stm=$web->db->prepare($sql);
						$stm->bindParam(":id_album", $al);
						$stm->bindParam(":id_artista", $ar);
						$stm->bindParam(":caratula", $caratula);
						$stm->execute();
					}
				}
				if($ge==-1){
					if($genero!=""){
						$sql="INSERT INTO genero(genero) VALUES(:genero)";
						$stm=$web->db->prepare($sql);
						$stm->bindParam(":genero", $genero);
						if ($stm->execute())
							$ge=$web->genero($genero);
						else
							$ge=1;
					}else{
						$ge=1;
					}
				}
				$sql="INSERT INTO cancion(cancion, id_usuario, id_album, id_artista, id_genero) VALUES(:cancion, :id_usuario, :id_album, :id_artista, :id_genero)";
				$stm=$web->db->prepare($sql);
				$stm->bindParam(":cancion", $titulo);
				$stm->bindParam(":id_usuario", $id_usuario);
				$stm->bindParam(":id_album", $al);
				$stm->bindParam(":id_artista", $ar);
				$stm->bindParam(":id_genero", $ge);
				$resul=$stm->execute();
				if($resul)
					echo '<div class="alert alert-success" role="alert">Se ha añadido correctamente la cancion</div>';
				else
					echo '<div class="alert alert-danger" role="alert">Algo ha salido mal, intentelo nuevamente</div>';
			}else{
?>
				<script language="javascript">
					alert('El archivo de audio es demasiado grande, debe reducir su tamaño, o no es un archivo de audio valido');
				</script>
<?php
			}
		}
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
    
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/style.css">
    <link href="font/css/open-iconic-bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Music Clound!</title>
  </head>
  <body>
    <div class="container-fluid">
    	<br />
    	<header>
	  		<div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
			  <div class="btn-group" role="group" aria-label="First group">
			  	<h3>Agregar Cancion:</h3>
			  </div>
			  <div class="input-group">
			    <a href="canciones.php" class="icon-library_music icon" style="text-decoration: none;"></a>
			  </div>
			</div>
	  	</header>
		<form action="agregar_cancion.php" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label class="text-muted">Cancion:</label>
				<input type="file" id="cancion" name="cancion" class="filestyle" required>
			</div>
			<div class="form-group">
				<label class="text-muted">Titulo:</label>
				<input type="text" name="titulo" class="form-control" autocomplete="off">
			</div>
			<div class="form-group">
				<datalist id="artistas">
					<?php
						$sql="SELECT artista FROM artista";
						$artistas=$web->queryArray($sql);
						foreach ($artistas as $key => $value) {
							echo '<option value="'.$value['artista'].'"></option>';
						}
					?>
				</datalist>
				<label class="text-muted">Artista:</label>
				<input type="text" name="artista" class="form-control" list="artistas" autocomplete="off">
			</div>
			<div class="form-group">
				<datalist id="albumes">
					<?php
						$sql="SELECT album FROM album";
						$albumes=$web->queryArray($sql);
						foreach ($albumes as $key => $value) {
							echo '<option value="'.$value['album'].'"></option>';
						}
					?>
				</datalist>
				<label class="text-muted">Album:</label>
				<input type="text" name="album" class="form-control" list="albumes" autocomplete="off">
				<input type="file" id="caratula" name="caratula" class="filestyle">
			</div>
			<div class="form-group">
				<datalist id="generos">
					<?php
						$sql="SELECT genero FROM genero";
						$generos=$web->queryArray($sql);
						foreach ($generos as $key => $value) {
							echo '<option value="'.$value['genero'].'"></option>';
						}
					?>
				</datalist>
				<label class="text-muted">Genero:</label>
				<input type="text" name="genero" class="form-control" list="generos" autocomplete="off">
			</div>
			<input class="btn btn-dark" type="submit" name="enviar" value="Subir">
		</form>
	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="http://localhost/add/jquery-3.3.1.slim.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
    <script src="http://localhost/add/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
    <script src="http://localhost/add/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/bootstrap-filestyle.min.js"></script>
    <script type="text/javascript">
    	$('#cancion').filestyle({
    			buttonBefore: true,
				badge: true,
				text : ' Cancion',
				btnClass : 'btn-secondary',
				htmlIcon : '<span class="oi oi-folder"></span>',
				'placeholder' : 'Seleccione un archivo(mp3)'
			});
    	$('#caratula').filestyle({
				badge: true,
				text : ' Agregar caratula<span class="text-muted">(opcional)</span>',
				input : false,
				btnClass : 'btn-secondary',
				htmlIcon : '<span class="oi oi-folder"></span>'
			});
    </script>
  </body>
</html>