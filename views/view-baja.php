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

<div class="container-fluid">
      <!-- Start Page Content -->
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Listado de bajas médicas</h4>
                      <h6 class="card-subtitle">Esta lista justifica las inasistencias por bajas médicas</h6>
                      <div class="table-responsive m-t-40">
                        <table id="example23" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
						            <tr>
						                <th>NRO</th>
						                <th>Carnet de identidad</th>
						                <th>Nombre del trabajador</th>
						                <th>Carnet de asegurado</th>
						                <th>Riesgo</th>
						                <th>Desde: </th>
						                <th>Hasta: </th>
						                <th></th>
						            </tr>
						        </thead>
						        <tfoot>
						            <tr>
						                <th>NRO</th>
						                <th>Carnet de identidad</th>
						                <th>Nombre del trabajador</th>
						                <th>Carnet de asegurado</th>
						                <th>Riesgo</th>
						                <th>Desde: </th>
						                <th>Hasta: </th>
						                <th></th>
						            </tr>
						        </tfoot>
						        <tbody>
						        <?php
						            $count=0;
						            require("../controller/conexion.php");
						            $sql="SELECT carnet, nombres, apellidos, carnet_asegurado, riesgo, fecha_ini, fecha_fin,  i.id FROM bajas_medicas i,personal p WHERE i.id_personal=p.id";
						            $query=mysqli_query($con,$sql);
						            while($arreglo=mysqli_fetch_array($query)){
						              $count++;
						              echo "<tr>";
						              echo "<td>$count</td>";
						              echo "<td>$arreglo[0]</td>";
						              echo "<td>$arreglo[1] $arreglo[2]</td>";
						              echo "<td>$arreglo[3]</td>";
						              echo "<td>$arreglo[4]</td>";
						              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[5]));
						              echo "<td>$fecha</td>";
						              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[6]));
						              echo "<td>$fecha</td>";
						              if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==1) {
						                echo "<td class='text-center'><a class='btn btn-link' href='../views/update-baja.php?id=$arreglo[7]'><span class='fa fa-pencil'></span></a><a class='btn btn-link' href='../controller/delete_baja.php?id=$arreglo[7]'><span class='fa fa-trash'></span></a></td>";
						              }
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