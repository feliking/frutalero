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
                      <h4 class="card-title">Listado del personal registrado</h4>
                      <h6 class="card-subtitle">Esta es la lista del personal de la empresa</h6>
                      <div class="alert alert-danger" role="alert">
						  <b>Advertencia:</b> Sí elimina un miembro del personal se borrarán todos sus datos del sistema incluyendo carnet sanitario, horario, datos, etc.., tome sus previsiones por favor
					  </div>
                      <div class="table-responsive m-t-40">
                        <table id="example23" class="display text-nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
						            <tr>
						                <th>NRO</th>
						                <th>Carnet de identidad</th>
						                <th>Nacionalidad</th>
						                <th>Nombres</th>
						                <th>Apellidos</th>
						                <th>Sexo</th>
						                <th>Fecha de nacimiento</th>
						                <th>Hoja de vida</th>
						                <th>Fecha de ingreso</th>
						                <th>Área de trabajo</th>
						                <th>Cargo</th>
						                <th>Sueldo mensual</th>
						                <th></th>
						                <th>Registrado por:</th>
						            </tr>
						        </thead>
						        <tfoot>
						            <tr>
						                <th>NRO</th>
						                <th>Carnet de identidad</th>
						                <th>Nacionalidad</th>
						                <th>Nombres</th>
						                <th>Apellidos</th>
						                <th>Sexo</th>
						                <th>Fecha de nacimiento</th>
						                <th>Hoja de vida</th>
						                <th>Fecha de ingreso</th>
						                <th>Área de trabajo</th>
						                <th>Cargo</th>
						                <th>Sueldo mensual</th>
						                <th></th>
						                <th>Registrado por:</th>
						            </tr>
						        </tfoot>
						        <tbody>
						        <?php
						            $count=0;
						            require("../controller/conexion.php");
						            $sql=("SELECT * FROM personal");
						            $query=mysqli_query($con,$sql);
						            while($arreglo=mysqli_fetch_array($query)){
						              $count++;
						              echo "<tr>";
						              echo "<td>$count</td>";
						              echo "<td>$arreglo[1]</td>";
						              echo "<td>$arreglo[2]</td>";
						              echo "<td>$arreglo[3]</td>";
						              echo "<td>$arreglo[4]</td>";
						              if ($arreglo[5] == 'M') {
						              	echo '<td>Masculino</td>';
						              }
						              else{
						              	echo '<td>Femenino</td>';
						              }
						              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[6]));
						              echo "<td>$fecha</td>";
						              if ($arreglo[7]!=null) {
						                echo "<td><a href='../files/rrhh/curriculum/$arreglo[7]' target='_blank'>Ver hoja de vida</td>";
						              }
						              else{
						                echo "<td>No se subió hoja de vida</td>";
						              }
						              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[8]));
						              echo "<td>$fecha</td>";
						              echo "<td>$arreglo[9]</td>";
						              echo "<td>$arreglo[10]</td>";
						              echo "<td>$arreglo[11] Bs.</td>";
						              
						              if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==1) {
						                echo "<td class='text-center'><a class='btn btn-link' href='../views/update-personal.php?id=$arreglo[0]'><span class='fa fa-pencil'></span></a><a class='btn btn-link' href='#op$count'><span class='fa fa-trash'></span></a></td>";
						                $sql2=("SELECT * FROM usuario where id_user=\"$arreglo[12]\"");
						                $query2=mysqli_query($con,$sql2);
						                $nombre=mysqli_fetch_array($query2);
						                echo "<td>$nombre[2] $nombre[3]</td>";
						              }
						              echo "<div id='op$count' class='modalbg'>
						                        <div class='dialog'>
						                          <a href='#close' title='Close' class='close'>X</a>
						                          <h2 class='text-center'>Elija como desea eliminar al trabajador</h2>
						                          <h2 class='text-center'><a class='btn btn-warning' href='find-retiro.php?id=$arreglo[0]'>Calcular liquidación</a></h2>
						                          <h2 class='text-center'><a class='btn btn-danger' href='../controller/delete_personal.php?id=$arreglo[0]'>Eliminar definitivamente</a></h2>
						               			</div>
						                    </div>";
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