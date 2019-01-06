<?php
if(!empty($_POST)){
	if(isset($_POST["region"]) && isset($_POST["centro_focal"]) && isset($_POST["nombre"]) && isset($_POST["fecha_ini"]) && isset($_POST["fecha_fin"]) && isset($_POST["guardias"]) && isset($_POST["ide"])){
		if($_POST["region"]!=""&& $_POST["centro_focal"]!=""&&$_POST["nombre"]!=""&& $_POST["guardias"]!=""&&$_POST["ide"]!=""){
			include "conexion.php";
			if($_POST["fecha_ini"]>$_POST["fecha_fin"]){
				print "<script>alert(\"Revise las fechas, la fecha de inicio es mayor a la del final.\");window.location='../views/add-seguridad.php';</script>";
			}
			else{
			$respaldo=null;
			if (!$_FILES['respaldo']['error']==4) {
		        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
		          $respaldo=time().$_FILES['respaldo']['name'];
		          $origen=$_FILES['respaldo']['tmp_name'];
		          $destino="../files/seguridad/respaldo/$respaldo";
		          move_uploaded_file($origen,$destino);
		        }
		        else{
		          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add-seguridad.php;</script>";
		        }
		      }
		      else{
		        $respaldo="";
		      }
		      $sql = "insert into seguridad(region,centro_focal,tipo_centro_focal,nombre_empresa,fecha_ini,fecha_fin,nro_guardias,canon_mensualbs,canon_menualsus,respaldo,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",\"$_POST[nombre]\",\"$_POST[fecha_ini]\",\"$_POST[fecha_fin]\",\"$_POST[guardias]\",\"$_POST[canon_mensualbs]\",\"$_POST[canon_mensualsus]\",'$respaldo',\"$_POST[ide]\")";
		      if ($_POST['canon_mensualbs']=="") {
				$_POST['canon_mensualbs']==0;
			}
			if ($_POST['canon_mensualsus']=="") {
				$_POST['canon_mensualsus']==0;
			}
			if ($_POST['fecha_ini']=="" && $_POST['fecha_fin']=="") {
				$sql = "insert into seguridad(region,centro_focal,tipo_centro_focal,nombre_empresa,nro_guardias,canon_mensualbs,canon_menualsus,respaldo,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",\"$_POST[nombre]\",\"$_POST[guardias]\",\"$_POST[canon_mensualbs]\",\"$_POST[canon_mensualsus]\",'$respaldo',\"$_POST[ide]\")";
			}
			if ($_POST['fecha_fin']=="" && !$_POST['fecha_ini']=="") {
				$sql = "insert into seguridad(region,centro_focal,tipo_centro_focal,nombre_empresa,fecha_ini,nro_guardias,canon_mensualbs,canon_menualsus,respaldo,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",\"$_POST[nombre]\",\"$_POST[fecha_ini]\",\"$_POST[guardias]\",\"$_POST[canon_mensualbs]\",\"$_POST[canon_mensualsus]\",'$respaldo',\"$_POST[ide]\")";
			}
			if (!$_POST['fecha_fin']=="" && $_POST['fecha_ini']=="") {
				$sql = "insert into seguridad(region,centro_focal,tipo_centro_focal,nombre_empresa,fecha_fin,nro_guardias,canon_mensualbs,canon_menualsus,respaldo,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",\"$_POST[nombre]\",\"$_POST[fecha_fin]\",\"$_POST[guardias]\",\"$_POST[canon_mensualbs]\",\"$_POST[canon_mensualsus]\",'$respaldo',\"$_POST[ide]\")";
			}
			$query = $con->query($sql);
			if($query!=null){
				$origen2=$_FILES['respaldo']['tmp_name'];
				$destino2="../files/seguridad/respaldo/$respaldo";
				move_uploaded_file($origen2,$destino2);
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/view-seguridad.php';</script>";
			}
			else{
				echo "Hay problemas con la consulta";
			}
			}
		}
		else{
			echo "Hay problemas en el tercer if";
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