<?php
  session_start();
  if ($_SESSION['user_id']==null || $_SESSION['tipo']!=0) {
    print "<script>alert(\"No puede realizar estas acciones como usuario.\");window.location='../views/view-user.php';</script>";
    exit;
  }
  $tabla="usuario";
  extract($_GET);
  include "conexion.php";
  $sql2= "DELETE FROM $tabla WHERE id_user=$id";
  $query2 = $con->query($sql2);
  if($query2!=null){
    $action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Eliminó un usuario','Gestión de usuarios',NOW())";
    $update = $con->query($action) or die(mysqli_error($con));
      print "<script>alert(\"El usuario fue eliminado, ya no tendra acceso al sistema\");window.location='../views/view-user.php';</script>";
  }
  else{
      print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/view-user.php';</script>";
  }
?>
