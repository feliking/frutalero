<?php 
    session_start();
    if(!isset($_SESSION["user_id"]) && (($_SESSION["tipo"]!=1)||($_SESSION["tipo"]!=0))){
        print "<script>alert(\"Acceso Restringido, Debe identificarse\");window.location='../index.php';</script>";
    }
 ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Frutalero S.R.L.</title>
  <link rel="shortcut icon" href="../assets/favicono.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="../css/reset.css"> <!-- CSS reset -->
  <link rel="stylesheet" href="../css/cabecera.css"> <!-- Resource style -->
  <script src="../js/modernizr.js"></script> <!-- Modernizr -->
  
      <link rel="stylesheet" href="../css/form.css">

  
</head>

<body>
  <nav class="cd-stretchy-nav">
        <a class="cd-nav-trigger" href="#0">
            
            <span aria-hidden="true"></span>
        </a>

        <ul>
            <li><a href="../views/system.php" class="active"><span><font color="#E0D300">Tareas Principales</font></span></a></li>
            <li><a href="../views/add_personal.php"><span><font color="#E0D300">Registrar Nuevo miembro del personal</font></span></a></li>
            
            <li><a href="../views/view_sanitario.php"><span><font color="#E0D300">Ver Registro de carnets sanitarios</font></span></a></li>
            <li><a href="../views/rrhh.php"><span><font color="#E0D300">Ver Personal Registrado</font></span></a></li>
            <li><a href="../views/view_bajas.php"><span><font color="#E0D300">Ver registro de bajas al personal</font></span></a></li>
            <li><a href="../controller/logout.php"><span><font color="#E0D300">Salir: <?php echo $_SESSION["nombres"]  ?></font></span></a></li>
        </ul>
        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Actualizar Carnet sanitario</li>
      </ul>
      <?php 
        extract($_GET);
        require("../controller/conexion.php");
        $sql="SELECT * FROM carnet_sanitario WHERE cod_carnet_sanitario='$id'";
        $query=$con->query($sql) or die(mysqli_error());
        while ($row=mysqli_fetch_row($query)) {
          $cod_carnet_sanitario=$row[0];
          $emitido=$row[1];
          $validez=$row[2];
          $respaldo=$row[3];
          $perteneciente=$row[4];
        }
       ?>
      <form name="crea_otros" class="form-wrapper" method="post" action="../controller/update_carnet.php" enctype="multipart/form-data">
        <fieldset class="section is-active">
          <h3>Introduzca los datos del carnet sanitario</h3>
          <input type="text" name="cod_carnet_sanitario" id="cod_carnet_sanitario" value="<?php echo $cod_carnet_sanitario; ?>" readonly>
          <input type="date" name="emitido" id="emitido" value="<?php echo $emitido; ?>" required>
          <input type="date" name="validez" id="validez" value="<?php echo $validez; ?>" required>
          <input type="file" name="respaldo" id="respaldo" accept="application/pdf,image/*">
          <input type="number" name="perteneciente" id="perteneciente" value="<?php echo $perteneciente; ?>" readonly>
          <input class="submit button" type="submit" value="Actualizar Carnet sanitario">
          <div class="row cf" style="color: red"><p id="error"></p></div>
          <input type="hidden" name="docu1" value="<?php echo $respaldo; ?>">
          <input type="hidden" name="ide" id="ide" value="<?php echo $id; ?>">
        </fieldset>
      </form>
    </div>
  </div>
  
  
  <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
  <script src="../js/cabecera.js"></script> 
    
</body>
</html>
