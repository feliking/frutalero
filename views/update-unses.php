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
          Registrar inasistencia
        </h3>
    </div>
</div>
<div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="card">
                            <div class="card-title">
                                <h4>Describa los detalles de la inasistencia</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-elements">
                                    <form method="post" action="../controller/update_unses.php" enctype="multipart/form-data">
                                        <?php 
                                            require ("../controller/conexion.php");
                                            extract($_GET);
                                            $sql = "SELECT * FROM inasistencias WHERE id=$id";
                                            $query = mysqli_query($con, $sql) or die(mysqli_error($con));
                                            $row=mysqli_fetch_row ($query);
                                         ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Seleccione al trabajador</label><span class="text-danger">*</span>
                                                    <select name="id_personal" id="" class="form-control" disabled>
                                                        <?php 
                                                          $sql1="SELECT * FROM personal WHERE id=$row[1]";
                                                          $query1=mysqli_query($con, $sql1);
                                                          while($arreglo=mysqli_fetch_array($query1)){
                                                            echo "<option value='$arreglo[0]'>$arreglo[1] - $arreglo[3] $arreglo[4]</option>";
                                                          }
                                                        ?>
                                                    </select>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de inasistencia</label>
                                                    <input type="date" class="form-control" name="fecha" value="<?php echo $row[2]; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Justificación</label>
                                                    <textarea class="form-control" name="justificacion" rows="4" style="height: 150px;" required><?php echo $row[3]; ?></textarea>
                                                </div>
                                                
                                                <div class="form-group">
                                                  <span class="text-danger" id="error"></span>
                                                </div>
                                                <div class="form-group">
                                                  <input type="submit" class="btn-rounded btn-info" value="Actualizar inasistencia inasistencia">
                                                </div>
                                                <input type="hidden" name="ide" id="ide" value="<?php echo $id; ?>">
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