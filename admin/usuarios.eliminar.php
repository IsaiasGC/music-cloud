<?php
	include('header.php');
	if (isset($_GET['id_usuario'])) {
		$id_usuario=$_GET['id_usuario'];
		if (is_numeric($id_usuario)) {
			$curl = curl_init();

	        curl_setopt_array($curl, array(
	          CURLOPT_URL => "http://localhost/musiccloud/ws/usuario/?id=".$id_usuario,
	          CURLOPT_RETURNTRANSFER => true,
	          CURLOPT_ENCODING => "",
	          CURLOPT_MAXREDIRS => 10,
	          CURLOPT_TIMEOUT => 30,
	          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	          CURLOPT_CUSTOMREQUEST => "DELETE",
	          CURLOPT_POSTFIELDS => "",
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
		}
	}
	include('footer.php');
?>