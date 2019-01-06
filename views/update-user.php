<?php
session_start();
extract($_GET);
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]!=0 && $_SESSION["user_id"] != $id){
        print "<script>alert(\"No puede realizar estas acciones como usuario.\");window.location='../views/home.php';</script>";
    }
}
else{
  print "<script>alert(\"No puede tener acceso si no esta identificado.\");window.location='login.php';</script>";
}

require_once('layout-head.php');
?>

<?php require_once('layout-body.php'); ?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">
          Actualizar usuario
        </h3>
    </div>
</div>
			<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Datos del usuario</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-elements">
                                    <form name="update_user" method="post" action="../controller/update_user.php">
                                    	<?php
								          extract($_GET);
								          require("../controller/conexion.php");
								          $sql="SELECT * FROM usuario WHERE id_user=$id";
								          $ressql=mysqli_query($con,$sql);
								          while ($row=mysqli_fetch_row($ressql)) {
								            $ci=$row[1];
								            $nombres=$row[2];
								            $apellidos=$row[3];
								            $sexo=$row[4];
								            $email=$row[5];
								            $fecha_nac=$row[6];
								            $nacionalidad=$row[7];
								            $tipo=$row[8];
								            $regional=$row[9];
								            $usuario=$row[10];
								            $password=$row[11];
								          }
								          mysqli_close($con);
								         ?>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                	<label for="">Carnet de identidad</label>
                                                	<input type="text" class="form-control" name="ci" id="ci" placeholder="Carnet de identidad" value="<?php echo $ci; ?>" title="Carnet de identidad" readonly>
                                                </div>
                                                <div class="form-group">
                                                	<label for="">Nombres</label>
                                                	<input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres" value="<?php echo $nombres; ?>" title="Nombres">
                                                </div>
                                                <div class="form-group">
                                                	<label for="">Apellidos</label>
                                                	<input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" value="<?php echo $apellidos; ?>" title="Apellidos">
                                                </div>
                                                <div class="form-group">
                                                	<label for="">Sexo</label>
                                                	<select class="form-control" name="sexo" id="sexo" title="Genero" required>
											            <option value="<?php echo $sexo; ?>"><?php if($sexo=='M'){echo "Masculino";}else{echo "Femenino";} ?></option>
											            <option value="M">Masculino</option>
											            <option value="F">Femenino</option>
											         </select>
                                                </div>
                                                <div class="form-group">
                                                	<label for="">Correo electrónico</label>
                                                	<input type="email" class="form-control" name="email" id="email" placeholder="Correo electronico" value="<?php echo $email; ?>" title="Correo Electronico">
                                                </div>
                                                <div class="form-group">
                                                	<label for="">Fecha de nacimiento</label>
                                                	<input type="date" class="form-control" name="fecha_nac" id="fecha_nac" placeholder="Fecha de nacimiento" value="<?php echo $fecha_nac; ?>" title="Fecha de nacimiento">
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                            	<div class="form-group">
                                                	<label for=""></label>
                                                	<select class="form-control" name="nacionalidad" id="nacionalidad" title="Nacionalidad">
											            <option value="<?php echo $nacionalidad; ?>"><?php echo $nacionalidad; ?></option>
											            <option value="LA PAZ">LA PAZ</option>
											            <option value="EL ALTO">EL ALTO</option>
											            <option value="ORURO">ORURO</option>
											            <option value="COCHABAMBA">COCHABAMBA</option>
											            <option value="SANTA CRUZ">SANTA CRUZ</option>
											            <option value="SUCRE">SUCRE</option>
											            <option value="TARIJA">TARIJA</option>
											            <option value="POTOSI">POTOSI</option>
											            <option value="PANDO">PANDO</option>
											            <option value="BENI">BENI</option>
											        </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tipo de usuario</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="tipo" id="tipo" title="Tipo">
											            <option value="<?php echo $tipo; ?>"><?php if($tipo==0){echo "Administrador";}else if($tipo==1){echo "Gestión de RRHH";}else if($tipo==2){echo "Sistema de control de contratos";}else if($tipo==3){echo "Administración de requerimientos";} ?></option>
											            <option value="0">Administrador</option>
											            <option value="1">Gestión de RRHH</option>
											            <option value="2">Sistema de control de contratos</option>
											            <option value="3">Administración de requerimientos</option>
											        </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Región</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="region" id="region" title="Regional">
											            <option value="<?php echo $regional; ?>" selected><?php echo $regional; ?></option>
											            <option value="OF. NACIONAL">OF. Nacional</option>
											            <option value="EL ALTO">El Alto</option>
											            <option value="LA PAZ">La Paz</option>
											            <option value="COCHABAMBA">Cochabamba</option>
											            <option value="SANTA CRUZ">Santa Cruz</option>
											            <option value="ORURO">Oruro</option>
											            <option value="BENI">Beni</option>
											            <option value="PANDO">Pando</option>
											            <option value="SUCRE">Sucre</option>
											            <option value="TARIJA">Tarija</option>
											            <option value="POTOSI">Potosi</option>
											        </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nombre de usuario</label><span class="text-danger">*</span>
                                                    <input class="form-control" type="text" name="usuario" id="usuario" oninput="return userNameValidation(this.value)" placeholder="Nombre de usuario" value="<?php echo $usuario; ?>" title="Nombre de usuario">
                                                </div>
                                                <div class="form-group">
                                                    <label>Contraseña</label><span class="text-danger">*</span>
                                                    <input class="form-control" type="password" name="pass2" id="pass2" oninput="return passwordValidation(this.value)" title="Contraseña">
                                                </div>
                                                <div class="form-group">
                                                    <label>Repita la contraseña</label><span class="text-danger">*</span>
                                                    <input class="form-control" type="password" name="pass3" id="pass3" title="Repita la contraseña por favor">
                                                </div>
                                                <div class="form-group">
                                                  <span class="text-danger" id="error"></span>
                                                </div>
                                                <div class="form-group">
                                                  <input type="submit" class="btn-rounded btn-info" value="Actualizar Usuario">
                                                </div>
                                                <input type="hidden" name="ide" value="<?php echo $id; ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->

                    <!-- /# column -->
                </div>
            </div>

