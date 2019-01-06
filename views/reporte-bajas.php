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
<head>
	<title>: Reporte de bajas médicas</title>
</head>
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
    <script type="text/javascript">
    	$(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
      language: {
      "decimal": ".",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ Entradas",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
      }
  },
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'pdf',
            text: 'Generar reporte en Pdf'
        },
        {
            extend: 'print',
            text: 'Imprimir reporte'
        }
        ]
    });

    </script>
<?php require_once('layout-close.php'); ?>