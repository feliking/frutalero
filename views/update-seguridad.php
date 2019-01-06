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
          Actualizar contrato de seguridad
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
                                    <form name="crea_seguridad" method="post" action="../controller/update_seguridad.php" enctype="multipart/form-data">
                                        <?php 
                                          extract($_GET);
                                          require("../controller/conexion.php");
                                          $sql="SELECT * FROM seguridad WHERE id_segu=$id";
                                          $ressql=mysqli_query($con,$sql);
                                          while ($row=mysqli_fetch_row($ressql)) {
                                            $region=$row[1];
                                            $centro_focal=$row[2];
                                            $tipo_centro_focal=$row[3];
                                            $nombre_empresa=$row[4];
                                            $fecha_ini=$row[5];
                                            $fecha_fin=$row[6];
                                            $nro_guardias=$row[7];
                                            $canon_mensualbs=$row[8];
                                            $canon_mensualsus=$row[9];
                                            $respaldo=$row[10];
                                            $correo=$row[12];
                                            $correo2=$row[13];
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
                                                    <input type="text" class="form-control" name="centro_focal" id="centro_focal" placeholder="Centro Focal" value="<?php echo $centro_focal; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tipo de centro focal</label>
                                                    <input type="text" class="form-control" name="tipo_centro_focal" id="tipo_centro_focal" placeholder="Tipo del centro focal" value="<?php echo $tipo_centro_focal; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nombre de la empresa</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la empresa" value="<?php echo $nombre_empresa; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de inicio de contrato</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="fecha_ini" id="fecha_ini" placeholder="Fecha de inicio del contrato" value="<?php echo $fecha_ini; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de fin de contrato</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" placeholder="Fecha de fin de contrato" value="<?php echo $fecha_fin; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Número de guardias</label>
                                                    <input type="number" class="form-control" name="guardias" id="guardias" placeholder="Numero de guardias" value="<?php echo $nro_guardias; ?>">
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Canon mensual en Bs</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="canon_mensualbs" id="canon_mensualbs" placeholder="Introduzca monto en Bs" step="0.01" value="<?php echo $canon_mensualbs; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Canon mensual en $us</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="canon_mensualsus" id="canon_mensualsus" placeholder="Introduzca monto en $us" step="0.01" value="<?php echo $canon_mensualsus; ?>">
                                                </div>
                                                <div class="form-group">
                                                	<label>Respaldo</label>
                                                	<div class="custom-file">
													  <input type="file" class="custom-file-input" name="respaldo" id="respaldo" accept="image/*,application/pdf">
													  <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
													</div>
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
                                                  <input type="submit" class="btn-rounded btn-info" value="Actualizar contrato de seguridad">
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