<?php
include('header.php');
if (isset($_POST['actualizar'])) {
    $usuario=$_POST['usuario'];
    $nombre=$_POST['nombre'];
    $correo=$_POST['correo'];
    $contrasenia=$_POST['contrasenia'];
    $contrasenia2=$_POST['contrasenia2'];
    $rol=$_POST['rol'];
    if($contrasenia==$contrasenia2){
        // $contrasenia=md5($contrasenia);
        // $sql="INSERT INTO usuario(usuario, nombre, correo, contrasenia) VALUES(:usuario, :nombre, :correo, :contrasenia)";
        // $statement=$web->db->prepare($sql);
        // $statement->bindParam(":usuario", $usuario);
        // $statement->bindParam(":nombre", $nombre);
        // $statement->bindParam(":correo", $correo);
        // $statement->bindParam(":contrasenia", $contrasenia);
        // $statement->execute();

        // $param=array(":correo"=>$correo);
        // $datos=$web->queryArray("SELECT id_usuario FROM usuario WHERE correo=:correo", $param);
        // $id_usuario=$datos[0]['id_usuario'];
        // $sql="INSERT INTO rol_usuario(id_rol, id_usuario) VALUES(:id_rol, :id_usuario)";
        // $stm=$web->db->prepare($sql);
        // $stm->bindParam(":id_rol", $rol['id_rol']);
        // $stm->bindParam(":id_usuario", $id_usuario);
        // $stm->execute();
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
                echo '<div class="alert alert-success" role="alert">'.$resul->mensaje.'</div>';
            }else{
                echo '<div class="alert alert-danger" role="alert">'.$resul->mensaje.'</div>';
            }
            
        }
    }else{
        echo '<div class="alert alert-danger" role="alert">Las contraseñas no coinsiden</div>';
    }
}
$roles=$web->queryArray("SELECT * FROM rol ORDER BY 1 desc");
?>
<form action="usuarios.insertar.php" method="post">
    <div class="form-group">
        <label>usuario</label>
        <input type="text" class="form-control" name="usuario" required>
    </div>
    <div class="form-group">
        <label>nombre</label>
        <input type="text" class="form-control" name="nombre" required>
    </div>
    <div class="form-group">
        <label>correo</label>
        <input type="text" class="form-control" name="correo" required>
    </div>
    <div class="form-group">
        <label>contraseña</label>
        <input type="password" class="form-control" name="contrasenia" required>
    </div>
    <div class="form-group">
        <label>contraseña<span class="text-muted">(repetir)</span></label>
        <input type="password" class="form-control" name="contrasenia2" required>
    </div>
    <div class="form-group">
        <label>ROL</label>
        <select class="form-control" name="rol" required>
            <?php
            foreach ($roles as $key => $value) {
                echo '<option value="'.$value['id_rol'].'">'.$value['rol'].'</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <input name="actualizar" class="btn btn-outline-primary" type="submit" value="Insertar">
    </div>
</form>
<?php
include('footer.php');
?>