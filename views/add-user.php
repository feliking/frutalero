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

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">
          Registrar nuevo usuario
        </h3>
    </div>
</div>

<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Datos del nuevo usuario</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-elements">
                                    <form name="update_user" method="post" action="../controller/add_user.php">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Carnet de identidad</label><span class="text-danger">*</span>
                                                    <input type="number" class="form-control" name="ci" id="ci" placeholder="Ej. 8471995" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nombres</label>
                                                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ej. Juan Perez" >
                                                </div>
                                                <div class="form-group">
                                                    <label>Apellidos</label>
                                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
                                                </div>
                                                <div class="form-group">
                                                    <label>Sexo</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="sexo" id="sexo" required>
                                                      <option value="" selected disabled>Elija el género</option>
                                                      <option value="M">Masculino</option>
                                                      <option value="F">Femenino</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Correo electrónico</label><span class="text-danger">*</span>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="juan@perez.com" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de nacimiento</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="fecha_nac" id="fecha_nac" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Nacionalidad</label><span class="text-danger">*</span>
                                                    <select class="form-control"name="nacionalidad" id="nacionalidad" required>
                                                      <option value="" disabled selected>Seleccione la nacionalidad</option>
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
                                                    <select class="form-control" name="tipo" id="tipo" required>
                                                      <option value="" disabled selected>Seleccione el acceso del usuario</option>
                                                      <option value="0">Administrador</option>
                                                      <option value="1">Gestión de RRHH</option>
                                                      <option value="2">Control de contratos</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Región de acceso</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="region" id="region" required>
                                                      <option value="" selected disabled>Seleccione region de acceso</option>
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
                                                    <input type="text" class="form-control" name="usuario" id="usuario" oninput="return userNameValidation(this.value)" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Contraseña</label><span class="text-danger">*</span>
                                                    <input type="password" class="form-control" name="pass2" id="pass2" oninput="return passwordValidation(this.value)" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Repita la Contraseña</label><span class="text-danger">*</span>
                                                    <input type="password" class="form-control" name="pass3" id="pass3" required>
                                                </div>
                                                <div class="form-group">
                                                  <span class="text-danger" id="error"></span>
                                                </div>
                                                <div class="form-group">
                                                  <input type="submit" class="btn-rounded btn-info" value="Registrar Usuario">
                                                </div>
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

<?php require_once('layout-close.php') ?>
