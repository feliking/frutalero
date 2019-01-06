<?php
$permiso=null;
$detalle=null;
if(!empty($_POST)){
	if(isset($_POST["nro_req"])){
		if($_POST["nro_req"]!=""){
			include "conexion.php";
			if (!$_FILES['respaldo']['error']==4) {
				if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
					$respaldo=time().$_FILES['respaldo']['name'];
					$origen2=$_FILES['respaldo']['tmp_name'];
					$destino2="../files/cuadro/$respaldo";
					move_uploaded_file($origen2,$destino2);
				}
				else{
					print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_request.php';</script>";
				}
			}
			else{
				$respaldo="";
			}
			if($_POST["ide"]==null){
				print "<script>alert(\"No puede acceder al registro, no esta identificado.\");window.location='../views/request.php';</script>";
				mysqli_close($con);
			}
			else{
				if(isset($_POST['confir'])){
					$permiso=implode(",",$_POST['confir']);
				}
				if ($_POST['costo']=="") {
					$costo=0;
				}
				else{
					$costo=$_POST['costo'];
				}
			$detalle=mysqli_real_escape_string($con,$_POST['detalle']);
			$sql = "insert into request(
				nro_req,
				fecha_entrega,
				area_of,
				detalle,
				ref,
				presu,
				costo,
				resp,
				estado,
				cuadro,
				fecha_entregado,
				enviado,
				confir,
				proveedor,
				diseno,
				obs,
				modalidad,
				cuentacon,
				estadocon) values (
					\"$_POST[nro_req]\",
					\"$_POST[fecha_entrega]\",
					\"$_POST[area_of]\",
					'$detalle',
					\"$_POST[ref]\",
					\"$_POST[presu]\",
					'$costo',
					\"$_POST[resp]\",
					\"$_POST[estado]\",
					'$respaldo',
					\"$_POST[fecha_entregado]\",
					\"$_POST[enviado]\",
					'$permiso',
					\"$_POST[proveedor]\",
					\"$_POST[diseno]\",
					\"$_POST[obs]\",
					\"$_POST[modalidad]\",
					\"$_POST[cuentacon]\",
					\"$_POST[estadocon]\")";
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add_request.php';</script>";
				mysqli_close($con);
			}
			else{
				echo "Hay problemas con la consulta";
			}
			}
		}
		else{
			print "<script>alert(\"Debe introducir el número\");window.location='../views/add_request.php';</script>";
		}
	}
	else{
		print "<script>alert(\"Debe introducir el número\");window.location='../views/add_request.php';</script>";
	}
}
else{
	echo "Hay problemas en el primer if";
}
?>