<?php

if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
				include('conexion.php');
				$sql = "INSERT INTO horarios_a(
					id_personal,
					id_horario)
					VALUES (
				\"$_POST[id_personal]\",
				\"$_POST[id_horario]\"
				)";
				$query = $con->query($sql) or die(mysqli_error($con));
				if($query!=null){
					print "<script>alert(\"El horario se asignó correctamente\");window.location='../views/view-horarios-a.php';</script>";
				}
			}
		}
		else{
			echo "falla el segundo if";
		}
	}

?>