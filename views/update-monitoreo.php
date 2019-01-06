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
          Actualizar nuevo contrato de monitoreo de alarmas
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
                                    <form name="crea_monitoreo" method="post" action="../controller/update_monitoreo.php" enctype="multipart/form-data">
                                        <?php 
                                          extract($_GET);
                                          require("../controller/conexion.php");
                                          $sql="SELECT * FROM monitoreo WHERE id_moni=$id";
                                          $ressql=mysqli_query($con,$sql);
                                          while ($row=mysqli_fetch_row($ressql)) {
                                            $region=$row[1];
                                            $centro_focal=$row[2];
                                            $proveedor=$row[3];
                                            $fecha_ini=$row[4];
                                            $fecha_fin=$row[5];
                                            $cobro=$row[6];
                                            $moneda=$row[7];
                                            $respaldo=$row[8];
                                            $correo=$row[10];
                                            $correo2=$row[11];
                                          }
                                          mysqli_close($con);
                                         ?>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Regional</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="region" id="region">
											            <option value="<?php echo $region; ?>" selected><?php echo $region; ?></option>
											            <option value="OF. NACIONAL">OF. Nacional</option>
											            <option value="EL ALTO">El Alto</option>
											            <option value="LA PAZ">La Paz</option>
											            <option value="COCHABAMBA">Cochabamba</option>
											            <option value="SANTA CRUZ">Santa Cruz</option>
											            <option value="ORURO">Oruro</option>
											            <option value="BENI">Beni</option>
											            <option value="PANDO">Pando</option>
											            <option value="SUCRE">Sucre</option>
											            <option value="TARIJA">Tarija</option>
											            <option value="POTOSI">Potosi</option>
											          </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Centro focal</label>
                                                    <input type="text" class="form-control" name="centro_focal" id="centro_focal" placeholder="Centro Focal" value="<?php echo $centro_focal; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nombre del propietario</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Proveedor" value="<?php echo $proveedor; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de inicio de contrato</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="fecha_ini" id="fecha_ini" placeholder="Fecha de inicio del contrato" value="<?php echo $fecha_ini; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de fin de contrato</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" placeholder="Fecha de fin de contrato" value="<?php echo $fecha_fin; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Moneda</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="moneda" id="moneda">
                                                        <option value="<?php echo $moneda; ?>" selected>Moneda seleccionada: <?php echo $moneda; ?></option>
                                                        <option value="bs">Bolivianos</option>
                                                        <option value="sus">Dolares</option>
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Canon mensual</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="canon_mensual" id="canon_mensual" placeholder="Introduzca monto" step="0.01" value="<?php echo $cobro; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                
                                                <div class="form-group">
                                                	<label>Respaldo</label>
                                                	<div class="custom-file">
													  <input type="file" class="custom-file-input" name="respaldo" id="respaldo" accept="image/*,application/pdf">
													  <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
													</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Correo electronico del encargado</label>
                                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electronico del encargado" value="<?php echo $correo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Correo electronico del gerente</label>
                                                    <input type="email" class="form-control" name="correo2" id="correo2" placeholder="Correo electronico del gerente" value="<?php echo $correo2; ?>">
                                                </div>
                                                <div class="form-group">
                                                  <span class="text-danger" id="error"></span>
                                                </div>
                                                <div class="form-group">
                                                  <input type="submit" class="btn-rounded btn-info" value="Actualizar contrato de monitoreo de alarmas">
                                                </div>
                                                <input type="hidden" name="ide" id="ide" value="<?php echo $id; ?>">
                                                  <input type="hidden" name="docu1" id="docu1" value="<?php echo $respaldo; ?>">
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