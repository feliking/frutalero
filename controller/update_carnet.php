<?php

if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			if (!$_FILES['respaldo']['error']==4) {
		        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
		          $respaldo=time().$_FILES['respaldo']['name'];
		          $origen2=$_FILES['respaldo']['tmp_name'];
		          $destino2="../files/rrhh/carnet/$respaldo";
		          move_uploaded_file($origen2,$destino2);
		        }
		        else{
		          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update-carnet.php?$_POST[ide]';</script>";
		        }
		      }
		      else{
		        $respaldo=$_POST['docu1'];
		      }
		      $sql2 = "UPDATE carnet_sanitario SET
		       	emitido = \"$_POST[emitido]\",
				validez = \"$_POST[validez]\",
				respaldo = '$respaldo'
				where id=\"$_POST[ide]\"";
			$query = $con->query($sql2) or die(mysqli_error($con));
			if($query!=null){
				print "<script>alert(\"Datos actualizados correctamente\");window.location='../views/view-carnet.php';</script>";
			}
			else{
				print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/home.php';</script>";
			}
			}
			else{
				echo "Pasa algo en el tercer if";
			}
		}
		else{
			echo "Pasa algo en el segundo if";
		}
	}
	else{
		echo "Pasa algo en el primer if";
	}


?>