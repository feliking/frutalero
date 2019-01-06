<?php 
    session_start();
    if(isset($_SESSION["user_id"])){
        print "<script>alert(\"Existe una sesion activa\");window.location='../views/home.php';</script>";
    }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Frutalero S.R.L.</title>

    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link href="../style.css" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="../css/responsive.css" rel="stylesheet">
    <style type="text/css">
        @font-face{
            font-family: titulo;
            src:url(../fonts/Wisdom_Script_0.otf);
        }
        #nombre_usuario {
            font-size: 18px;
            padding: 15px 15px;
            border-radius: 25px 25px 25px 0;
            color:#46C500;
        }

        #password {
            font-size: 18px;
            padding: 15px 15px;
            border-radius: 25px 25px 25px 0;
        }
    </style>

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div class="colorlib-load"></div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header_area animated">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Menu Area Start -->
                <div class="col-12 col-lg-10">
                    <div class="menu_area">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <!-- Logo -->
                            <a class="navbar-brand" style="font-family: titulo; font-size: " href="#">Frutalero</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ca-navbar" aria-controls="ca-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                            <!-- Menu Area -->
                            <div class="collapse navbar-collapse" id="ca-navbar">
                                <div class="sing-up-button d-lg-none">
                                    <a href="../index.php">Página Principal</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Signup btn -->
                <div class="col-12 col-lg-2">
                    <div class="sing-up-button d-none d-lg-block">
                        <a href="../index.php">Página Principal</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Contact Us Area Start ***** -->
    <section class="footer-contact-area section_padding_100 clearfix" style="background: #E4DC00" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Heading Text  -->
                    <div class="section-heading">
                        <h2 style="font-family: titulo">Ingreso a los sistemas</h2>
                        <div class="line-shape"></div>
                    </div>
                    <div class="footer-text">
                        <p>Introduce los datos proporcionados por "Gerencia de producción" para el ingreso a los sistemas de gestión, administración y control. </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Form Start-->
                    <div class="contact_from">
                        <form action="../controller/login.php" method="post">
                            <!-- Message Input Area Start -->
                            <div class="contact_input_area">
                                <div class="row">
                                    <!-- Single Input Area Start -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" placeholder="Introduce tu nombre de usuario" required>
                                        </div>
                                    </div>
                                    <!-- Single Input Area Start -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Introduce tu contraseña" required>
                                        </div>
                                    </div>
                                    <!-- Single Input Area Start -->
                                    <div class="col-12">
                                        <button type="submit" class="btn submit-btn">Ingresar</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Message Input Area End -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Contact Us Area End ***** -->

    <!-- ***** Footer Area Start ***** -->
    <footer class="footer-social-icon text-center section_padding_70 clearfix">
        <!-- footer logo -->
        <div class="footer-text">
            <h2 style="font-family: titulo">Frutalero</h2>
        </div>
        <!-- social icon-->
        <div class="footer-social-icon">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"> <i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
        </div>
        <div class="footer-menu">
            <nav>
                <ul>
                    <li><a href="#">Acerca de</a></li>
                    <li><a href="#">Terminos de uso</a></li>
                    <li><a href="#">Politica de privacidad</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </nav>
        </div>
        <!-- Foooter Text-->
        <div class="copyright-text">
            <!-- ***** Removing this text is now allowed! This template is licensed under CC BY 3.0 ***** -->
            <p>Copyright ©2018 <a href="http://www.feliking.ga/" target="_blank">Feliking. </a>Diseñado para Frutalero S.R.L.</p>
        </div>
    </footer>
    <!-- ***** Footer Area Start ***** -->

    <!-- Jquery-2.2.4 JS -->
    <script src="../js/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="../js/popper.min.js"></script>
    <!-- Bootstrap-4 Beta JS -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- All Plugins JS -->
    <script src="../js/plugins.js"></script>
    <!-- Slick Slider Js-->
    <script src="../js/slick.min.js"></script>
    <!-- Footer Reveal JS -->
    <script src="../js/footer-reveal.min.js"></script>
    <!-- Active JS -->
    <script src="../js/active.js"></script>
</body>

</html>
