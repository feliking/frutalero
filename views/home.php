<?php
    session_start();
    if(!isset($_SESSION["user_id"]) ){
        print "<script>alert(\"Acceso Restringido, Debe identificarse\");window.location='../views/login.php';</script>";
    }
    require_once('layout-head.php');
 ?>
 	<link href="css/lib/calendar2/semantic.ui.min.css" rel="stylesheet">
    <link href="css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
	<link href="css/lib/owl.carousel.min.css" rel="stylesheet" />
 <?php require_once('layout-body.php'); ?>

            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">
                    	<?php 
                    		if ($_SESSION['sexo']=='M') {
                    			echo 'Bienvenido: '.$_SESSION['nombres'].' '.$_SESSION['apellidos'];
                    		}
                    		else{
                    			echo 'Bienvenida: '.$_SESSION['nombres'].' '.$_SESSION['apellidos'];
                    		}
                    	 ?>
                    </h3> </div>
            </div>
            <div class="container-fluid">
            	<div class="row">
                    <div class="col-lg-6">
                        <div class="alert alert-info">
                            <b><h1 class="text-center">N O T I F I C A C I O N E S</h1></b>
                        </div>
                        <div class="card">
                            <div class="card-title">
                                <h4>Carnet sanitarios a punto de vencer </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre completo</th>
                                                <th>Fecha de vencimiento</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $count = 0;
                                                require_once('../controller/conexion.php');
                                                $sql = "SELECT * FROM personal p, carnet_sanitario c WHERE c.id_personal = p.id";
                                                $query = $con->query($sql) or die (mysqli_error($con));
                                                while($arreglo=mysqli_fetch_array($query)){
                                                    
                                                          $confi=date("Y-m-d");
                                                          $nuevo=strtotime("+3 month",strtotime($confi));
                                                          $nuevo=date("Y-m-d",$nuevo);
                                                          $nuevo2=strtotime("+2 month",strtotime($confi));
                                                          $nuevo2=date("Y-m-d",$nuevo2);
                                                          $nuevo3=strtotime("+1 month",strtotime($confi));
                                                          $nuevo3=date("Y-m-d",$nuevo3);
                                                          if ($arreglo[16]<$nuevo3 && $arreglo[16]>date("Y-m-d")) {
                                                              $count++;
                                                              echo "<tr>";
                                                              echo "<td>$count</td>";
                                                              echo "<td>$arreglo[3] $arreglo[4]</td>";
                                                              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[16]));
                                                              echo "<td>$fecha</td>";
                                                              echo "<td><span class='badge badge-warning'>Menos de un mes</span></td>";
                                                              echo "</tr>";
                                                          }
                                                          else if (date("Y-m-d")>=$arreglo[16]) {
                                                              $count++;
                                                              echo "<tr>";
                                                              echo "<td>$count</td>";
                                                              echo "<td>$arreglo[3] $arreglo[4]</td>";
                                                              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[16]));
                                                              echo "<td>$fecha</td>";
                                                              echo "<td><span class='badge badge-danger'>Vencido</span></td>";
                                                              echo "</tr>";
                                                          } 
                                                }
                                                if ($count == 0) {
                                                    echo "<tr>";
                                                    echo "<td colspan='4'>No hay notificaciones</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-title">
                                <h4>Personal sin horario asignado </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre completo</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $count = 0;
                                                $sql1 = "SELECT * FROM personal WHERE id NOT IN (SELECT id_personal FROM horarios_a)";
                                                $query1 = $con->query($sql1) or die (mysqli_error($con));
                                                while($arreglo1=mysqli_fetch_array($query1)){
                                                    $count++;
                                                    echo "<tr>";
                                                    echo "<td>$count</td>";
                                                    echo "<td>$arreglo1[3] $arreglo1[4]</td>";
                                                    echo "<td><span class='badge badge-danger'>No se le asigno un horario</span></td>";
                                                    echo "</tr>";
                                                }
                                                if ($count == 0) {
                                                    echo "<tr>";
                                                    echo "<td colspan='4'>No se detectó problemas</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-title">
                                <h4>Inasistencias de la semana </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre completo</th>
                                                <th>Fecha de inasistencia</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $count = 0;
                                                $sql2 = "SELECT * FROM personal p, inasistencias i WHERE p.id = i.id_personal";
                                                $query2 = $con->query($sql2) or die (mysqli_error($con));
                                                while($arreglo2=mysqli_fetch_array($query2)){
                                                    $nuevo=strtotime("-1 week",strtotime(date('Y-m-d')));
                                                    $nuevo=date("Y-m-d",$nuevo);
                                                    if ($arreglo2[15] <= date('Y-m-d') && $arreglo2[15] >= $nuevo) {
                                                        $count++;
                                                        echo "<tr>";
                                                        echo "<td>$count</td>";
                                                        echo "<td>$arreglo2[3] $arreglo2[4]</td>";
                                                        $fecha=strftime("%d/%m/%Y",strtotime($arreglo2[15]));
                                                        echo "<td>$fecha</td>";
                                                        echo "<td><span class='badge badge-danger'>No asistió</span></td>";
                                                        echo "</tr>";
                                                    }
                                                    
                                                }
                                                if ($count == 0) {
                                                    echo "<tr>";
                                                    echo "<td colspan='4'>No se registró inasistencias la ultima semana</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-title">
                                <h4>Personal con baja médica </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre completo</th>
                                                <th>Baja médica desde:</th>
                                                <th>Baja médica hasta:</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $count = 0;
                                                $sql3 = "SELECT * FROM personal p, bajas_medicas b WHERE p.id = b.id_personal";
                                                $query3 = $con->query($sql3) or die (mysqli_error($con));
                                                while($arreglo3=mysqli_fetch_array($query3)){
                                                    if (date('Y-m-d') <= $arreglo3[18] && date('Y-m-d') >= $arreglo3[17]) {
                                                        $count++;
                                                        echo "<tr>";
                                                        echo "<td>$count</td>";
                                                        echo "<td>$arreglo3[3] $arreglo3[4]</td>";
                                                        $fecha=strftime("%d/%m/%Y",strtotime($arreglo3[17]));
                                                        echo "<td>$fecha</td>";
                                                        $fecha=strftime("%d/%m/%Y",strtotime($arreglo3[18]));
                                                        echo "<td>$fecha</td>";
                                                        echo "<td><span class='badge badge-success'>Baja médica activa</span></td>";
                                                        echo "</tr>";
                                                    }
                                                    
                                                }
                                                if ($count == 0) {
                                                    echo "<tr>";
                                                    echo "<td colspan='5'>No se detecto bajas médicas activas</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                	<div class="col-lg-6 inline">
                                <div class="card bg-primary">
                                    <div class="card-body">
                                        <div class="weather-widget">
                                            <div id="weather-one" class="weather-one"></div>
                                        </div>
                                    </div>
                                </div>
    							<div class="card">
    								<div class="card-body">
    									<div class="year-calendar"></div>
    								</div>
    							</div>

    				</div>
            	
                    
            </div>
            </div>
            
            
 <?php require_once('layout-footer.php'); ?>
 	<script src="js/lib/calendar-2/moment.latest.min.js"></script>
    <!-- scripit init-->
    <script src="js/lib/calendar-2/semantic.ui.min.js"></script>
    <!-- scripit init-->
    <script src="js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="js/lib/calendar-2/pignose.init.js"></script>

    <script src="js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="js/lib/weather/weather-init.js"></script>

    
 <?php require_once('layout-close.php'); ?>