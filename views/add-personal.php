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
          Registrar nuevo miembro del personal
        </h3>
    </div>
</div>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Datos del nuevo miembro del personal</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-elements">
                                    <form name="crea_personal" method="post" action="../controller/add_personal.php" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Carnet de identidad</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="carnet" id="carnet" required>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label>Centro focal</label>
                                                    <select class="form-control" name="nacionalidad" id="nacionalidad" required>
											            <option value="" selected disabled>Nacionalidad</option>
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
                                                    <label>Nombres</label>
                                                    <input type="text" class="form-control" name="nombres" id="nombres" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Apellidos</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="apellidos" id="apellidos" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sexo</label><span class="text-danger">*</span>
                                                    <select name="sexo" id="sexo" class="form-control" required>
                                                    	<option value="" selected disabled>Sexo</options>
                                                    	<option value="M">Masculino</option>
                                                    	<option value="F">Femenino</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de nacimiento</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="fecha_nac" id="fecha_nac" required>
                                                </div>
                                                <div class="form-group">
                                                	<label>Hoja de vida</label>
                                                	<div class="custom-file">
													  <input type="file" class="custom-file-input" name="respaldo" accept="image/*,application/pdf">
													  <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
													</div>
													<small class="form-control-feedback"> Se debe subir un archivo en pdf con toda la información correspondiente </small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                
                                                <div class="form-group">
                                                    <label>Fecha de ingreso</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Área de trabajo</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="area_trabajo" id="area_trabajo" required>
											            <option value="" disabled selected>Elija una opción</option>
											            <option value="Produccion">Producción</option>
											            <option value="Area de TI">Area de TI</option>
											            <option value="Recursos Humanos">Recursos Humanos</option>
											            <option value="Administración">Administración</option>
											            <option value="Auditoria">Auditoria</option>
											            <option value="Servicios Financieros">Servicios Financieros</option>
											            <option value="Educación">Educación</option>
											            <option value="Riesgos">Riesgos</option>
											            <option value="Legal">Legal</option>
											            <option value="Finanzas">Finanzas</option>
											            <option value="Contabilidad">Contabilidad</option>
											            <option value="Operaciones">Operaciones</option>
											            <option value="Proyectos">Proyectos</option>
											            <option value="Gerencia General">Gerencia General</option>
											         </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Cargo</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="cargo" id="cargo" required>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Sueldo mensual en Bs.</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="sueldo_mensual" id="sueldo_mensual" step="0.01" required>
                                                </div>
                                                
                                                <div class="form-group">
                                                  <span class="text-danger" id="error"></span>
                                                </div>
                                                <div class="form-group">
                                                  <input type="submit" class="btn-rounded btn-info" value="Registrar al nuevo miembro del personal">
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