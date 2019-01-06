<?php

if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			$respaldo = null;
			if (!$_FILES['respaldo']['error']==4) {
		        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
		          $respaldo=time().$_FILES['respaldo']['name'];
		          $origen2=$_FILES['respaldo']['tmp_name'];
		          $destino2="../files/rrhh/curriculum/$respaldo";
		          move_uploaded_file($origen2,$destino2);
		        }
		        else{
		          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update-personal.php?$_POST[ide]';</script>";
		        }
		      }
		      else{
		        $respaldo=$_POST['docu1'];
		      }
		      $sql2 = "UPDATE personal SET
		       	carnet = \"$_POST[carnet]\",
		       	nacionalidad = \"$_POST[nacionalidad]\",
				nombres = \"$_POST[nombres]\",
				apellidos=\"$_POST[apellidos]\",
				sexo=\"$_POST[sexo]\",
				fecha_nac = \"$_POST[fecha_nac]\",
				curriculum = '$respaldo',
				fecha_ingreso = \"$_POST[fecha_ingreso]\",
				area_trabajo=\"$_POST[area_trabajo]\",
				cargo=\"$_POST[cargo]\",
				sueldo_mensual=\"$_POST[sueldo_mensual]\"
				where id=\"$_POST[ide]\"";
			$query = $con->query($sql2) or die(mysqli_error($con));
			if($query!=null){
				print "<script>alert(\"Datos actualizados correctamente\");window.location='../views/view-personal.php';</script>";
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
