<?php

if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
				include('conexion.php');
				$sql = "INSERT INTO inasistencias(
					id_personal,
					fecha,
					justificacion)
					VALUES (
				\"$_POST[id_personal]\",
				\"$_POST[fecha]\",
				\"$_POST[justificacion]\"
				)";
				$query = $con->query($sql) or die(mysqli_error($con));
				if($query!=null){
					print "<script>alert(\"La inasistencia se registró correctamente\");window.location='../views/view-unses.php';</script>";
				}
			}
		}
		else{
			echo "falla el segundo if";
		}
	}

?>