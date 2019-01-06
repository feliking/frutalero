<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]!=0 && $_SESSION["tipo"]!=3){
        print "<script>alert(\"No tiene permisos para acceder a esta página\");window.location='../views/system.php';</script>";
    }
}
else{
  print "<script>alert(\"No puede tener acceso si no esta identificado.\");window.location='../index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Requerimientos de Administracion</title>
  <link rel="shortcut icon" href="../assets/favicono.ico">
    <link rel='stylesheet prefetch' href='../plugins/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='../plugins/css/jquery.dataTables.min.css'>
    <link rel='stylesheet prefetch' href='../plugins/css/buttons.dataTables.min.css'>
    <link rel="stylesheet" href="../css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="../css/cabecera.css"> <!-- Resource style -->
    <link rel="stylesheet" type="text/css" href="../css/modal.css">
    <script src="../js/modernizr.js"></script> <!-- Modernizr -->
    <script src='../plugins/js/jquery-2.2.4.min.js'></script>
    <script type="text/javascript" src="../js/jquery.tabledit.js"></script>
    <style type="text/css">
        body{
              background: url(../assets/index.jpg) fixed;
			  -webkit-background-size:cover;
			  -moz-background-size:cover;
			  -o-background-size:cover;
			  background-size:cover;
			  padding-top: 3%;
        }

        input{
            border: none;
            content: " adsfasdf";
            background: #eee;
            border: 1px solid #ccc;
            border-radius: 15px;
        }
        tr th{
        	background-color: #5974FF;
        	color: #fff;
            text-align: center;
        }
        .valores{
            text-align: right;
        }
        @font-face{
            font-family: fuentenueva;
            src: url(../fonts/quantifypremium/webdesignpro.ttf);
        }
        .titulo{
            font-size: 40px;
            font-family: fuentenueva;
            color: #fff;
        }
        #unasemana{
            background-color: #6FFF5C;
        }
        #dossemanas{
            background-color: #FFF95E;
        }
        #tressemanas{
            background-color: #FF9E50;
        }
        #cuatrosemanas{
        	background-color: #FF9494;
        }
        #cumplido{
          visibility: hidden;
        }
        li:hover{
          background-color: #fff;
        }
    </style>
