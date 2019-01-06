<?php
	include "conexion.php";
	$respaldo=null;
  $permiso=null;
  $detalle=null;
	if (!$_FILES['respaldo']['error']==4) {
        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
          $respaldo=time().$_FILES['respaldo']['name'];
          $origen=$_FILES['respaldo']['tmp_name'];
          $destino="../files/cuadro/$respaldo";
          move_uploaded_file($origen,$destino);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_req.php?id=$_POST[ide]';</script>";
        }
      }
      else{
        $respaldo=$_POST['docu1'];
      }
      //Agregar la condicional de los correos electronicos
      if(isset($_POST['confir'])){
          $permiso=implode(",",$_POST['confir']);
        }
        $detalle=mysqli_real_escape_string($con,$_POST['detalle']);
      $sql = "UPDATE request SET
      nro_req=\"$_POST[nro_req]\",
      fecha_entrega=\"$_POST[fecha_entrega]\",
      area_of=\"$_POST[area_of]\",
      detalle='$detalle',
      ref=\"$_POST[ref]\",
      presu=\"$_POST[presu]\",
      costo=\"$_POST[costo]\",
      resp=\"$_POST[resp]\",
      estado=\"$_POST[estado]\",
      cuadro='$respaldo',
      fecha_entregado=\"$_POST[fecha_entregado]\",
      enviado=\"$_POST[enviado]\",
      confir='$permiso',
      proveedor=\"$_POST[proveedor]\",
      diseno=\"$_POST[diseno]\",
      obs=\"$_POST[obs]\"
      WHERE id_req=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
				session_start();
				$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Actualizó un requerimiento','REKADMIN',NOW())";
				$update = $con->query($action) or die(mysqli_error($con));
        print "<script>alert(\"El requerimiento fue actualizado exitosamente.\");window.location='../views/principal.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
 ?>
