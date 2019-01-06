<?php
	include "conexion.php";
	$respaldo=null;
	if (!$_FILES['respaldo']['error']==4) {
        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
          $respaldo=time().$_FILES['respaldo']['name'];
          $origen=$_FILES['respaldo']['tmp_name'];
          $destino="../files/seguridad/respaldo/$respaldo";
          move_uploaded_file($origen,$destino);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update-seguridad.php?id=$_POST[ide]';</script>";
        }
      }
      else{
        $respaldo=$_POST['docu1'];
      }
      if ($_POST['fecha_fin']!=$_POST['fecha']) {
        $sqlc = "UPDATE seguridad SET noti1=0,noti2=0,noti3=0 WHERE id_segu=$_POST[ide]";
        $queryc = $con->query($sqlc);
      }
      $sql = "UPDATE seguridad SET
      region=\"$_POST[region]\",
      centro_focal=\"$_POST[centro_focal]\",
      tipo_centro_focal=\"$_POST[tipo_centro_focal]\",
      nombre_empresa=\"$_POST[nombre]\",
      fecha_ini=\"$_POST[fecha_ini]\",
      fecha_fin=\"$_POST[fecha_fin]\",
      nro_guardias=\"$_POST[guardias]\",
      canon_mensualbs=\"$_POST[canon_mensualbs]\",
      canon_menualsus=\"$_POST[canon_mensualsus]\",
      respaldo='$respaldo',
      correo=\"$_POST[correo]\",
      correo2=\"$_POST[correo2]\"
      WHERE id_segu=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
				session_start();
				$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Actualizó contrato de seguridad','SISCON',NOW())";
				$update = $con->query($action) or die(mysqli_error($con));
        print "<script>alert(\"El contrato fue actualizado exitosamente.\");window.location='../views/view-seguridad.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
 ?>
