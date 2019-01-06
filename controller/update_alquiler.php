<?php
if(!empty($_POST)){
  if(isset($_POST["region"]) && isset($_POST["centro_focal"]) && isset($_POST["tipo_centro_focal"]) && isset($_POST["nombre"]) && isset($_POST["fecha_ini"]) && isset($_POST["fecha_fin"]) && isset($_POST["ide"])){
    if($_POST["ide"]!=""){
      include "conexion.php";
      if($_POST["fecha_ini"]>$_POST["fecha_fin"]){
        print "<script>alert(\"Revise las fechas, la fecha de inicio es mayor a la del final.\");window.location='../views/update-alquiler.php?$_POST[ide]';</script>";
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
          print "<script>alert(\"El formato de archivo de folio real no es admitido por el sistema\");window.location='../views/update-alquiler.php?$_POST[ide]';</script>";
        }
      }
      else{
        $folio_real=$_POST['docu1'];
      }
      if (!$_FILES['respaldo']['error']==4) {
        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
          $respaldo=time().$_FILES['respaldo']['name'];
          $origen2=$_FILES['respaldo']['tmp_name'];
          $destino2="../files/alquileres/respaldo/$respaldo";
          move_uploaded_file($origen2,$destino2);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update-alquiler.php?$_POST[ide]';</script>";
        }
      }
      else{
        $respaldo=$_POST['docu2'];
      }
      if ($_POST['fecha_fin']!=$_POST['fecha']) {
        $sqlc = "UPDATE alquiler SET noti1=0,noti2=0,noti3=0,noti4=0 WHERE id_alqui=$_POST[ide]";
        $queryc = $con->query($sqlc);
      }
      if ($_POST['canon_mensualbs']=="") {
        $_POST['canon_mensualbs']==0;
      }
      if ($_POST['canon_mensualsus']=="") {
        $_POST['canon_mensualsus']==0;
      }
      $sql = "UPDATE alquiler SET region=\"$_POST[region]\",centro_focal=\"$_POST[centro_focal]\",tipo_centro_focal=\"$_POST[tipo_centro_focal]\",nombre_contratante=\"$_POST[nombre]\",fecha_ini=\"$_POST[fecha_ini]\",fecha_fin=\"$_POST[fecha_fin]\",canon_mensualbs=\"$_POST[canon_mensualbs]\",canon_mensualsus=\"$_POST[canon_mensualsus]\",folio_real='$folio_real',respaldo='$respaldo',garantiabs=\"$_POST[garantiabs]\",garantiasus=\"$_POST[garantiasus]\",devuelto=\"$_POST[devuelto]\",correo=\"$_POST[correo]\" WHERE id_alqui=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
        session_start();
				$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Actualizó contrato de alquiler','SISCON',NOW())";
				$update = $con->query($action) or die(mysqli_error($con));
        print "<script>alert(\"El contrato fue actualizado exitosamente.\");window.location='../views/view-alquiler.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
      }
    }
    else{ echo "algo anda mal 3er if"; }
  }
  else{ echo "algo anda mal 2do if"; }
}
else{ echo "algo anda mal 1er if"; }
?>
