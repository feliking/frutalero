<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]!=0 && $_SESSION["tipo"]!=1){
        print "<script>alert(\"No tiene permisos para acceder a esta página\");window.location='../index.php';</script>";
    }
}
else{
  print "<script>alert(\"No puede tener acceso si no esta identificado.\");window.location='../index.php';</script>";
}
require_once('layout-head.php');
?>

<?php require_once('layout-body.php'); ?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">
          Cálculo de liquidación en Bs.
        </h3>
    </div>
</div>
<div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card">
                          <div class="alert alert-danger" role="alert">
                            <b>Advertencia:</b> Sí elimina un miembro del personal se borrarán todos sus datos del sistema incluyendo carnet sanitario, horario, datos, etc.., tome sus previsiones por favor
                          </div>
                            <div class="card-title">
                                <h4>Cálculo de liquidación</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-elements">
                                    <form name="crea_personal" method="post" action="../controller/update_personal.php" enctype="multipart/form-data">
                                        <?php 
                                            extract($_GET);
                                            $inicio = null;
                                            $fin = null;
                                            $fecha = null;
                                            $liqui = null;
                                            $dias = null;
                                            $conv = null;
                                            require("../controller/conexion.php");
                                            $sql="SELECT * FROM personal WHERE id=$id";
                                            $ressql=mysqli_query($con,$sql);
                                            while ($row=mysqli_fetch_row ($ressql)){
                                              $carnet=$row[1];
                                              $nacionalidad=$row[2];
                                              $nombres=$row[3];
                                              $apellidos=$row[4];
                                              $sexo=$row[5];
                                              $fecha_nac=$row[6];
                                              $curriculum=$row[7];
                                              $fecha_ingreso=$row[8];
                                              $area_trabajo=$row[9];
                                              $cargo=$row[10];
                                              $sueldo_mensual=$row[11];
                                            }
                                            $dias = (strtotime($fecha_ingreso)-strtotime(date("Y-m-d")))/86400;
                                            $dias   = abs($dias); $dias = floor($dias);   
                                            $anos = intval($dias/365);
                                            $liqui = $anos * $sueldo_mensual;
                                            //$anos=intval(date('Y-m-d'))-intval($fecha_ingreso);
                                            //$conv = strftime("%Y",strtotime($anos));
                                            //$liqui = $anos * $sueldo_mensual;
                                            $fecha=strftime("%d/%m/%Y",strtotime($fecha_ingreso));

                                         ?>
                                         <div class="col-lg-12">
                                           <div class="form-group">
                                               <label>Trabajador</label>
                                               <input type="text" class="form-control" value="<?php echo $carnet.' - '.$nombres.' '.$apellidos; ?>" readonly>
                                             </div>
                                            <div class="form-group">
                                              <label for="">Fecha de ingreso</label>
                                              <input type="text" class="form-control" value="<?php echo $fecha; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                              <label for="">Liquidación calculada por el sistema</label>
                                              <input type="text" class="form-control" value="<?php echo $liqui.' Bs.'; ?>" readonly>
                                            </div>
                                            <a class="btn btn-danger" href="../controller/delete_personal.php?id=<?php echo $id ?>">Eliminar definitivamente</a>
                                         </div>
                                         
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->

                    <!-- /# column -->
                </div>
</div>

<?php require_once('layout-footer.php'); ?>

<?php require_once('layout-close.php'); ?>