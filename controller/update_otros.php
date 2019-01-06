<?php
	include "conexion.php";
  if ($_POST['fecha_fin']!=$_POST['fecha']) {
        $sqlc = "UPDATE otros_contratos SET noti1=0,noti2=0,noti3=0,noti4=0 WHERE id_ot=$_POST[ide]";
        $queryc = $con->query($sqlc);
      }
      $sql = "UPDATE otros_contratos SET
      empresa=\"$_POST[empresa]\",
      detalle=\"$_POST[detalle]\",
      fecha_ini=\"$_POST[fecha_ini]\",
      fecha_fin=\"$_POST[fecha_fin]\",
      observacion=\"$_POST[observacion]\",
      estado=\"$_POST[estado]\",
      montobs=\"$_POST[monto]\",
      montosus=\"$_POST[monto2]\",
      correo=\"$_POST[correo]\",
      correo2=\"$_POST[correo2]\"
      WHERE id_ot=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
				session_start();
				$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Actualizó otros contratos','SISCON',NOW())";
				$update = $con->query($action) or die(mysqli_error($con));
        print "<script>alert(\"El contrato fue actualizado exitosamente.\");window.location='../views/view-contrato.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
 ?>
