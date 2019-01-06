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
          Registrar nuevo contrato de monitoreo de alarmas
        </h3>
    </div>
</div>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Datos del nuevo contrato</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-elements">
                                    <form name="crea_monitoreo" method="post" action="../controller/add_monitoreo.php" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Regional</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="region" id="region">
											            <option value="No definido" selected>Regional*</option>
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
                                                    <input type="text" class="form-control" name="centro_focal" id="centro_focal">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nombre del propietario</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="nombre" id="nombre">
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de inicio de contrato</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="fecha_ini" id="fecha_ini">
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de fin de contrato</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                                                </div>
                                                <div class="form-group">
                                                    <label>Moneda</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="moneda" id="moneda">
                                                        <option value="No definido" selected>Seleccione el tipo de modeda</option>
                                                        <option value="bs">Bolivianos</option>
                                                        <option value="sus">Dolares</option>
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Canon mensual</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="canon_mensual" id="canon_mensual" placeholder="Introduzca monto" step="0.01">
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
                                                  <span class="text-danger" id="error"></span>
                                                </div>
                                                <div class="form-group">
                                                  <input type="submit" class="btn-rounded btn-info" value="Registrar contrato de monitoreo de alarmas">
                                                </div>
                                                <input type="hidden" name="ide" id="ide" value="<?php echo $_SESSION['user_id']; ?>">
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