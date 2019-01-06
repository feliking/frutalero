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

<?php require_once('layout-body.php'); ?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">
          Actualizar contrato
        </h3>
    </div>
</div>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Datos del contrato</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-elements">
                                    <form name="crea_otros" method="post" action="../controller/update_otros.php" enctype="multipart/form-data">
                                        <?php 
                                          extract($_GET);
                                          require("../controller/conexion.php");
                                          $sql="SELECT * FROM otros_contratos WHERE id_ot=$id";
                                          $ressql=mysqli_query($con,$sql);
                                          while ($row=mysqli_fetch_row($ressql)) {
                                            $empresa=$row[1];
                                            $detalle=$row[2];
                                            $fecha_ini=$row[3];
                                            $fecha_fin=$row[4];
                                            $observacion=$row[5];
                                            $estado=$row[6];
                                            $montobs=$row[7];
                                            $montosus=$row[8];
                                            $correo=$row[10];
                                            $correo2=$row[11];
                                          }
                                          mysqli_close($con);
                                         ?>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Nombre de la empresa</label>
                                                    <input type="text" class="form-control" name="empresa" id="empresa" placeholder="Nombre de la empresa" value="<?php echo $empresa; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Detalle</label>
                                                    <input type="text" class="form-control" name="detalle" id="detalle" placeholder="Detalle" value="<?php echo $detalle; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de inicio de contrato</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="fecha_ini" id="fecha_ini" placeholder="Fecha de inicio del contrato" value="<?php echo $fecha_ini; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de fin de contrato</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="fecha_fin" id="fecha_fin" placeholder="Fecha de fin de contrato" value="<?php echo $fecha_fin; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Observación</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="observacion" id="observacion" placeholder="Observacion" value="<?php echo $observacion; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Estado</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado del contrato" value="<?php echo $estado; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                
                                                <div class="form-group">
                                                    <label>Monto en Bs</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="monto" id="monto" placeholder="Introduzca monto en Bs" step="0.01" value="<?php echo $montobs ?>" onfocus="monto2.value=0" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Monto en $us</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="monto2" id="monto2" placeholder="Introduzca monto en $us" step="0.01" value="<?php echo $montosus; ?>" onfocus="monto.value=0" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Correo electronico del encargado</label>
                                                    <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo electronico del encargado" value="<?php echo $correo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Correo electronico del gerente</label>
                                                    <input type="text" class="form-control" name="correo2" id="correo2" placeholder="Correo electronico del gerente" value="<?php echo $correo2; ?>">
                                                </div>
                                                <div class="form-group">
                                                  <span class="text-danger" id="error"></span>
                                                </div>
                                                <div class="form-group">
                                                  <input type="submit" class="btn-rounded btn-info" value="Actualizar contrato">
                                                </div>
                                                <input type="hidden" name="ide" id="ide" value="<?php echo $id; ?>">
                                                <input type="hidden" name="fecha" id="fecha" value="<?php echo $fecha_fin; ?>">
                                            </div>
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