<?php
    session_start();
    if(!isset($_SESSION["user_id"]) ){
        print "<script>alert(\"Acceso Restringido, Debe identificarse\");window.location='../views/login.php';</script>";
    }
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Frutalero S.R.L.</title>
 	<link rel="stylesheet" type="text/css" href="css/magazine.css">
 	<link rel="stylesheet" href="css/lib/background/normalize.min.css">
	<link rel='stylesheet prefetch' href='css/lib/background/demo.css'>
	<link rel="stylesheet" type="text/css" href="css/lib/background/style.css">
 </head>
 <body>
 	  <div id="large-header" class="large-header">
  <canvas id="demo-canvas"></canvas>

    					<div class='box'>
						  <div class='pink' style="font-family: 'Arial';">
						    Ultima edición
						  </div>
						  <a href="home.php">
						  	<div class='button'>
						    Volver Atrás
						  	</div>
						  </a>
						  <div class='holder'>
						    <div class='big' style="font-family: 'Arial';">
						      <h1 style="font-family: 'Arial';">Hecho para Frutalero S.R.L.</h1>
						      <hr>
						      <p style="font-family: 'Arial';">El presente sistema fue diseñado bajo las exigencias de la empresa a cargo del Ing. Jose Loza</p>
						    </div>
						  </div>
						  <div class='description'>
						    <h1 style="font-family: 'Arial';">DDXD Desarrollo Web</h1>
						    <hr>
						    <p style="font-family: 'Arial';">Utilizando las últimas herramientas</p>
						  </div>
						  <div class='cube'>
						    <div class='cube_inner'>
						      <div class='cube_front'></div>
						      <div class='page_left'></div>
						      <div class='page_right'></div>
						      <div class='cube_back'></div>
						      <div class='cube_left'></div>
						      <div class='cube_right'></div>
						      <div class='cube_top'></div>
						      <div class='cube_bottom'></div>
						    </div>
						  </div>
						</div>
						
						
</div>
 						
						<script src='css/lib/background/EasePack.min.js'></script>
						<script src='css/lib/background/rAF.js'></script>
						<script src='css/lib/background/TweenLite.min.js'></script>
						<script src='css/lib/background/index.js'></script>
 </body>
 </html>

            		  
