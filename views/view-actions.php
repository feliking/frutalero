<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]!=0){
        print "<script>alert(\"No esta autorizado para ver esta página, consulte con el administrador\");window.location='../index.php';</script>";
    }
}
else{
  print "<script>alert(\"Acceso denegado, debe identificarse\");window.location='../index.php';</script>";
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
                      <h4 class="card-title">Listado de acciones</h4>
                      <h6 class="card-subtitle">Estas son las acciones realizadas por los usuarios registrados</h6>
                      <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered table-text" cellspacing="0" width="100%">
                                <thead>
						            <tr>
						                <th>Usuario</th>
						                <th>Detalles</th>
						                <th>Módulo</th>
						                <th>Fecha</th>
						                <th>Hora</th>
						            </tr>
						        </thead>
						        <tfoot>
						            <tr>
						                <th>Usuario</th>
						                <th>Detalles</th>
						                <th>Módulo</th>
						                <th>Fecha</th>
						                <th>Hora</th>
						            </tr>
						        </tfoot>
						        <tbody>
						            <?php
						            $count=0;
						            $campo=null;
						            $suma=0;
						            $nombre=null;

						            require("../controller/conexion.php");
						            $sql=("SELECT * FROM acciones ORDER BY id_action DESC");
						            $query=mysqli_query($con,$sql) or die(mysqli_error($con));
						            while($arreglo=mysqli_fetch_array($query)){
						              $count++;
						              $sql2=("SELECT * FROM usuario where id_user=\"$arreglo[1]\"");
						              $query2=mysqli_query($con,$sql2);
						              $nombre=mysqli_fetch_array($query2);

						              echo "<tr>";
						              echo "<td>$nombre[2] $nombre[3]</td>";
						              echo "<td>$arreglo[2]</td>";
						              echo "<td>$arreglo[3]</td>";
						              $varios = explode(" ",$arreglo[4]);
						              $fecha=strftime("%d/%m/%Y",strtotime($varios[0]));
						              echo "<td id='$campo'>$fecha</td>";
						              echo "<td id='$campo'>$varios[1]</td>";
						              echo "</tr>";
						            }
						            mysqli_close($con);
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