<?php
if (isset($_GET['cancion'])) {
	header("Content-disposition: attachment; filename=music/");
	header("Content-type: MIME");
	readfile("nombre_del_archivo.extension");
}
?>