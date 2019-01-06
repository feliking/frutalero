<?php 
	include "conexion.php";
      if(isset($_POST['confir'])){
        $confir=implode(",",$_POST['confir']);
      }
      $sql = "UPDATE request SET 
      confir='$confir'
      WHERE id_req=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
        print "<script>alert(\"Se guardaron los cambios correctamente.\");window.location='../views/principal.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
 ?>