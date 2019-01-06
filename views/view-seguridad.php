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
                      <h4 class="card-title">Listado de contratos de seguridad</h4>
                      <h6 class="card-subtitle">Estos contratos representan a los guardias de la empresa</h6>
                      <div class="table-responsive m-t-40">
                        <table id="example23" class="display text-nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
						            <tr>
						                <th></th>
						                <th></th>
						                <th></th>
						                <th></th>
						                <th></th>
						                <th colspan="2">FECHA CONTRATO</th>
						                <th>AÑOS</th>
						                <th></th>
						                <th colspan="2">CANON MENSUAL ORIG.</th>
						                <th>ESTADO DEL CTTO</th>
						                <th>SOLICITUD</th>
						                <?php if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
						                    echo "<th></th>";
						                    echo "<th></th>";
						                } ?>
						            </tr>
						            <tr>
						                <th>NRO</th>
						                <th>REGIONAL</th>
						                <th>CENTRO FOCAL</th>
						                <th>TIPO CENTRO FOCAL</th>
						                <th>NOMBRE DE LA EMPRESA</th>
						                <th>FECHA DE INICIO</th>
						                <th>FECHA FINAL</th>
						                <th>DURACION</th>
						                <th>NRO DE GUARDIAS</th>
						                <th>BS</th>
						                <th>$us</th>
						                <th>CONFIRMAR DATO</th>
						                <th>RESPALDO</th>
						                <?php if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
						                    echo "<th></th>";
						                    echo "<th>AÑADIDO POR:</th>";
						                } ?>
						            </tr>
						        </thead>
						        <tfoot>
						            <tr>
						                <th>NRO</th>
						                <th>REGIONAL</th>
						                <th>CENTRO FOCAL</th>
						                <th>TIPO CENTRO FOCAL</th>
						                <th>NOMBRE DE LA EMPRESA</th>
						                <th>FECHA DE INICIO</th>
						                <th>FECHA FINAL</th>
						                <th>DURACION</th>
						                <th>NRO DE GUARDIAS</th>
						                <th>BS</th>
						                <th>$us</th>
						                <th>CONFIRMAR DATO</th>
						                <th>RESPALDO</th>
						                <?php if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
						                    echo "<th></th>";
						                    echo "<th>AÑADIDO POR:</th>";
						                } ?>
						            </tr>
						            <tr>
						                <th></th>
						                <th></th>
						                <th></th>
						                <th></th>
						                <th></th>
						                <th colspan="2">FECHA CONTRATO</th>
						                <th>AÑOS</th>
						                <th></th>
						                <th colspan="2">CANON MENSUAL ORIG.</th>
						                <th>ESTADO DEL CTTO</th>
						                <th>SOLICITUD</th>
						                <?php if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
						                    echo "<th></th>";
						                    echo "<th></th>";
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
						            $sumabs=0;
						            $sumasus=0;
						            require("../controller/conexion.php");
						            if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2 || $_SESSION["regional"]=="OF. NACIONAL") {
						                $sql=("SELECT * FROM seguridad");
						            }
						            else{
						                $sql=("SELECT * FROM seguridad where region=\"$_SESSION[regional]\"");
						            }
						            $query=mysqli_query($con,$sql);
						            while($arreglo=mysqli_fetch_array($query)){
						                $count++;
						              $confi=date("Y-m-d");
						              $nuevo=strtotime("+2 month",strtotime($confi));
						              $nuevo=date("Y-m-d",$nuevo);
						              $nuevo2=strtotime("+1 month",strtotime($confi));
						              $nuevo2=date("Y-m-d",$nuevo2);
						              if ($arreglo[6]>date("Y-m-d")) {
						                  $campo="vigente";
						              }
						              if ($arreglo[6]<$nuevo && $arreglo[6]>date("Y-m-d")) {
						                  $campo="notificado";
						                  if ($arreglo[12]!=""&&$arreglo[14]!=1) {
						                    if ($arreglo[6]<$nuevo2 && $arreglo[6]>date("Y-m-d")) {
						                            if ($arreglo[15]!=1) {
						                                $mail = new PHPMailer(true);
						                                try {
						                                    include "mail_config.php";
						                                    //Recipients
						                                    $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
						                                    $varios = explode(";",$arreglo[12]);
						                                    for ($i=0; $i <count($varios) ; $i++) {
						                                        $mail->addAddress($varios[$i], 'Remitente de Frutalero S.R.L.');
						                                    }
						                                    $mail->isHTML(true);
						                                    $mail->Subject = "Notificacion de conclusion de contrato";
						                                    $mail->Body    = "Frutalero S.R.L. informa a la empresa $arreglo[4] que su contrato de seguridad con la regional $arreglo[2] tiene menos de un mes para concluir, Que tenga una excelente jornada";
						                                    $mail->send();
						                                    $sql1= "UPDATE seguridad set noti2=1 where id_segu=$arreglo[0]";
						                                    $query1 = $con->query($sql1);
						                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[4]\");window.location='../views/view-seguridad.php';</script>";
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
						                                    $varios = explode(";",$arreglo[12]);
						                                    for ($i=0; $i <count($varios) ; $i++) {
						                                        $mail->addAddress($varios[$i], 'Remitente de Frutalero S.R.L.');
						                                    }
						                                    $mail->isHTML(true);
						                                    $mail->Subject = "Notificacion de conclusion de contrato";
						                                    $mail->Body    = "Frutalero S.R.L. informa a la empresa $arreglo[4] que su contrato de seguridad con la regional $arreglo[2] tiene menos de dos meses para concluir, Que tenga una excelente jornada";
						                                    $mail->send();
						                                    $sql1= "UPDATE seguridad set noti1=1 where id_segu=$arreglo[0]";
						                                    $query1 = $con->query($sql1);
						                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[4]\");window.location='../views/view-seguridad.php';</script>";
						                                } catch (Exception $e) {
						                                    echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>";
						                                    echo $mail->ErrorInfo;
						                                }
						                  }
						                    }
						              }
						              $nuevo3=strtotime("+1 week",strtotime($confi));
						              $nuevo3=date("Y-m-d",$nuevo3);
						              if ($arreglo[6]<date("Y-m-d")) {
						                  $campo="vencido";
						                  if ($arreglo[13]!=""&&$arreglo[16]!=1) {
						                        if ($arreglo[6]<$nuevo3 && $arreglo[6]<date("Y-m-d")) {
						                            if ($arreglo[17]!=1) {
						                                $mail = new PHPMailer(true);
						                                try {
						                                    include "mail_config.php";
						                                    //Recipients
						                                    $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
						                                    $varios = explode(";",$arreglo[13]);
						                                    for ($i=0; $i <count($varios) ; $i++) {
						                                        $mail->addAddress($varios[$i], 'Remitente de Frutalero S.R.L.');
						                                    }
						                                    $mail->isHTML(true);
						                                    $mail->Subject = "Notificacion de conclusion de contrato";
						                                    $mail->Body    = "Frutalero S.R.L. informa a la empresa $arreglo[4] que su contrato de seguridad con la regional $arreglo[2] tiene mas de una semana vencida, Que tenga una excelente jornada";
						                                    $mail->send();
						                                    $sql1= "update seguridad set noti4=1 where id_segu=$arreglo[0]";
						                                    $query1 = $con->query($sql1);
						                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[4]\");window.location='../views/view-seguridad.php';</script>";
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
						                                    $varios = explode(";",$arreglo[13]);
						                                    for ($i=0; $i <count($varios) ; $i++) {
						                                        $mail->addAddress($varios[$i], 'Remitente de Frutalero S.R.L.');
						                                    }
						                                    $mail->isHTML(true);
						                                    $mail->Subject = "Notificacion de conclusion de contrato";
						                                    $mail->Body    = "Frutalero S.R.L. informa a la empresa $arreglo[4] que su contrato de seguridad con la regional $arreglo[2] acaba de vencer, Que tenga una excelente jornada";
						                                    $mail->send();
						                                    $sql1= "update seguridad set noti3=1 where id_segu=$arreglo[0]";
						                                    $query1 = $con->query($sql1);
						                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[4]\");window.location='../views/view-seguridad.php';</script>";
						                                } catch (Exception $e) {
						                                    echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>";
						                                    echo $mail->ErrorInfo;
						                                }
						                        }
						                  }
						              }
						              if ($arreglo[6]=="0000-00-00") {
						                  $campo=null;
						              }
						              echo "<tr id='$campo'>";
						              echo "<td>$count</td>";
						              echo "<td>$arreglo[1]</td>";
						              echo "<td>$arreglo[2]</td>";
						              echo "<td>$arreglo[3]</td>";
						              echo "<td>$arreglo[4]</td>";
						              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[5]));
						              echo "<td>$fecha</td>";
						              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[6]));
						              echo "<td>$fecha2</td>";
						              $duracion=intval($arreglo[6])-intval($arreglo[5]);
						              echo "<td>$duracion</td>";
						              echo "<td>$arreglo[7]</td>";
						                $monto=number_format((floatval($arreglo[8])),2,".",",");
						                echo "<td class='valores'>$monto</td>";
						                $monto2=number_format((floatval($arreglo[9])),2,".",",");
						                echo "<td class='valores'>$monto2</td>";
						              if($arreglo[6]>date("Y-m-d")){
						                echo "<td>Contrato Vigente</td>";
						              }
						              else{
						                echo "<td>Vencido</td>";
						              }
						              if ($arreglo[10]!=null) {
						                echo "<td><a href='../files/seguridad/respaldo/$arreglo[10]' target='_blank'>Ver documento de respaldo</td>";
						              }
						              else{
						                echo "<td>No se subió documento de respaldo</td>";
						              }

						              if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
						                echo "<td class='text-center'><a class='btn btn-link' href='../views/update-seguridad.php?id=$arreglo[0]'><span class='fa fa-pencil'></span></a><a class='btn btn-link' href='../controller/delete_seguridad.php?id=$arreglo[0]'><span class='fa fa-trash'></span></a></td>";
						                $sql2=("SELECT * FROM usuario where id_user=\"$arreglo[11]\"");
						                $query2=mysqli_query($con,$sql2);
						                $nombre=mysqli_fetch_array($query2);
						                echo "<td>$nombre[2] $nombre[3]</td>";
						              }
						              $sumabs=$sumabs+floatval($arreglo[8]);
						              $sumasus=$sumasus+floatval($arreglo[9]);
						              echo "</tr>";
						            }

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