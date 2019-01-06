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
                      <h4 class="card-title">Listado de horarios</h4>
                      <h6 class="card-subtitle">En esta lista podrá ver todos horarios registrados</h6>
						<div class="alert alert-danger" role="alert">
						  <b>Advertencia: </b>Al eliminar uno de los siguientes horarios, se eliminará automaticamente para todos los trabajadores asignados con ese horario.
						</div>
                      <div class="table-responsive m-t-40">
                        <table id="example23" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
						            <tr>
						                <th>NRO</th>
						                <th>Nombre Clave</th>
						                <th>Descripción</th>
						                <th></th>
						            </tr>
						        </thead>
						        <tfoot>
						            <tr>
						                <th>NRO</th>
						                <th>Nombre Clave</th>
						                <th>Descripción</th>
						                <th></th>
						            </tr>
						        </tfoot>
						        <tbody>
						        <?php
						       		$dias = null;
						            $count=0;
						            require("../controller/conexion.php");
						            $sql="SELECT * FROM horarios";
						            $query=mysqli_query($con,$sql);
						            while($arreglo=mysqli_fetch_array($query)){
						              $count++;
						              echo "<tr>";
						              echo "<td>$count</td>";
						              echo "<td>$arreglo[1]</td>";
						              echo "<td>$arreglo[2]</td>";
						              
						              if ($_SESSION["tipo"]==0 || $_SESSION["tipo"]==1) {
						                echo "<td class='text-center'><a class='btn btn-link' href='#hor$count'><span class='fa fa-list'></span></a><a class='btn btn-link' href='../controller/delete_horario.php?id=$arreglo[0]'><span class='fa fa-trash'></span></a></td>";
						              }
						              echo "<div id='hor$count' class='modalbg'>
									          <div class='dialog' style='width:730px'>
									            <a href='#close' title='Close' class='close'>X</a>
									            	<div class='row justify-content-center'>
									            			<ul class='list-group'>
									            				<li class='list-group-item'><b>Hora/Días</b></li>
									            				<li class='list-group-item'>Hora entrada</li>
									            				<li class='list-group-item'>Hora salida*</li>
									            				<li class='list-group-item'>Hora entrada*</li>
									            				<li class='list-group-item'>Hora salida</li>
									            			</ul>";
									  if($arreglo[3] != ''){
									  	$dias = explode(',', $arreglo[3]);
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>LU</b></li>
									  			<li class='list-group-item'>$dias[0]</li>
									  			<li class='list-group-item'>$dias[1]</li>
									  			<li class='list-group-item'>$dias[2]</li>
									  			<li class='list-group-item'>$dias[3]</li>
									  		   </ul>";
									  }
									  else{
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>LU</b></li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  		  </ul>";
									  }
									  if($arreglo[4] != ''){
									  	$dias = explode(',', $arreglo[4]);
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>MAR</b></li>
									  			<li class='list-group-item'>$dias[0]</li>
									  			<li class='list-group-item'>$dias[1]</li>
									  			<li class='list-group-item'>$dias[2]</li>
									  			<li class='list-group-item'>$dias[3]</li>
									  		   </ul>";
									  }
									  else{
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>MAR</b></li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  		  </ul>";
									  }
									  if($arreglo[5] != ''){
									  	$dias = explode(',', $arreglo[5]);
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>MIER</b></li>
									  			<li class='list-group-item'>$dias[0]</li>
									  			<li class='list-group-item'>$dias[1]</li>
									  			<li class='list-group-item'>$dias[2]</li>
									  			<li class='list-group-item'>$dias[3]</li>
									  		   </ul>";
									  }
									  else{
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>MIER</b></li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  		  </ul>";
									  }
									  if($arreglo[6] != ''){
									  	$dias = explode(',', $arreglo[6]);
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>JUE</b></li>
									  			<li class='list-group-item'>$dias[0]</li>
									  			<li class='list-group-item'>$dias[1]</li>
									  			<li class='list-group-item'>$dias[2]</li>
									  			<li class='list-group-item'>$dias[3]</li>
									  		   </ul>";
									  }
									  else{
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>JUE</b></li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  		  </ul>";
									  }
									  if($arreglo[7] != ''){
									  	$dias = explode(',', $arreglo[7]);
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>VIE</b></li>
									  			<li class='list-group-item'>$dias[0]</li>
									  			<li class='list-group-item'>$dias[1]</li>
									  			<li class='list-group-item'>$dias[2]</li>
									  			<li class='list-group-item'>$dias[3]</li>
									  		   </ul>";
									  }
									  else{
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>VIE</b></li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  		  </ul>";
									  }
									  if($arreglo[8] != ''){
									  	$dias = explode(',', $arreglo[8]);
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>SAB</b></li>
									  			<li class='list-group-item'>$dias[0]</li>
									  			<li class='list-group-item'>$dias[1]</li>
									  			<li class='list-group-item'>$dias[2]</li>
									  			<li class='list-group-item'>$dias[3]</li>
									  		   </ul>";
									  }
									  else{
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>SAB</b></li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  		  </ul>";
									  }
									  if($arreglo[9] != ''){
									  	$dias = explode(',', $arreglo[9]);
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>DOM</b></li>
									  			<li class='list-group-item'>$dias[0]</li>
									  			<li class='list-group-item'>$dias[1]</li>
									  			<li class='list-group-item'>$dias[2]</li>
									  			<li class='list-group-item'>$dias[3]</li>
									  		   </ul>";
									  }
									  else{
									  	echo "<ul class='list-group'>
									  			<li class='list-group-item'><b>DOM</b></li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  			<li class='list-group-item'>--:--</li>
									  		  </ul>";
									  }
									          echo "</div>
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