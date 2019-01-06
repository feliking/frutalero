<?php
require ('../reportes/fpdf/fpdf.php');
if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
				include('conexion.php');
				$sql = "INSERT INTO memorandums(
					id_personal,
					tipo,
					detalle,
					fecha)
					VALUES (
				\"$_POST[id_personal]\",
				\"$_POST[tipo]\",
				\"$_POST[detalle]\",
				\"$_POST[fecha]\"
				)";
				$query = $con->query($sql) or die(mysqli_error($con));
				if($query!=null){
					
					print "<script>alert(\"El memorandum fue generado\");window.location='../views/view-memo.php';</script>";
					
				}
			}
		}
		else{
			echo "falla el segundo if";
		}
	}

?>