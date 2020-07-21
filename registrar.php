<?php
include('core/musiccloud.class.php');
if(isset($_POST["registrar"])){
	$web=new Musiccloud;
	$web->conexion();
	$nombre=$_POST["nombre"]." ".$_POST["apellido"];
	$usuario=$_POST["usuario"];
	$correo=$_POST["correo"];
	$contrasenia=$_POST["contrasenia"];
	$rol=2;
	// $sql="INSERT INTO usuario(usuario, correo, contrasenia, nombre) VALUES(:usuario, :correo, :contrasenia, :nombre)";
	// $statment=$web->db->prepare($sql);
	// $statment->bindParam(':usuario', $usuario);
	// $statment->bindParam(':correo', $correo);
	// $statment->bindParam(':contrasenia', $contrasenia);
	// $statment->bindParam(':nombre', $nombre);
	// $statment->execute();
	$curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://localhost/musiccloud/ws/usuario/",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "[\n    {\n        \"usuario\": \"$usuario\",\n        \"correo\": \"$correo\",\n        \"contrasenia\": \"$contrasenia\",\n        \"nombre\": \"$nombre\",\n        \"rol\":\n        \t\t{\n        \t\t\t\"id_rol\":$rol\n        \t\t}\n    }\n]",
      CURLOPT_HTTPHEADER => array(
        "Postman-Token: fbd3f976-91e3-4878-87b0-72d9ab0cad55",
        "cache-control: no-cache"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if($err){
        echo "cURL Error #:" . $err;
    }else{
        $resul=json_decode($response);
        if ($resul->estatus=="OK") {
            header("Location: canciones.php");
        }else{
            echo '<div class="alert alert-danger" role="alert">'.$resul->mensaje.'</div>';
        }        
    }
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <title>Registrar</title>

	    <!-- Bootstrap core CSS -->
	    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    	<link rel="stylesheet" href="http://localhost/add/bootstrap/css/bootstrap.min.css">
    	<link rel="stylesheet" type="text/css" href="css/main.css">

	    <!-- Custom styles for this template -->
	    <link href="form-validation.css" rel="stylesheet">
	  </head>

	  <body class="bg-light">

	    <div class="container">
	      <div class="py-5 text-center">
	        <img class="d-block mx-auto mb-4" src="images/icono.png" alt="" width="72" height="72">
	        <h2>Formulario de Registro</h2>
	      </div>

	      <div class="row">
	        <div class="col-md-2 order-md-2 mb-4">
	        </div>
	        <div class="col-md-2 order-md-3 mb-4">
	        </div>
	        <div class="col-md-8 order-md-2">
	          <h4 class="mb-3">Datos:</h4>
	          <form class="needs-validation" action="registrar.php" method="POST" name="f1" onsubmit="return comprobarClave(event)">
	            <div class="row">
	              <div class="col-md-6 mb-3">
	                <label for="firstName">Nombre</label>
	                <input class="form-control" id="firstName" placeholder="" name="nombre" required="" type="text">
	                <div class="invalid-feedback">
	                  Se requiere un Nombre.
	                </div>
	              </div>
	              <div class="col-md-6 mb-3">
	                <label for="lastName">Apellidos</label>
	                <input class="form-control" id="lastName" placeholder="" name="apellido" required="" type="text">
	                <div class="invalid-feedback">
	                  Se requiere un apellido.
	                </div>
	              </div>
	            </div>

	            <div class="mb-3">
	              <label for="username">Nombre de Usuario</label>
	              <div class="input-group">
	                <div class="input-group-prepend">
	                  <span class="input-group-text">@</span>
	                </div>
	                <input class="form-control" id="username" placeholder="Nombre de Usuario" required="" type="text" name="usuario">
	                <div class="invalid-feedback" style="width: 100%;">
	                  Es requerido tu nombre de usuario.
	                </div>
	              </div>
	            </div>

	            <div class="mb-3">
	              <label for="email">Correo electronico</label>
	              <input class="form-control" id="email" placeholder="tu@ejemplo.com" required="" type="email" name="correo">
	              <div class="invalid-feedback">
	                Ingrese un correo valido.
	              </div>
	            </div>

	            <div class="mb-3">
	              <label for="address">Contraseña</label>
	              <input class="form-control" id="address" required="" type="password" name="contrasenia" autocomplete="off">
	              <div class="invalid-feedback">
	                Ingrese una contraseña.
	              </div>
	            </div>

	            <div class="mb-3">
	              <label for="address2">Contraseña<span class="text-muted">(repetir)</span></label>
	              <input class="form-control" id="address2" required="" type="password" name="contrasenia2" autocomplete="off">
	              <div class="invalid-feedback">
	                Repita su contraseña.
	              </div>
	            </div>
	            
	            <hr class="mb-4">
	            <button class="btn btn-primary btn-lg btn-block" type="submit" name="registrar">Registrar</button>
	          </form>
	        </div>
	      </div>

	      <div class="my-5 pt-5 text-muted text-center text-small">
	        <p class="mb-1">© 2017-2018 Music cloud</p>
	      </div>
	    </div>

	    <!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
	    <script src="../../assets/js/vendor/popper.min.js"></script>
	    <script src="../../dist/js/bootstrap.min.js"></script>
	    <script src="../../assets/js/vendor/holder.min.js"></script>
	    <script>
	      // Example starter JavaScript for disabling form submissions if there are invalid fields
	      (function() {
	        'use strict';

	        window.addEventListener('load', function() {
	          // Fetch all the forms we want to apply custom Bootstrap validation styles to
	          var forms = document.getElementsByClassName('needs-validation');

	          // Loop over them and prevent submission
	          var validation = Array.prototype.filter.call(forms, function(form) {
	            form.addEventListener('submit', function(event) {
	              if (form.checkValidity() === false) {
	                event.preventDefault();
	                event.stopPropagation();
	              }
	              form.classList.add('was-validated');
	            }, false);
	          });
	        }, false);
	      })();
	    </script>
	    <script>
	    	function comprobarClave(e){
			    clave1 = document.f1.contrasenia.value;
			    clave2 = document.f1.contrasenia2.value;
			    if (clave1 != clave2){
			       alert("Las contraseñas no coinciden")
			       document.f1.contrasenia2.value="";
			       document.f1.contrasenia2.focus();
			       e.returnValue=false;
			    }
			    e.returnValue=true;
			} 
	    </script>
	</body>
</html>