</head>
<body>
	<nav class="cd-stretchy-nav">
        <a class="cd-nav-trigger" href="#0">
            
            <span aria-hidden="true"></span>
        </a>
        <ul>
            <li><a href="../views/add_proveedor.php"><span><font color="#E0D300">Registrar Proveedores</font></span></a></li>
            <li><a href="../views/add_request.php" class="active"><span><font color="#E0D300">Registrar Requerimiento</font></span></a></li>
            <li><a href="../views/view_proveedor.php"><span><font color="#E0D300">Ver Proveedores registrados</font></span></a></li>
            <li><a href="../views/principal.php"><span><font color="#E0D300">Volver a requerimientos</font></span></a></li>
            <li><a href="../controller/logout.php"><span><font color="#E0D300">Salir: <?php echo $_SESSION["nombres"]  ?></font></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <h1 class="titulo"><center>Requerimientos Cumplidos</center></h1>

  <table id="example" class="display table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nro. de requerimiento</th>
                <th>Fecha entrega requerimiento a Administracion</th>
                <th>Area, Of. solicitante</th>
                <th>Detalle</th>
                <th>Incluye terminos de referencia</th>
                <th>El requerimiento cuenta con presupuesto</th>
                <th>Costo</th>
                <th>Responsable</th>
                <th>Estado</th>
                <th>Cuadro Comparativo</th>
                <th>Fecha de entrega</th>
                <th>Enviado a las regionales o entregado en fecha</th>
                <th>Confirmacion de entrega/Recepcion</th>
                <th>Proveedor</th>
                <th>Fecha de aprobacion de Diseño</th>
                <th>Observaciones</th>
                <th>Modalidad de contratación</th>
                <th>¿Cuenta con contrato?</th>
                <th>Estado del contrato</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Nro. de requerimiento</th>
                <th>Fecha entrega requerimiento a Administracion</th>
                <th>Area, Of. solicitante</th>
                <th>Detalle</th>
                <th>Incluye terminos de referencia</th>
                <th>El requerimiento cuenta con presupuesto</th>
                <th>Costo</th>
                <th>Responsable</th>
                <th>Estado</th>
                <th>Cuadro Comparativo</th>
                <th>Fecha de entrega</th>
                <th>Enviado a las regionales o entregado en fecha</th>
                <th>Confirmacion de entrega/Recepcion</th>
                <th>Proveedor</th>
                <th>Fecha de aprobacion de Diseño</th>
                <th>Observaciones</th>
                <th>Modalidad de contratación</th>
                <th>¿Cuenta con contrato?</th>
                <th>Estado del contrato</th>
                <th>Operaciones</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $count=0;
            $campo=null;
            $suma=0;
            $nombre=null;
            
            require("../controller/conexion.php");
            $sql=("SELECT * FROM cumplido");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
              $sql1=("SELECT * FROM proveedor where nombre='$arreglo[14]'");
              $query1=mysqli_query($con,$sql1);
              while($arreglo1=mysqli_fetch_array($query1)){
                $idp=$arreglo1[0];
                $nombre=$arreglo1[1];
                $nit=$arreglo1[2];
                $direccion=$arreglo1[3];
                $email=$arreglo1[4];
                $contacto=$arreglo1[5];
                $telefono=$arreglo1[6];
                $archivo=$arreglo1[7];
                $nro_cuenta=$arreglo1[8];

              }
              $count++;
              $confi=$arreglo[2];
              $nuevo=strtotime("+1 week",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+2 week",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              $nuevo3=strtotime("+3 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              $nuevo4=strtotime("+4 week",strtotime($confi));
              $nuevo4=date("Y-m-d",$nuevo4);
              if (date("Y-m-d")<$nuevo) {
                  $campo="unasemana";
              }
              else if (date("Y-m-d")<$nuevo2) {
                  $campo="dossemanas";
              }
              else if (date("Y-m-d")<$nuevo3) {
                  $campo="tressemanas";
              }
              else if (date("Y-m-d")<$nuevo4 || date("Y-m-d")>$nuevo4) {
                  $campo="cuatrosemanas";
              }
              echo "<tr id='$arreglo[0]'>";
              echo "<td>$arreglo[0]</td>";
              echo "<td id='$campo'>$arreglo[1]</td>";
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[2]));
              echo "<td id='$campo'>$fecha</td>";
              echo "<td id='$campo'>$arreglo[3]</td>";
              echo "<td id='$campo'>$arreglo[4]</td>";
              echo "<td id='$campo'>$arreglo[5]</td>";
              echo "<td id='$campo'>$arreglo[6]</td>";
              $monto=number_format((floatval($arreglo[7])),2,".",",");
              echo "<td id='$campo' class='valores'>$monto</td>";
              echo "<td id='$campo'>$arreglo[8]</td>";
              echo "<td id='$campo'>$arreglo[9]</td>";
              if ($arreglo[10]!=null) {
                echo "<td id='$campo'><a href='../files/cuadro/$arreglo[10]' target='_blank'>Ver documento adjuntado</td>";
              }
              else{
                echo "<td id='$campo'>No se subió ningún documento</td>";
              }
              if ($arreglo[11]!=null) {
                  $fecha=strftime("%d/%m/%Y",strtotime($arreglo[11]));
                  echo "<td id='$campo'>$fecha</td>";
              }
              else{
                echo "<td id='$campo'></td>";
              }
              if ($arreglo[12]!="N/A") {
                $fecha=strftime("%d/%m/%Y",strtotime($arreglo[12]));
                  echo "<td id='$campo'>$fecha</td>";
              }
              else{
                echo "<td id='$campo'>$arreglo[12]";
              }
              $cadena_de_texto=$arreglo[13];
              $cadena_buscada='1,2,3,4,5,6,7,8,9,10';
              $encontrado=strpos($cadena_de_texto, $cadena_buscada);
              if ($encontrado!==false) {
                echo "<td id='$campo'><a class='button' href='#openModa$count'>SI</a></td>";
              }
              else{
                echo "<td id='$campo'><a class='button' href='#openModa$count'>NO</a></td>";
              }
                echo "<div id='openModa$count' class='modalbg'>
                      <div class='dialog'>
                      <form method='post' name='form_action' action='../controller/update_confir.php'>
                        <a href='#close' title='Close' class='close'>X</a>";
                        if ((strpos($cadena_de_texto,"1"))!==false) {
                          echo "<input type='checkbox' id='1' name='confir[]' value='1' checked/> El Alto<br>";
                        }
                        else{
                          echo "<input type='checkbox' id='1' name='confir[]' value='1'/> El Alto<br>";
                        }
                        if ((strpos($cadena_de_texto,"2"))!==false) {
                          echo "<input type='checkbox' id='2' name='confir[]' value='2' checked/> La Paz<br>";
                        }
                        else{
                          echo "<input type='checkbox' id='2' name='confir[]' value='2'/> La Paz<br>";
                        }
                        if ((strpos($cadena_de_texto,"3"))!==false) {
                          echo "<input type='checkbox' id='3' name='confir[]' value='3' checked/> Cochabamba<br>";
                        }
                        else{
                          echo "<input type='checkbox' id='3' name='confir[]' value='3'/> Cochabamba<br>";
                        }
                        if ((strpos($cadena_de_texto,"4"))!==false) {
                          echo "<input type='checkbox' id='4' name='confir[]' value='4' checked/> Santa Cruz<br>";
                        }
                        else{
                          echo "<input type='checkbox' id='4' name='confir[]' value='4'/> Santa Cruz<br>";
                        }
                        if ((strpos($cadena_de_texto,"5"))!==false) {
                          echo "<input type='checkbox' id='5' name='confir[]' value='5' checked/> Oruro<br>";
                        }
                        else{
                          echo "<input type='checkbox' id='5' name='confir[]' value='5'/> Oruro<br>";
                        }
                        if ((strpos($cadena_de_texto,"6"))!==false) {
                          echo "<input type='checkbox' id='6' name='confir[]' value='6' checked/> Tarija<br>";
                        }
                        else{
                          echo "<input type='checkbox' id='6' name='confir[]' value='6'/> Tarija<br>";
                        }
                        if ((strpos($cadena_de_texto,"7"))!==false) {
                          echo "<input type='checkbox' id='7' name='confir[]' value='7' checked/> Potosi<br>";
                        }
                        else{
                          echo "<input type='checkbox' id='7' name='confir[]' value='7'/> Potosi<br>";
                        }
                        if ((strpos($cadena_de_texto,"8"))!==false) {
                          echo "<input type='checkbox' id='8' name='confir[]' value='8' checked/> Pando<br>";
                        }
                        else{
                          echo "<input type='checkbox' id='8' name='confir[]' value='8'/> Pando<br>";
                        }
                        if ((strpos($cadena_de_texto,"9"))!==false) {
                          echo "<input type='checkbox' id='9' name='confir[]' value='9' checked/> Beni<br>";
                        }
                        else{
                          echo "<input type='checkbox' id='9' name='confir[]' value='9'/> Beni<br>";
                        }
                        if ((strpos($cadena_de_texto,"10"))!==false) {
                          echo "<input type='checkbox' id='10' name='confir[]' value='10' checked/> Sucre<br>";
                        }
                        else{
                          echo "<input type='checkbox' id='10' name='confir[]' value='10'/> Sucre<br>";
                        }

                echo "<input type='submit' class='button' value='Guardar cambios'>
                      <input type='hidden' name='ide' value='$arreglo[0]'>
                </form></div>
                    </div></td>";
                    if ($nombre!=null) {
                      echo "<td id='$campo'><a class='button' href='#openModal$count'>$nombre</a>
                      <div id='openModal$count' class='modalbg'>
                        <div class='dialog'>
                          <a href='#close' title='Close' class='close'>X</a>
                          <h2><font color='#354DFF' style='font-weight:bold'>Nombre del proveedor: </font>$nombre</h2>
                          <h2><font color='#354DFF' style='font-weight:bold'>NIT: </font>$nit</h2>
                          <h2><font color='#354DFF' style='font-weight:bold'>Dirección: </font>$direccion</h2>
                          <h2><font color='#354DFF' style='font-weight:bold'>Correo electronico: </font>$email</h2>
                          <h2><font color='#354DFF' style='font-weight:bold'>Contacto: </font>$contacto</h2>
                          <h2><font color='#354DFF' style='font-weight:bold'>Telefono: </font>$telefono</h2>";
                          if ($archivo!=null) {
                            echo "<h2><font color='#354DFF' style='font-weight:bold'>Archivo: </font><a href='../files/proveedor/$archivo' target='_blank'>Ver documento adjuntado</a></h2>";
                          }
                          else{
                            echo "<h2><font color='#354DFF' style='font-weight:bold'>Archivo: </font>No se ha subido ningún archivo</h2>";
                          }
                      echo "<h2><font color='#354DFF' style='font-weight:bold'>Número de cuenta: </font>$nro_cuenta</h2>";
                      if ($arreglo[14]!="No definido") {
                        echo "<h2><a class='button' href='../views/update_proveedor.php?id=$idp'>¿Desea modificar al proveedor?</a></h2>";
                      } 
                      echo "</div>
                            </div></td>";
                            
                    }
                    else{
                      echo "<td id='$campo'>$arreglo[14]</td>";
                    }
              
              echo "<td id='$campo'>$arreglo[15]</td>";
              echo "<td id='$campo'>$arreglo[16]</td>";
              echo "<td id='$campo'>$arreglo[17]</td>";
              echo "<td id='$campo'>$arreglo[18]</td>";
              echo "<td id='$campo'>$arreglo[19]</td>";
              echo "<td id='$campo'><a class='button' href='../controller/delete_cum.php?id=$arreglo[0]' style='background:#FF7676'>Eliminar</a></td>";
              echo "</tr>";
            }
            mysqli_close($con);
            ?>
        </tbody>
    </table>
    
    <script src='../plugins/js/jquery.dataTables.min.js'></script>
    <script src='../plugins/js/dataTables.buttons.min.js'></script>
    <script src='../plugins/js/buttons.flash.min.js'></script>
    <script src='../plugins/js/jszip.min.js'></script>
    <script src='../plugins/js/vfs_fonts.js'></script>
    <script src='../plugins/js/buttons.html5.min.js'></script>
    <script src='../plugins/js/buttons.print.min.js'></script>
    <script src="../js/cabecera.js"></script> 
    <script type="text/javascript">
        $(document).ready(function() {
    $('#example').DataTable( {
        "paging":   false,
        "info":     false,
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
    //Añadir Scroll
        //"scrollY":        "50vh",//define el tamaño o dinamismo de la tabla
        //"scrollCollapse": true,
        //"paging":         false,
    dom: 'Bfrtip',
        buttons: [
            'excel',
    ]
    } );
} );
    </script>

    <script type="text/javascript" src="../js/custom_table_edit.js"></script>

</body>
</html>
