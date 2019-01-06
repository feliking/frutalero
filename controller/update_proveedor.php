<?php
	include "conexion.php";
	$respaldo=null;
	if (!$_FILES['respaldo']['error']==4) {
        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
          $respaldo=time().$_FILES['respaldo']['name'];
          $origen=$_FILES['respaldo']['tmp_name'];
          $destino="../files/proveedor/$respaldo";
          move_uploaded_file($origen,$destino);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_proveedor.php?id=$_POST[ide]';</script>";
        }
      }
      else{
        $respaldo=$_POST['docu1'];
      }
      //Agregar la condicional de los correos electronicos
      $sql = "UPDATE proveedor SET
      nombre=\"$_POST[nombre]\",
      nit=\"$_POST[nit]\",
      direccion=\"$_POST[direccion]\",
      email=\"$_POST[email]\",
      contacto=\"$_POST[contacto]\",
      telefono=\"$_POST[telefono]\",
      archivo='$respaldo',
      nro_cuenta=\"$_POST[nro_cuenta]\"
      WHERE id_pro=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
				session_start();
				$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Actualizó a un proveedor','REKADMIN',NOW())";
				$update = $con->query($action) or die(mysqli_error($con));
        print "<script>alert(\"El contrato fue actualizado exitosamente.\");window.location='../views/principal.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
 ?>
