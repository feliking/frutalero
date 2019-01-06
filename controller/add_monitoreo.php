<?php
if(!empty($_POST)){
	if(isset($_POST["region"]) && isset($_POST["centro_focal"]) && isset($_POST["nombre"]) && isset($_POST["fecha_ini"]) && isset($_POST["fecha_fin"]) && isset($_POST["moneda"]) && isset($_POST["canon_mensual"]) && isset($_POST["ide"])){
		if($_POST["region"]!=""&& $_POST["centro_focal"]!=""&&$_POST["nombre"]!=""&& $_POST["moneda"]!=""&& $_POST["canon_mensual"]!=""&&$_POST["ide"]!=""){
			include "conexion.php";
			if($_POST["fecha_ini"]>$_POST["fecha_fin"]){
				print "<script>alert(\"Revise las fechas, la fecha de inicio es mayor a la del final.\");window.location='../views/add-monitoreo.php';</script>";
				mysqli_close($con);
			}
			else{
			$respaldo=null;
			if (!$_FILES['respaldo']['error']==4) {
		        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
		          $respaldo=time().$_FILES['respaldo']['name'];
		          $origen=$_FILES['respaldo']['tmp_name'];
		          $destino="../files/monitoreo/respaldo/$respaldo";
		          move_uploaded_file($origen,$destino);
		        }
		        else{
		          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add-monitoreo.php;</script>";
		        }
		      }
		      else{
		        $respaldo="";
		      }
		      $sql = "insert into monitoreo(region,centro_focal,proveedor,fecha_ini,fecha_fin,cobro,moneda,respaldo,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[nombre]\",\"$_POST[fecha_ini]\",\"$_POST[fecha_fin]\",\"$_POST[canon_mensual]\",\"$_POST[moneda]\",'$respaldo',\"$_POST[ide]\")";
		      if ($_POST['canon_mensual']=="") {
				$_POST['canon_mensual']==0;
			}
			if ($_POST['fecha_ini']=="" && $_POST['fecha_fin']=="") {
				$sql = "insert into monitoreo(region,centro_focal,proveedor,cobro,moneda,respaldo,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[nombre]\",\"$_POST[canon_mensual]\",\"$_POST[moneda]\",'$respaldo',\"$_POST[ide]\")";
			}
			if ($_POST['fecha_fin']=="" && !$_POST['fecha_ini']=="") {
				$sql = "insert into monitoreo(region,centro_focal,proveedor,fecha_ini,cobro,moneda,respaldo,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[nombre]\",\"$_POST[fecha_ini]\",\"$_POST[canon_mensual]\",\"$_POST[moneda]\",'$respaldo',\"$_POST[ide]\")";
			}
			if (!$_POST['fecha_fin']=="" && $_POST['fecha_ini']=="") {
				$sql = "insert into monitoreo(region,centro_focal,proveedor,fecha_fin,cobro,moneda,respaldo,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[nombre]\",\"$_POST[fecha_fin]\",\"$_POST[canon_mensual]\",\"$_POST[moneda]\",'$respaldo',\"$_POST[ide]\")";
			}
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/view-monitoreo.php';</script>";
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