<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]!=0){
        print "<script>alert(\"No esta autorizado para ver esta página, consulte con el administrador\");window.location='../index.php';</script>";
    }
}
else{
  print "<script>alert(\"Acceso denegado, debe identificarse\");window.location='../index.php';</script>";
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
                      <h4 class="card-title">Listado de monitoreo de alarmas</h4>
                      <h6 class="card-subtitle">Estos contratos son de las alarmas de seguridad de la empresa</h6>
                      <div class="table-responsive m-t-40">
                        <table id="example23" class="display text-nowrap table table-hover table-striped table-bordered table-text" cellspacing="0" width="100%">
                                <thead>
						            <tr>
						                <th></th>
						                <th></th>
						                <th></th>
						                <th></th>
						                <th colspan="2">FECHA CONTRATO</th>
						                <th>VIGENCIA</th>
						                <th colspan="2">COBRO</th>
						                <th>ESTADO DEL CTTO</th>
						                <th>DOCUMENTO</th>
						                <?php if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
						                    echo "<th></th>";
						                    echo "<th></th>";
						                } ?>
						            </tr>
						            <tr>
						                <th>NRO</th>
						                <th>REGIONAL</th>
						                <th>CENTRO FOCAL</th>
						                <th>PROVEEDOR</th>
						                <th>FECHA DE INICIO</th>
						                <th>FECHA FINAL</th>
						                <th>AÑOS</th>
						                <th>BS</th>
						                <th>$us</th>
						                <th>CONFIRMAR DATO</th>
						                <th>ESCANEADO</th>
						                <?php if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
						                    echo "<th>AÑADIDO POR:</th>";
						                    echo "<th></th>";
						                } ?>
						            </tr>
						        </thead>
						        <tfoot>
						            <tr>
						                <th>NRO</th>
						                <th>REGIONAL</th>
						                <th>CENTRO FOCAL</th>
						                <th>PROVEEDOR</th>
						                <th>FECHA DE INICIO</th>
						                <th>FECHA FINAL</th>
						                <th>AÑOS</th>
						                <th>BS</th>
						                <th>$us</th>
						                <th>CONFIRMAR DATO</th>
						                <th>ESCANEADO</th>
						                <?php if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
						                    echo "<th>AÑADIDO POR:</th>";
						                    echo "<th></th>";
						                } ?>
						            </tr>
						            <tr>
						                <th></th>
						                <th></th>
						                <th></th>
						                <th></th>
						                <th colspan="2">FECHA CONTRATO</th>
						                <th>VIGENCIA</th>
						                <th colspan="2">COBRO</th>
						                <th>ESTADO DEL CTTO</th>
						                <th>DOCUMENTO</th>
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
						            if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
						                $sql=("SELECT * FROM monitoreo");
						            }
						            else{
						                $sql=("SELECT * FROM monitoreo where region=\"$_SESSION[regional]\"");
						            }
						            $query=mysqli_query($con,$sql);
						            while($arreglo=mysqli_fetch_array($query)){
						                $count++;
						                $confi=date("Y-m-d");
						              $nuevo=strtotime("+2 month",strtotime($confi));
						              $nuevo=date("Y-m-d",$nuevo);
						              $nuevo2=strtotime("+1 month",strtotime($confi));
						              $nuevo2=date("Y-m-d",$nuevo2);
						              if ($arreglo[5]>date("Y-m-d")) {
						                  $campo="vigente";
						              }
						              if ($arreglo[5]<$nuevo && $arreglo[5]>date("Y-m-d")) {
						                  $campo="notificado";
						                  if ($arreglo[10]!=""&&$arreglo[12]!=1) {
						                    if ($arreglo[5]<$nuevo2 && $arreglo[5]>date("Y-m-d")) {
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
						                                    $mail->Body    = "Frutalero S.R.L. informa que el contrato de $arreglo[3] por el concepto de monitoreo de alarmas le queda aproximadamente un mes para su conclusion, Que tenga una excelente jornada";
						                                    $mail->send();
						                                    $sql1= "UPDATE monitoreo set noti2=1 where id_moni=$arreglo[0]";
						                                    $query1 = $con->query($sql1);
						                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[3]\");window.location='../views/view-monitoreo.php';</script>";
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
						                                    $mail->Body    = "Frutalero S.R.L. informa que el contrato de $arreglo[3] por el concepto de monitoreo de alarmas le queda aproximadamente dos meses para su conclusion, Que tenga una excelente jornada";
						                                    $mail->send();
						                                    $sql1= "UPDATE monitoreo set noti1=1 where id_moni=$arreglo[0]";
						                                    $query1 = $con->query($sql1);
						                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[3]\");window.location='../views/view-monitoreo.php';</script>";
						                                } catch (Exception $e) {
						                                    echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>";
						                                    echo $mail->ErrorInfo;
						                                }
						                  }
						                    }
						              }
						              $nuevo3=strtotime("+1 week",strtotime($confi));
						              $nuevo3=date("Y-m-d",$nuevo3);
						              if ($arreglo[5]<date("Y-m-d")) {
						                  $campo="vencido";
						                  if ($arreglo[11]!=""&&$arreglo[14]!=1) {
						                        if ($arreglo[5]<$nuevo3 && $arreglo[5]<date("Y-m-d")) {
						                            if ($arreglo[15]!=1) {
						                                $mail = new PHPMailer(true);
						                                try {
						                                    include "mail_config.php";
						                                    //Recipients
						                                    $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
						                                    $varios = explode(";",$arreglo[11]);
						                                    for ($i=0; $i <count($varios) ; $i++) {
						                                        $mail->addAddress($varios[$i], 'Remitente de Frutalero S.R.L.');
						                                    };
						                                    $mail->isHTML(true);
						                                    $mail->Subject = "Notificacion de conclusion de contrato";
						                                    $mail->Body    = "Frutalero S.R.L. informa que el contrato de $arreglo[3] por el concepto de monitoreo de alarmas tiene una semana de vencido, Que tenga una excelente jornada";
						                                    $mail->send();
						                                    $sql1= "update monitoreo set noti4=1 where id_moni=$arreglo[0]";
						                                    $query1 = $con->query($sql1);
						                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[3]\");window.location='../views/view-monitoreo.php';</script>";
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
						                                    $mail->Body    = "Frutalero S.R.L. informa que el contrato de $arreglo[3] por el concepto de monitoreo de alarmas acaba de vencer, Que tenga una excelente jornada";
						                                    $mail->send();
						                                    $sql1= "update monitoreo set noti3=1 where id_moni=$arreglo[0]";
						                                    $query1 = $con->query($sql1);
						                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[3]\");window.location='../views/view-monitoreo.php';</script>";
						                                } catch (Exception $e) {
						                                    echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>";
						                                    echo $mail->ErrorInfo;
						                                }
						                        }
						                  }
						              }
						              if ($arreglo[5]=="0000-00-00"||$arreglo[5]==null) {
						                  $campo=null;
						              }
						              echo "<tr id='$campo'>";
						              echo "<td>$count</td>";
						              echo "<td>$arreglo[1]</td>";
						              echo "<td>$arreglo[2]</td>";
						              echo "<td>$arreglo[3]</td>";
						              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[4]));
						              echo "<td>$fecha</td>";
						              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[5]));
						              echo "<td>$fecha2</td>";
						              $duracion=intval($arreglo[5])-intval($arreglo[4]);
						              echo "<td>$duracion</td>";
						              if ($arreglo[7]=="bs") {
						                $monto=number_format((floatval($arreglo[6])),2,".",",");
						                echo "<td class='valores'>$monto</td>";
						                echo "<td></td>";
						              }
						              else{
						                $monto=number_format((floatval($arreglo[6])),2,".",",");
						                echo "<td></td>";
						                echo "<td class='valores'>$monto</td>";
						              }
						              if($arreglo[5]>date("Y-m-d")){
						                echo "<td>Contrato Vigente</td>";
						              }
						              else{
						                echo "<td>Vencido</td>";
						              }
						              if ($arreglo[8]!=null) {
						                echo "<td><a href='../files/monitoreo/respaldo/$arreglo[8]' target='_blank'>Ver documento de respaldo</td>";
						              }
						              else{
						                echo "<td>No se subió documento de respaldo</td>";
						              }

						              if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==2) {
						                echo "<td class='text-center'><a class='btn btn-link' href='../views/update-monitoreo.php?id=$arreglo[0]'><span class='fa fa-pencil'></span></a><a class='btn btn-link' href='../controller/delete_monitoreo.php?id=$arreglo[0]'><span class='fa fa-trash'></span></a></td>";
						                $sql2=("SELECT * FROM usuario where id_user=\"$arreglo[9]\"");
						                $query2=mysqli_query($con,$sql2);
						                $nombre=mysqli_fetch_array($query2);
						                echo "<td>$nombre[2] $nombre[3]</td>";
						              }
						              $sumabs=$sumabs+floatval($arreglo[6]);
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