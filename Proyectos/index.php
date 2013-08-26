<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inicio de Sesión ::: Gestión de Construcción</title>
        <?php //include("header.php") ?>
        <?php
@session_start();
require("data.php");
mysql_query("SET NAMES 'UTF8'")
?>
<!-- CSS -->
        <link rel="shorcut icon" href="img/favicon.ico" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/social-icons.css" type="text/css" media="screen" />
        <!--[if IE 8]>
            <link rel="stylesheet" type="text/css" media="screen" href="/css/ie8-hacks.css" />
        <![endif]-->
        <!-- ENDS CSS -->   
        
        <!-- GOOGLE FONTS -->
        <!--<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>-->
        
        <!-- JS -->
        <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>                 
        <script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
        <script type="text/javascript" src="js/easing.js"></script>
        <script type="text/javascript" src="js/jquery.scrollTo-1.4.2-min.js"></script>
        <script type="text/javascript" src="js/quicksand.js"></script>
        <script type="text/javascript" src="js/jquery.cycle.all.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
        <!--[if IE]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <!--[if IE 6]>
            <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
            <script>
                /* EXAMPLE */
                //DD_belatedPNG.fix('*');
            </script>
        <![endif]-->
        <!-- ENDS JS -->
        
        
        <!-- Nivo slider -->
        <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
        <script src="js/nivo-slider/jquery.nivo.slider.js" type="text/javascript"></script>
        <!-- ENDS Nivo slider -->
        
        <!-- tabs -->
        <link rel="stylesheet" href="css/tabs.css" type="text/css" media="screen" />
        <script type="text/javascript" src="js/tabs.js"></script>
        <!-- ENDS tabs -->
        
        <!-- prettyPhoto -->
        <script type="text/javascript" src="js/prettyPhoto/js/jquery.prettyPhoto.js"></script>
        <link rel="stylesheet" href="js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" />
        <!-- ENDS prettyPhoto -->
        
        <!-- superfish -->
        <link rel="stylesheet" media="screen" href="css/superfish.css" /> 
        <!--<link rel="stylesheet" media="screen" href="css/superfish-left.css" />--> 
        <script type="text/javascript" src="js/superfish-1.4.8/js/hoverIntent.js"></script>
        <script type="text/javascript" src="js/superfish-1.4.8/js/superfish.js"></script>
        <script type="text/javascript" src="js/superfish-1.4.8/js/supersubs.js"></script>
        <!-- ENDS superfish -->
        
        <!-- poshytip -->
        <link rel="stylesheet" href="js/poshytip-1.0/src/tip-twitter/tip-twitter.css" type="text/css" />
        <link rel="stylesheet" href="js/poshytip-1.0/src/tip-yellowsimple/tip-yellowsimple.css" type="text/css" />
        <script type="text/javascript" src="js/poshytip-1.0/src/jquery.poshytip.min.js"></script>
        <!-- ENDS poshytip -->
        
        <!-- Tweet -->
        <!--<link rel="stylesheet" href="css/jquery.tweet.css" media="all"  type="text/css"/>--> 
        <script src="js/tweet/jquery.tweet.js" type="text/javascript"></script> 
        <!-- ENDS Tweet -->
        
        <!-- Fancybox -->
        <link rel="stylesheet" href="js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
        <script type="text/javascript" src="js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <!-- ENDS Fancybox -->
        
        <!-- SKIN -->
        <link rel="stylesheet" href="skins/plastic/style.css" type="text/css" media="screen" />
        <?php 
        if (!isset($_SESSION["autenticado"])) {
        ?>
        <script type="text/javascript" src="lib/alertify.js"></script>
        <link rel="stylesheet" href="themes/alertify.core.css" />
        <link rel="stylesheet" href="themes/alertify.default.css" />
        <script src="lib/eventos.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <?php
        }
        ?>
        <script type="text/javascript">
            function cambiaridioma(lang){
                //alert(lang);
                if(lang=="en"){
                    document.getElementById('errorUser').innerHTML="Type your username";
                    document.getElementById('errorPwd').innerHTML="Type your password";
                }else if(lang=="es"){
                    document.getElementById('errorUser').innerHTML="Digite su usuario";
                    document.getElementById('errorPwd').innerHTML="Digite su contrase&ntilde;a";
                }
            }
        </script>
        <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
        <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
        <script>
        $(document).ready(function(){                   
            $("#submit").click(function(){
                var formulario = $("#frmLogin").serializeArray();
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "logear.php",
                    data: formulario,
                }).done(function(respuesta){
                    //$("#mensaje").html(respuesta.mensaje);
                    if(respuesta.mensaje==1){
                        error("Por favor llene todos los campos");
                    }else if(respuesta.mensaje==2){
                        error("Combinacion de usuario y contraseña incorrecta");
                    }else if(respuesta.mensaje==3){
                        ok("Datos correctos");
                        location.href="?mod=home";
                    }
                });
            });
        });
        </script>
    </head>

    <body class="home">
        <!-- WRAPPER -->
        <div id="wrapper">

            <?php include("baner.php") ?>

            <!-- MAIN -->
            <div id="main">

                <!-- content --><!-- ENDS content -->

                <!-- Twitter -->
                <div id="twitter"></div>
                <!-- ENDS Twitter -->


            </div>
            <!-- ENDS MAIN -->

            <!-- FOOTER -->
            <div id="footer">

                <!-- footer-cols -->
                <ul id="footer-cols">
                    <li class="col"></li>
                    <li class="col">
                        <h6>&nbsp;</h6>
                        <ul>
                            <li></li>
                            <li></li>
                            <li>
                                <form name="form3" method="post" action="logear.php">
                                </form>
                            </li>
                        </ul>
                    </li>
                    <?php
                    if (isset($_SESSION["autenticado"])) {
                        if(isset($_SESSION["idioma"])){
                            if($_SESSION["idioma"]=="es"){
                                echo "<h2>Usted se ha autenticado como: " . $_SESSION['usuario'] . "</h2>";
                            }else{
                                echo "<h2>You are logged as: " . $_SESSION['usuario'] . "</h2>";
                            }
                        }
                    } else {
                        ?>
                        <li class="col">
                            <h6>LOGIN:</h6>
                        </li>

                        <li class="col">
                            <form name="form4" id="frmLogin">
                            <!--<form name="form4" method="post" action="logear.php">-->
                                <p>
                                    <label for="textfield3"></label>
                                    Usuario:</p>
                                <p>
                                    <label for="textfield3"></label>
                                    <span id="sprytextfield1">
                                        <input name="textuser" type="text" class="highlight" id="textfield3">
                                        <span class="textfieldRequiredMsg" id='errorUser'>Digite su Usuario.</span></span></p>
                                <p>&nbsp;</p>
                                <p>Contraseña:</p>
                                <p>
                                    <label for="textfield4"></label>
                                    <span id="sprytextfield2">
                                        <input name="textpass" type="password" class="highlight" id="textfield4">
                                        <span class="textfieldRequiredMsg" id='errorPwd'>Digite su contraseña.</span></span></p>
                                <p>&nbsp;</p>
                                <p>Idioma:</p>
                                <p>
                                    <label for="textfield4"></label>
                                    <span id="sprytextfield2">
                                        <select name="lstIdioma" id="lstIdioma" onchange="cambiaridioma(document.getElementById('lstIdioma').options[document.getElementById('lstIdioma').selectedIndex].value)">
                                            <option value="es" selected="selected">Español</option>
                                            <option value="en">English</option>
                                        </select>
                                        <span class="textfieldRequiredMsg">Elija un idioma.</span></p>
                                <p>&nbsp;</p>
                                <p>
                                    <input type="button" name="button" id="submit" value="Ingresar">
                                </p>
                            </form>
                        </li>
                    <?php } ?>

                </ul>
                <!-- ENDS footer-cols -->

                <!-- Bottom -->
                <div id="bottom">
                    <?php include("bottom.php") ?>
                </div>
                <!-- ENDS Bottom -->
            </div>
            <!-- ENDS FOOTER -->

        </div>
        <!-- ENDS WRAPPER -->

        <script type="text/javascript">
            var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
            var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
        </script>
    </body>

</html>