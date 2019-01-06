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
          Actualizar contrato de alquiler
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
                                    <form name="crea_alquiler" method="post" action="../controller/update_alquiler.php" enctype="multipart/form-data">
                                        <?php
								            extract($_GET);
								            require("../controller/conexion.php");
								            $sql="SELECT * FROM alquiler WHERE id_alqui=$id";
								            $ressql=mysqli_query($con,$sql);
								            while ($row=mysqli_fetch_row ($ressql)){
								              $region=$row[1];
								              $centro_focal=$row[2];
								              $tipo_centro_focal=$row[3];
								              $nombre_contratante=$row[4];
								              $fecha_ini=$row[5];
								              $fecha_fin=$row[6];
								              $canon_mensualbs=$row[7];
								              $canon_mensualsus=$row[8];
								              $folio_real=$row[9];
								              $respaldo=$row[10];
								              $garantiabs=$row[11];
								              $garantiasus=$row[12];
								              $devuelto=$row[13];
								              $correo=$row[15];
								        }
								    ?>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Introduzca los datos del contrato</label><span class="text-danger">*</span>
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
                                                    <input type="text" class="form-control" name="centro_focal" id="centro_focal" placeholder="Centro Focal*" value="<?php echo $centro_focal; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tipo de centro focal</label>
                                                    <input type="text" class="form-control" name="tipo_centro_focal" id="tipo_centro_focal" placeholder="Tipo del centro focal*" value="<?php echo $tipo_centro_focal; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nombre del propietario</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del propietario*" value="<?php echo $nombre_contratante; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de inicio de contrato</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="fecha_ini" id="fecha_ini" placeholder="Fecha de inicio del contrato*" value="<?php echo $fecha_ini; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de fin de contrato</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" placeholder="Fecha de fin de contrato*" value="<?php echo $fecha_fin; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Canon mensual en Bs</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="canon_mensualbs" id="canon_mensualbs" placeholder="Introduzca monto en Bs" step="0.01" value="<?php echo $canon_mensualbs; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                
                                                <div class="form-group">
                                                    <label>Canon mensual en $us</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="canon_mensualsus" id="canon_mensualsus" placeholder="Introduzca monto en $us" step="0.01" value="<?php echo $canon_mensualsus; ?>">
                                                </div>
                                                <div class="form-group">
                                                	<label>Folio Real</label>
                                                	<div class="custom-file">
													  <input type="file" class="custom-file-input" name="folio_real" accept="image/*,application/pdf">
													  <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
													</div>
                                                </div>
                                                <div class="form-group">
                                                	<label>Respaldo</label>
                                                	<div class="custom-file">
													  <input type="file" class="custom-file-input" name="respaldo" id="respaldo" accept="image/*,application/pdf">
													  <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
													</div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Garantía Bs</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="garantiabs" id="garantiabs" placeholder="Garantía en Bs" value="<?php echo $garantiabs; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Garantía $us</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="garantiasus" id="garantiasus" placeholder="Garantía en $us" value="<?php echo $garantiasus; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Devolucion de la garantía</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="devuelto" id="devuelto" required>
											            <option value="<?php echo $devuelto; ?>" selected><?php echo $devuelto; ?></option>
											            <option value="DEVUELTO">Devuelto</option>
											            <option value="NO DEVUELTO"> No devuelto</option>
											        </select>
                                                </div>
                                                <div class="form-group">
                                                	<label for=""></label>
                                                	<input type="text" class="form-control" name="correo" id="correo" placeholder="Correo para notificaciones" value="<?php echo $correo; ?>">
                                                </div>
                                                <div class="form-group">
                                                  <span class="text-danger" id="error"></span>
                                                </div>
                                                <div class="form-group">
                                                  <input type="submit" class="btn-rounded btn-info" value="Actualizar contrato de alquiler">
                                                </div>
                                                <input type="hidden" name="ide" id="ide" value="<?php echo $id ?>">
										          <input type="hidden" name="docu1" id="docu1" value="<?php echo $folio_real; ?>">
										          <input type="hidden" name="docu2" id="docu2" value="<?php echo $respaldo; ?>">
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