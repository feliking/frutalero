<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]!=0){
        print "<script>alert(\"No esta autorizado para ver esta página, consulte con el administrador\");window.location='../index.php';</script>";
    }
}
else{
    print "<script>alert(\"Acceso denegado, Debe identificarse\");window.location='../index.php';</script>";
}
?>

<?php require_once('layout-head.php'); ?>

<?php require_once('layout-body.php') ?>
<div class="container-fluid">
      <!-- Start Page Content -->
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Listado de usuarios</h4>
                      <h6 class="card-subtitle">Usuarios con acceso al sistema</h6>
                      <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th>CARNET DE IDENTIDAD</th>
                                      <th>NOMBRES</th>
                                      <th>APELLIDOS</th>
                                      <th>GENERO</th>
                                      <th>CORREO ELECTRONICO</th>
                                      <th>FECHA DE NACIMIENTO</th>
                                      <th>NACIONALIDAD</th>
                                      <th>TIPO DE USUARIO</th>
                                      <th>REGIONAL A LA QUE TIENE ACCESO</th>
                                      <th>NOMBRE DE USUARIO</th>
                                      <th>OPERACIONES</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                      <th>CARNET DE IDENTIDAD</th>
                                      <th>NOMBRES</th>
                                      <th>APELLIDOS</th>
                                      <th>GENERO</th>
                                      <th>CORREO ELECTRONICO</th>
                                      <th>FECHA DE NACIMIENTO</th>
                                      <th>NACIONALIDAD</th>
                                      <th>TIPO DE USUARIO</th>
                                      <th>REGIONAL A LA QUE TIENE ACCESO</th>
                                      <th>NOMBRE DE USUARIO</th>
                                      <th>OPERACIONES</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                              <?php
                                  $count=0;
                                  require("../controller/conexion.php");
                                  $sql=("SELECT * FROM usuario");
                                  $query=mysqli_query($con,$sql);
                                  while($arreglo=mysqli_fetch_array($query)){
                                      $count++;
                                    echo "<tr>";
                                    echo "<td>$arreglo[1]</td>";
                                    echo "<td>$arreglo[2]</td>";
                                    echo "<td>$arreglo[3]</td>";
                                    if ($arreglo[4]=='M') {
                                      echo "<td>Masculino</td>";
                                    } else {
                                      echo "<td>Femenino</td>";
                                    }
                                    echo "<td>$arreglo[5]</td>";
                                    $fecha=strftime("%d/%m/%Y",strtotime($arreglo[6]));
                                    echo "<td>$fecha</td>";
                                    echo "<td>$arreglo[7]</td>";
                                    if ($arreglo[8]==0) {
                                      echo "<td>Administrador</td>";
                                    } else if($arreglo[8]==1){
                                      echo "<td>Gestión de RRHH</td>";
                                    } else if($arreglo[8]==2){
                                      echo "<td>Sistema de control de contratos</td>";
                                    } else if($arreglo[8]==3){
                                      echo "<td>Administración de requerimientos</td>";
                                    }
                                    echo "<td>$arreglo[9]</td>";
                                    echo "<td>$arreglo[10]</td>";
                                    echo "<td class='text-center'><a class='btn btn-link' href='../views/update-user.php?id=$arreglo[0]'><span class='fa fa-pencil'></span></a><a class='btn btn-link' href='../controller/delete_user.php?id=$arreglo[0]'><span class='fa fa-trash'></span></a></td>";
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



<?php require_once('layout-footer.php') ?>
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
<?php require_once('layout-close.php') ?>
