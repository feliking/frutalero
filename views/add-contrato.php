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
          Registrar nuevo contrato
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
                                    <form name="crea_otros" method="post" action="../controller/add_otros.php" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Nombre de la empresa</label>
                                                    <input type="text" class="form-control" name="empresa" id="empresa" placeholder="Nombre de la empresa">
                                                </div>
                                                <div class="form-group">
                                                    <label>Detalle</label>
                                                    <input type="text" class="form-control" name="detalle" id="detalle" placeholder="Detalle">
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
                                                    <label>Observación</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="observacion" id="observacion" placeholder="Observacion">
                                                </div>
                                                <div class="form-group">
                                                    <label>Estado</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado del contrato">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                
                                                <div class="form-group">
                                                    <label>Monto en Bs</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="monto" id="monto" placeholder="Introduzca monto en Bs" step="0.01">
                                                </div>
                                                <div class="form-group">
                                                    <label>Monto en $us</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="monto2" id="monto2" placeholder="Introduzca monto en $us" step="0.01">
                                                </div>
                                                
                                                <div class="form-group">
                                                  <span class="text-danger" id="error"></span>
                                                </div>
                                                <div class="form-group">
                                                  <input type="submit" class="btn-rounded btn-info" value="Registrar contrato">
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