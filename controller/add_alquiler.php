<?php
if(!empty($_POST)){
	if(isset($_POST["region"]) && isset($_POST["centro_focal"]) && isset($_POST["tipo_centro_focal"]) && isset($_POST["nombre"]) && isset($_POST["fecha_ini"]) && isset($_POST["fecha_fin"]) && isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			if($_POST["fecha_ini"]>$_POST["fecha_fin"]){
				print "<script>alert(\"Revise las fechas, la fecha de inicio es mayor a la del final.\");window.location='../views/add-alquiler.php';</script>";
			}
			else{
			$folio_real=null;
			$respaldo=null;
			if (!$_FILES['folio_real']['error']==4) {
				if ($_FILES['folio_real']['type']=="image/jpeg"||$_FILES['folio_real']['type']=="image/png"||$_FILES['folio_real']['type']=="image/gif"||$_FILES['folio_real']['type']=="application/pdf") {
					$folio_real=time().$_FILES['folio_real']['name'];
					$origen=$_FILES['folio_real']['tmp_name'];
					$destino="../files/alquileres/folio_real/$folio_real";
					move_uploaded_file($origen,$destino);
				}
				else{
					print "<script>alert(\"El formato de archivo de folio real no es admitido por el sistema\");window.location='../views/add-alquiler.php';</script>";
				}
			}
			else{
				$folio_real="";
			}
			if (!$_FILES['respaldo']['error']==4) {
				if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
					$respaldo=time().$_FILES['respaldo']['name'];
					$origen2=$_FILES['respaldo']['tmp_name'];
					$destino2="../files/alquileres/respaldo/$respaldo";
					move_uploaded_file($origen2,$destino2);
				}
				else{
					print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add-alquiler.php';</script>";
				}
			}
			else{
				$respaldo="";
			}
			if ($_POST['canon_mensualbs']=="") {
				$_POST['canon_mensualbs']==0;
			}
			if ($_POST['canon_mensualsus']=="") {
				$_POST['canon_mensualsus']==0;
			}
			$sql = "insert into alquiler(
					region,centro_focal,tipo_centro_focal,nombre_contratante,fecha_ini,fecha_fin,canon_mensualbs,canon_mensualsus,folio_real,respaldo,garantiabs,garantiasus,devuelto,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",\"$_POST[nombre]\",\"$_POST[fecha_ini]\",\"$_POST[fecha_fin]\",\"$_POST[canon_mensualbs]\",\"$_POST[canon_mensualsus]\",'$folio_real','$respaldo',\"$_POST[garantiabs]\",\"$_POST[garantiasus]\",\"$_POST[devuelto]\",\"$_POST[ide]\")";
			
			if ($_POST['fecha_ini']=="" && $_POST['fecha_fin']=="") {
				$sql = "insert into alquiler(region,centro_focal,tipo_centro_focal,nombre_contratante,canon_mensualbs,canon_mensualsus,folio_real,respaldo,garantiabs,garantiasus,devuelto,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",\"$_POST[nombre]\",\"$_POST[canon_mensualbs]\",\"$_POST[canon_mensualsus]\",'$folio_real','$respaldo',\"$_POST[garantiabs]\",\"$_POST[garantiasus]\",\"$_POST[devuelto]\",\"$_POST[ide]\")";
			}
			if ($_POST['fecha_fin']=="" && !$_POST['fecha_ini']=="") {
				$sql = "insert into alquiler(region,centro_focal,tipo_centro_focal,nombre_contratante,fecha_ini,canon_mensualbs,canon_mensualsus,folio_real,respaldo,garantiabs,garantiasus,devuelto,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",\"$_POST[nombre]\",\"$_POST[fecha_ini]\",\"$_POST[canon_mensualbs]\",\"$_POST[canon_mensualsus]\",'$folio_real','$respaldo',\"$_POST[garantiabs]\",\"$_POST[garantiasus]\",\"$_POST[devuelto]\",\"$_POST[ide]\")";
			}
			if (!$_POST['fecha_fin']=="" && $_POST['fecha_ini']=="") {
				$sql = "insert into alquiler(region,centro_focal,tipo_centro_focal,nombre_contratante,fecha_fin,canon_mensualbs,canon_mensualsus,folio_real,respaldo,garantiabs,garantiasus,devuelto,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",\"$_POST[nombre]\",\"$_POST[fecha_fin]\",\"$_POST[canon_mensualbs]\",\"$_POST[canon_mensualsus]\",'$folio_real','$respaldo',\"$_POST[garantiabs]\",\"$_POST[garantiasus]\",\"$_POST[devuelto]\",\"$_POST[ide]\")";
			}
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/view-alquiler.php';</script>";
			}
			else{
				echo "Error interno del sistema: Puede ser que incluyo simbolos o caracteres especiales en algun campo, o algun campo obligatorio lo dejo vacio";
			}
			}
		}
		else{ echo "algo anda mal 3er if"; }
	}
	else{ echo "algo anda mal 2do if"; }
}
else{ echo "algo anda mal 1er if"; }
?>