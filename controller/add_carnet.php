<?php

if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			$respaldo=null;
			if (!$_FILES['respaldo']['error']==4) {
				if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
					$respaldo=time().$_FILES['respaldo']['name'];
					$origen2=$_FILES['respaldo']['tmp_name'];
					$destino2="../files/rrhh/carnet/$respaldo";
					move_uploaded_file($origen2,$destino2);
				}
				else{
					print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add-carnet.php';</script>";
				}
			}
			else{
				$respaldo="";
			}
			$sql = "INSERT INTO carnet_sanitario(
				id_personal,
				emitido,
				validez,
				respaldo)
				VALUES (
			\"$_POST[id_personal]\",
			\"$_POST[emitido]\",
			\"$_POST[validez]\",
			'$respaldo')";
			$query = $con->query($sql) or die(mysqli_error($con));
			if($query!=null){
				print "<script>alert(\"Carnet sanitario registrado correctamente\");window.location='../views/view-carnet.php';</script>";
			}
			}
		}
		else{
			echo "falla el tercer if";
		}
	}
	else{
		echo "falla el segundo if";
	}

?>