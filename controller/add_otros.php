<?php
if(!empty($_POST)){
	if(isset($_POST["empresa"]) && isset($_POST["detalle"]) && isset($_POST["fecha_ini"]) && isset($_POST["fecha_fin"])  && isset($_POST["monto"])  && isset($_POST["ide"])){
		if($_POST["empresa"]!=""&& $_POST["detalle"]!=""&&$_POST["fecha_ini"]!=""&&$_POST["fecha_fin"]!=""&& $_POST["monto"]!=""&&$_POST["ide"]!=""){
			include "conexion.php";
			$found=false;
			if($_POST["ide"]==null){
				print "<script>alert(\"Acceso restringido, identifiquese.\");window.location='../views/add-otros.php';</script>";
				mysqli_close($con);
			}
			else{
				$sql = "insert into otros_contratos(empresa,detalle,fecha_ini,fecha_fin,observacion,estado,montobs,montosus,responsable) values (\"$_POST[empresa]\",\"$_POST[detalle]\",\"$_POST[fecha_ini]\",\"$_POST[fecha_fin]\",\"$_POST[observacion]\",\"$_POST[estado]\",\"$_POST[monto]\",\"$_POST[monto2]\",\"$_POST[ide]\")";
			if ($_POST['monto']=="") {
				$_POST['monto']==0;
			}
			if ($_POST['monto2']=="") {
				$_POST['monto2']==0;
			}	
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add-otros.php';</script>";
				mysqli_close($con);
			}
			else{
				echo "Hay problemas con la consulta";
			}
			}
		}
		else{
			echo "Hay probelmas en el tercer if";
		}
	}
	else{
		echo "Hay problemas en el segundo if";
	}
}
else{
	echo "Hay problemas en el primer if";
}
?>