<?php require_once('layout-footer.php'); ?>
<script type="text/javascript">
      with(document.update_user){
        onsubmit = function(e){
        e.preventDefault();
        var x=true;
        if(pass2.value!=pass3.value){
          x=false;
          document.getElementById("error").innerHTML="Las contraseñas no son iguales, verifique por favor";
        }
        if (x){
          submit();
        }
  }
}
    </script>
<script type="text/javascript">
  var alertRedInput = "#8C1010";
var defaultInput = "rgba(10, 180, 180, 1)";

function userNameValidation(usernameInput) {
  var username = document.getElementById("usuario");
  var issueArr = [];
  if (/[-!@#$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/.test(usernameInput)) {
      issueArr.push("No introduzca caracteres especiales");
  }
  if (issueArr.length > 0) {
      username.setCustomValidity(issueArr);
      username.style.borderColor = alertRedInput;
  } else {
      username.setCustomValidity("");
      username.style.borderColor = defaultInput;
  }
}

function passwordValidation(passwordInput) {
  var password = document.getElementById("pass2");
  var issueArr = [];
  if (!/^.{7,15}$/.test(passwordInput)) {
      issueArr.push("Debe contener de 7 a 15 caracteres");
  }
  if (!/\d/.test(passwordInput)) {
      issueArr.push("Por lo menos debe contener un número");
  }
  if (!/[a-z]/.test(passwordInput)) {
      issueArr.push("Por lo menos debe tener una letra minuscúla");
  }
  if (!/[A-Z]/.test(passwordInput)) {
      issueArr.push("Por lo menos debe tener una letra mayuscúla");
  }
  if (issueArr.length > 0) {
      password.setCustomValidity(issueArr.join("\n"));
      password.style.borderColor = alertRedInput;
  } else {
      password.setCustomValidity("");
      password.style.borderColor = defaultInput;
  }
}
  </script>

<?php require_once('layout-close.php'); ?>