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
<head>
	<title>: Reporte de acciones en el sistema</title>
</head>
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