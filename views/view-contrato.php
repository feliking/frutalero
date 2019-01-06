<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]!=0 && $_SESSION["tipo"]!=2){
        print "<script>alert(\"No tiene permisos para acceder a esta página\");window.location='../views/system.php';</script>";
    }
}
else{
  print "<script>alert(\"No puede tener acceso si no esta identificado.\");window.location='../index.php';</script>";
}
require_once('layout-head.php');
?>
<style type="text/css">
        .valores{
            text-align: right;
        }
        .titulo{
            font-size: 40px;
            font-family: fuentenueva;
        }
        #vigente{
            background-color: #BFFFD5;
        }
        #notificado{
            background-color: #FEFFC6;
        }
        #vencido{
            background-color: #FFD0D0;
        }
        #adorno{
            background-color: #fff;
        }
</style>
<?php require_once('layout-body.php'); ?>
<div class="container-fluid">
      <!-- Start Page Content -->
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Listado de otros contratos</h4>
                      <h6 class="card-subtitle">Estos contratos pertenecen a varias categorías</h6>
                      <div class="table-responsive m-t-40">
                        <table id="example23" class="display text-nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>NRO</th>
                                        <th>EMPRESA</th>
                                        <th>DETALLE</th>
                                        <th>FECHA DE INICIO</th>
                                        <th>FECHA FINAL</th>
                                        <th>VALIDEZ CONTRATO</th>
                                        <th>VIGENTE/VENCIDO</th>
                                        <th>MONTO EN BS</th>
                                        <th>MONTO EN $US</th>
                                        <th></th>
                                        <?php if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
                                            echo "<th>AÑADIDO POR:</th>";
                                        } ?>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>NRO</th>
                                        <th>EMPRESA</th>
                                        <th>DETALLE</th>
                                        <th>FECHA DE INICIO</th>
                                        <th>FECHA FINAL</th>
                                        <th>VALIDEZ CONTRATO</th>
                                        <th>VIGENTE/VENCIDO</th>
                                        <th>MONTO EN BS</th>
                                        <th>MONTO EN $US</th>
                                        <th></th>
                                        <?php if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
                                            echo "<th>AÑADIDO POR:</th>";
                                        } ?>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                    use PHPMailer\PHPMailer\PHPMailer;
                                    use PHPMailer\PHPMailer\Exception;
                                    require '../phpmailer/Exception.php';
                                    require '../phpmailer/PHPMailer.php';
                                    require '../phpmailer/SMTP.php';
                                    $count=0;
                                    require("../controller/conexion.php");
                                    $sql=("SELECT * FROM otros_contratos");
                                    $query=mysqli_query($con,$sql);
                                    while($arreglo=mysqli_fetch_array($query)){
                                        $count++;
                                        $confi=date("Y-m-d");
                                      $nuevo=strtotime("+2 month",strtotime($confi));
                                      $nuevo=date("Y-m-d",$nuevo);
                                      $nuevo2=strtotime("+1 month",strtotime($confi));
                                      $nuevo2=date("Y-m-d",$nuevo2);
                                      if ($arreglo[4]>date("Y-m-d")) {
                                          $campo="vigente";
                                      }
                                      if ($arreglo[4]<$nuevo && $arreglo[4]>date("Y-m-d")) {
                                          $campo="notificado";
                                          if ($arreglo[10]!=""&&$arreglo[12]!=1) {
                                            if ($arreglo[4]<$nuevo2 && $arreglo[4]>date("Y-m-d")) {
                                                    if ($arreglo[13]!=1) {
                                                        $mail = new PHPMailer(true);
                                                        try {
                                                            include "mail_config.php";
                                                            //Recipients
                                                            $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
                                                            $varios = explode(";",$arreglo[10]);
                                                            for ($i=0; $i <count($varios) ; $i++) {
                                                                $mail->addAddress($varios[$i], 'Remitente de Frutalero S.R.L.');
                                                            }
                                                            $mail->isHTML(true);
                                                            $mail->Subject = "Notificacion de conclusion de contrato";
                                                            $mail->Body    = "Frutalero S.R.L. informa a la empresa $arreglo[1] por el concepto de $arreglo[2] que le quedan menos de un mes para su conclusion, Que tenga una excelente jornada";
                                                            $mail->send();
                                                            $sql1= "UPDATE otros_contratos set noti2=1 where id_ot=$arreglo[0]";
                                                            $query1 = $con->query($sql1);
                                                            echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[1]\");window.location='../views/view-contrato.php';</script>";
                                                        } catch (Exception $e) {
                                                            echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>";
                                                            echo $mail->ErrorInfo;
                                                        }
                                                    }
                                          }
                                          else{
                                                        $mail = new PHPMailer(true);
                                                        try {
                                                            include "mail_config.php";
                                                            //Recipients
                                                            $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
                                                            $varios = explode(";",$arreglo[10]);
                                                            for ($i=0; $i <count($varios) ; $i++) {
                                                                $mail->addAddress($varios[$i], 'Remitente de Frutalero S.R.L.');
                                                            }
                                                            $mail->isHTML(true);
                                                            $mail->Subject = "Notificacion de conclusion de contrato";
                                                            $mail->Body    = "Frutalero S.R.L. informa a la empresa $arreglo[1] por el concepto de $arreglo[2] que le quedan menos de dos meses para su conclusion, Que tenga una excelente jornada";
                                                            $mail->send();
                                                            $sql1= "UPDATE otros_contratos set noti1=1 where id_ot=$arreglo[0]";
                                                            $query1 = $con->query($sql1);
                                                            echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[1]\");window.location='../views/view-contrato.php';</script>";
                                                        } catch (Exception $e) {
                                                            echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>";
                                                            echo $mail->ErrorInfo;
                                                        }
                                          }
                                            }
                                      }
                                      $nuevo3=strtotime("+1 week",strtotime($confi));
                                      $nuevo3=date("Y-m-d",$nuevo3);
                                      if ($arreglo[4]<date("Y-m-d")) {
                                          $campo="vencido";
                                          if ($arreglo[11]!=""&&$arreglo[14]!=1) {
                                                if ($arreglo[4]<$nuevo3 && $arreglo[4]<date("Y-m-d")) {
                                                    if ($arreglo[15]!=1) {
                                                        $mail = new PHPMailer(true);
                                                        try {
                                                            include "mail_config.php";
                                                            //Recipients
                                                            $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
                                                            $varios = explode(";",$arreglo[11]);
                                                            for ($i=0; $i <count($varios) ; $i++) {
                                                                $mail->addAddress($varios[$i], 'Remitente de Frutalero S.R.L.');
                                                            }
                                                            $mail->isHTML(true);
                                                            $mail->Subject = "Notificacion de conclusion de contrato";
                                                            $mail->Body    = "Frutalero S.R.L. informa a la empresa $arreglo[1] por el concepto de $arreglo[2] que lleva mas de una semana de vencido, Que tenga una excelente jornada";
                                                            $mail->send();
                                                            $sql1= "update otros_contratos set noti4=1 where id_ot=$arreglo[0]";
                                                            $query1 = $con->query($sql1);
                                                            echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[1]\");window.location='../views/view-contrato.php';</script>";
                                                        } catch (Exception $e) {
                                                            echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>";
                                                            echo $mail->ErrorInfo;
                                                        }
                                                    }
                                                }
                                                else{
                                                    $mail = new PHPMailer(true);
                                                        try {
                                                            include "mail_config.php";
                                                            //Recipients
                                                            $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
                                                            $varios = explode(";",$arreglo[11]);
                                                            for ($i=0; $i <count($varios) ; $i++) {
                                                                $mail->addAddress($varios[$i], 'Remitente de Frutalero S.R.L.');
                                                            }
                                                            $mail->isHTML(true);
                                                            $mail->Subject = "Notificacion de conclusion de contrato";
                                                            $mail->Body    = "Frutalero S.R.L. informa a la empresa $arreglo[1] por el concepto de $arreglo[2] acaba de vencer, Que tenga una excelente jornada";
                                                            $mail->send();
                                                            $sql1= "update otros_contratos set noti3=1 where id_ot=$arreglo[0]";
                                                            $query1 = $con->query($sql1);
                                                            echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[1]\");window.location='../views/view-contrato.php';</script>";
                                                        } catch (Exception $e) {
                                                            echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>";
                                                            echo $mail->ErrorInfo;
                                                        }
                                                }
                                          }
                                      }
                                      if ($arreglo[4]=="") {
                                          $campo=null;
                                      }
                                      echo "<tr id='$campo' class='text-dark'>";
                                      echo "<td>$count</td>";
                                      echo "<td>$arreglo[1]</td>";
                                      echo "<td>$arreglo[2]</td>";
                                      echo "<td>$arreglo[3]</td>";
                                      echo "<td>$arreglo[4]</td>";
                                      echo "<td>$arreglo[5]</td>";
                                      echo "<td>$arreglo[6]</td>";
                                      $monto=number_format((floatval($arreglo[7])),2,".",",");
                                      echo "<td class='valores'>$monto</td>";
                                      $monto2=number_format((floatval($arreglo[8])),2,".",",");
                                      echo "<td class='valores'>$monto2</td>";
                                      echo "<td class='text-center'><a class='btn btn-link' href='../views/update-contrato.php?id=$arreglo[0]'><span class='fa fa-pencil'></span></a><a class='btn btn-link' href='../controller/delete_otros.php?id=$arreglo[0]'><span class='fa fa-trash'></span></a></td>";
                                      if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
                                        $sql2=("SELECT * FROM usuario where id_user=\"$arreglo[9]\"");
                                        $query2=mysqli_query($con,$sql2);
                                        $nombre=mysqli_fetch_array($query2);
                                        echo "<td>$nombre[2] $nombre[3]</td>";
                                      }
                                      echo "</tr>";
                                    }
                                    mysqli_close($con);
                                    ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
<?php require_once('layout-footer.php'); ?>
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
<?php require_once('layout-close.php'); ?>