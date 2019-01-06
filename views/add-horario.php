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

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">
          Registrar horario
        </h3>
    </div>
</div>
<div class="container-fluid" id="app">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-title">
                                <h4>Nuevo Horario</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-elements">
                                    <form name="update_user" method="post" action="../controller/add_horario.php" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6 justify-content-center">
                                                <div class="form-group">
                                                    <label>Nombre del horario</label></span>
                                                    <input type="text" class="form-control" name="nombre" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 justify-content-center">
                                                        <!--Espacio usado como sangría para los checkbox-->
                                                    </div>
                                                    <div class="col-lg-8 justify-content-center">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" v-model="vue.lunes">
                                                          <label class="form-check-label text-center" for="defaultCheck1">
                                                            Lunes
                                                          </label>
                                                        </div>
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" v-model="vue.martes">
                                                          <label class="form-check-label" for="defaultCheck1">
                                                            Martes
                                                          </label>
                                                        </div>
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" v-model="vue.miercoles">
                                                          <label class="form-check-label" for="defaultCheck1">
                                                            Miercoles
                                                          </label>
                                                        </div>
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" v-model="vue.jueves">
                                                          <label class="form-check-label" for="defaultCheck1">
                                                            Jueves
                                                          </label>
                                                        </div>
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" v-model="vue.viernes">
                                                          <label class="form-check-label" for="defaultCheck1">
                                                            Viernes
                                                          </label>
                                                        </div>
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" v-model="vue.sabado">
                                                          <label class="form-check-label" for="defaultCheck1">
                                                            Sábado
                                                          </label>
                                                        </div>
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" v-model="vue.domingo">
                                                          <label class="form-check-label" for="defaultCheck1">
                                                            Domingo
                                                        </div>
                                                        </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-6 justify-content-center">
                                              <div class="form-group">
                                                    <label>Descripción</label></span>
                                                    <input type="text" class="form-control" name="descripcion" required>
                                              </div>
                                              
                                              <table class="table">
                                                <tr>
                                                  <th>Hora de entrada</th>
                                                  <th><input type="time" class="form-control" v-model="vue.horae"></th>
                                                </tr>
                                                <tr>
                                                  <th>Hora de salida colación</th>
                                                  <th><input type="time" class="form-control" v-model="vue.horasc"></th>
                                                </tr>
                                                <tr>
                                                  <th>Hora de regreso colación</th>
                                                  <th><input type="time" class="form-control" v-model="vue.horaec"></th>
                                                </tr>
                                                <tr>
                                                  <th>Hora de salida</th>
                                                  <th><input type="time" class="form-control" v-model="vue.horas"></th>
                                                </tr>
                                              </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-lg-12">
                                            <table class="table text-nowrap table-bordered table-dark">
                                              <tr>
                                                <th></th>
                                                <th v-if="vue.lunes" class="text-light">Lunes</th>
                                                <th v-if="vue.martes" class="text-light">Martes</th>
                                                <th v-if="vue.miercoles" class="text-light">Miercoles</th>
                                                <th v-if="vue.jueves" class="text-light">Jueves</th>
                                                <th v-if="vue.viernes" class="text-light">Viernes</th>
                                                <th v-if="vue.sabado" class="text-light">Sábado</th>
                                                <th v-if="vue.domingo" class="text-light">Domingo</th>
                                              </tr>
                                              <tr>
                                                <th class="text-light">Hora Entrada</th>
                                                <th v-if="vue.lunes"><input type="time" class="form-control" name="lunes[]" :value="vue.horae"></th>
                                                <th v-if="vue.martes"><input type="time" class="form-control" name="martes[]" :value="vue.horae"></th>
                                                <th v-if="vue.miercoles"><input type="time" class="form-control" name="miercoles[]" :value="vue.horae"></th>
                                                <th v-if="vue.jueves"><input type="time" class="form-control" name="jueves[]" :value="vue.horae"></th>
                                                <th v-if="vue.viernes"><input type="time" class="form-control" name="viernes[]" :value="vue.horae"></th>
                                                <th v-if="vue.sabado"><input type="time" class="form-control" name="sabado[]" :value="vue.horae"></th>
                                                <th v-if="vue.domingo"><input type="time" class="form-control" name="domingo[]" :value="vue.horae"></th>
                                              </tr>
                                              <tr>
                                                <th class="text-light">Hora Salida colación</th>
                                                <th v-if="vue.lunes"><input type="time" class="form-control" name="lunes[]" :value="vue.horasc"></th>
                                                <th v-if="vue.martes"><input type="time" class="form-control" name="martes[]" :value="vue.horasc"></th>
                                                <th v-if="vue.miercoles"><input type="time" class="form-control" name="miercoles[]" :value="vue.horasc"></th>
                                                <th v-if="vue.jueves"><input type="time" class="form-control" name="jueves[]" :value="vue.horasc"></th>
                                                <th v-if="vue.viernes"><input type="time" class="form-control" name="viernes[]" :value="vue.horasc"></th>
                                                <th v-if="vue.sabado"><input type="time" class="form-control" name="sabado[]" :value="vue.horasc"></th>
                                                <th v-if="vue.domingo"><input type="time" class="form-control" name="domingo[]" :value="vue.horasc"></th>
                                              </tr>
                                              <tr>
                                                <th class="text-light">Hora Regreso colación</th>
                                                <th v-if="vue.lunes"><input type="time" class="form-control" name="lunes[]" :value="vue.horaec"></th>
                                                <th v-if="vue.martes"><input type="time" class="form-control" name="martes[]" :value="vue.horaec"></th>
                                                <th v-if="vue.miercoles"><input type="time" class="form-control" name="miercoles[]" :value="vue.horaec"></th>
                                                <th v-if="vue.jueves"><input type="time" class="form-control" name="jueves[]" :value="vue.horaec"></th>
                                                <th v-if="vue.viernes"><input type="time" class="form-control" name="viernes[]" :value="vue.horaec"></th>
                                                <th v-if="vue.sabado"><input type="time" class="form-control" name="sabado[]" :value="vue.horaec"></th>
                                                <th v-if="vue.domingo"><input type="time" class="form-control" name="domingo[]" :value="vue.horaec"></th>
                                              </tr>
                                              <tr>
                                                <th class="text-light">Hora Salida</th>
                                                <th v-if="vue.lunes"><input type="time" class="form-control" name="lunes[]" :value="vue.horas"></th>
                                                <th v-if="vue.martes"><input type="time" class="form-control" name="martes[]" :value="vue.horas"></th>
                                                <th v-if="vue.miercoles"><input type="time" class="form-control" name="miercoles[]" :value="vue.horas"></th>
                                                <th v-if="vue.jueves"><input type="time" class="form-control" name="jueves[]" :value="vue.horas"></th>
                                                <th v-if="vue.viernes"><input type="time" class="form-control" name="viernes[]" :value="vue.horas"></th>
                                                <th v-if="vue.sabado"><input type="time" class="form-control" name="sabado[]" :value="vue.horas"></th>
                                                <th v-if="vue.domingo"><input type="time" class="form-control" name="domingo[]" :value="vue.horas"></th>
                                              </tr>
                                            </table>
                                            <br>
                                            <div class="row">
                                              <div class="col-lg-6">
                                                <div class="form-group">
                                                  <input type="submit" class="btn-rounded btn-info" value="Registrar horario">
                                                </div>
                                              </div>
                                              <div class="col-lg-6">
                                                <div class="form-group">
                                                  <a href="view-horarios-a.php" class="btn-rounded btn-warning">Asignar horario a trabajador</a>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                  <span class="text-danger" id="error"></span>
                                            </div>
                                            
                                                <input type="hidden" name="ide" id="ide" value="<?php echo $_SESSION['user_id']; ?>">
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
<script type="text/javascript" src="js/lib/vue/vue.js"></script>
<script type="text/javascript">

var vm = new Vue({
          el: '#app',
          data: {
              vue: {
                lunes: '',
                martes: '',
                miercoles: '',
                jueves: '',
                viernes: '',
                sabado: '',
                domingo: '',
                horae: '',
                horasc: '',
                horaec: '',
                horas: '',
              }
          },
        });
</script>

<?php require_once('layout-close.php'); ?>
