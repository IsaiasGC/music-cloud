<?php
include('header.php');
if (isset($_GET['id_usuario'])) {
    $id_usuario=$_GET['id_usuario'];
    if (is_numeric($id_usuario)) {
        if (isset($_POST['actualizar'])) {
            $usuario=$_POST['usuario'];
            $nombre=$_POST['nombre'];
            $correo=$_POST['correo'];
            $contrasenia=$_POST['contrasenia'];
            $contrasenia2=$_POST['contrasenia2'];
            // $pass="";
            // $p=true;
            // if(strlen($contrasenia)>0){
            //     if($contrasenia==$contrasenia2){
            //         $contrasenia=md5($contrasenia);
            //         $pass=", contrasenia=:contrasenia";
            //     }else{
            //         echo '<div class="alert alert-danger" role="alert">Las contraseñas no coinsiden</div>';
            //         $p=false;
            //     }
            // }
            if($contrasenia==$contrasenia2){
                $curl = curl_init();
                // echo "[\n    {\n        \"usuario\": \"$usuario\",\n        \"correo\": \"$correo\",\n        \"contrasenia\": \"$contrasenia\",\n        \"nombre\": \"$nombre\",\n    }\n]";
                // die();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "http://localhost/musiccloud/ws/usuario/?id=".$id_usuario."",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "PUT",
                  CURLOPT_POSTFIELDS => "[\n    {\n        \"usuario\": \"$usuario\",\n        \"correo\": \"$correo\",\n        \"contrasenia\": \"$contrasenia\",\n        \"nombre\": \"$nombre\"\n    }\n]",
                  CURLOPT_HTTPHEADER => array(
                    "Postman-Token: b6a3527b-7e98-4fac-a225-fcb0da8af22d",
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
                    // if (isset($response)) {
                    //     print_r($response);
                    //     if (isset($resul->estatus)) {
                    //         echo "Si esta";
                    //     }else{
                    //         echo "No se uq epedo";
                    //     }
                    // }else{
                    //     echo "No pues no";
                    // }
                    // die();
                    if ($resul->estatus=="OK") {
                        echo '<div class="alert alert-success" role="alert">'.$resul->mensaje.'</div>';
                    }else{
                        echo '<div class="alert alert-danger" role="alert">'.$resul->mensaje.'</div>';
                    }
                }
            }else{
                echo '<div class="alert alert-danger" role="alert">Las contraseñas no coinsiden</div>';
            }
            // $sql="UPDATE usuario SET usuario=:usuario, nombre=:nombre, correo=:correo".$pass." WHERE id_usuario=:id_usuario";
            // $statement=$web->db->prepare($sql);
            // $statement->bindParam(":usuario", $usuario);
            // $statement->bindParam(":nombre", $nombre);
            // $statement->bindParam(":correo", $correo);
            // if (strlen($pass)>0) {
            //     $statement->bindParam(":contrasenia", $contrasenia);
            // }
            // $statement->bindParam(":id_usuario", $id_usuario);
            // $statement->execute();
            // if ($p) {
            //     echo '<div class="alert alert-success" role="alert">El usuario se modifico Correctamente</div>';
            // }
        }
        $param=array(':id_usuario'=>$id_usuario);
        $usuario=$web->queryArray("SELECT * FROM usuario WHERE id_usuario=:id_usuario", $param);
    }
}
?>
<form action="usuarios.actualizar.php?id_usuario=<?php echo $id_usuario ?>" method="post">
    <div class="form-group">
        <label>usuario</label>
        <input type="text" class="form-control" name="usuario" required value="<?php echo $usuario[0]['usuario']; ?>" >
    </div>
    <div class="form-group">
        <label>nombre</label>
        <input type="text" class="form-control" name="nombre" required value="<?php echo $usuario[0]['nombre']; ?>">
    </div>
    <div class="form-group">
        <label>correo</label>
        <input type="text" class="form-control" name="correo" required value="<?php echo $usuario[0]['correo']; ?>" autocomplete="off">
    </div>
    <div class="form-group">
        <label>contraseña<span class="text-muted">(Modifica solo si se quiere cambiar)</span></label>
        <input type="password" class="form-control" name="contrasenia" autocomplete="off">
    </div>
    <div class="form-group">
        <label>ROL</label>
        <input type="password" class="form-control" name="contrasenia2" autocomplete="off">
    </div>
    <div class="form-group">
        <input name="actualizar" class="btn btn-outline-primary" type="submit" value="Modificar">
    </div>
</form>
<?php
include('footer.php');
?>