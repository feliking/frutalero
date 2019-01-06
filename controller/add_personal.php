<?php

if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			$found=false;
			$sql1= "SELECT * FROM personal WHERE carnet=\"$_POST[carnet]\" and nacionalidad=\"$_POST[nacionalidad]\"";
			$query1 = $con->query($sql1);
			while ($r=$query1->fetch_array()) {
				$found=true;
				break;
			}
			if($found){
				print "<script>alert(\"El carnet de identidad ya se encuentra registrado, por favor verifique\");window.location='../views/add-personal.php';</script>";
			}
			else{
			$respaldo=null;
			if (!$_FILES['respaldo']['error']==4) {
				if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
					$respaldo=time().$_FILES['respaldo']['name'];
					$origen2=$_FILES['respaldo']['tmp_name'];
					$destino2="../files/rrhh/curriculum/$respaldo";
					move_uploaded_file($origen2,$destino2);
				}
				else{
					print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add-personal.php';</script>";
				}
			}
			else{
				$respaldo="";
			}
			$sql = "INSERT INTO personal(
				carnet,
				nacionalidad,
				nombres,
			  	apellidos,
		 		sexo,
				fecha_nac,
				curriculum,
				fecha_ingreso,
				area_trabajo,
				cargo,
				sueldo_mensual,
				responsable)
				VALUES (
			\"$_POST[carnet]\",
			\"$_POST[nacionalidad]\",
			\"$_POST[nombres]\",
			\"$_POST[apellidos]\",
			\"$_POST[sexo]\",
			\"$_POST[fecha_nac]\",
			'$respaldo',
			\"$_POST[fecha_ingreso]\",
			\"$_POST[area_trabajo]\",
			\"$_POST[cargo]\",
			\"$_POST[sueldo_mensual]\",
			\"$_POST[ide]\")";
			$query = $con->query($sql) or die(mysqli_error($con));
			if($query!=null){
				print "<script>alert(\"El nuevo miembro del personal fue registrado exitosamente.\");window.location='../views/view-personal.php';</script>";
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

}
else{
	echo "falla el primer if";
}

?>