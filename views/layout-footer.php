

            <!-- footer -->
            <footer class="footer">
                <div class="text-center">
                    <a href="../index.php">Frutalero S.R.L. : Departamento de Recursos Humanos</a><br>
                    <a href="http://feliking.ga" target="_blank">Feliking</a>
                </div>
                
            </footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>

    <script src="js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/lib/owl-carousel/owl.carousel-init.js"></script>
    
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
      <script>
        window.onload = function(){killerSession();}
         
        function killerSession(){
          setTimeout("window.open('../controller/session.php','_top');",600000);
        }
      </script>

