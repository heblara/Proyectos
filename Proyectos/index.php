<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inicio de Sesión ::: Gestión de Construcción</title>
        <?php include("header.php") ?>
        <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
        <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
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
                        echo "<h2>Usted se ha autenticado como: " . $_SESSION['usuario'] . "</h2>";
                    } else {
                        ?>
                        <li class="col">
                            <h6>LOGIN:</h6>
                        </li>

                        <li class="col">
                            <form name="form4" method="post" action="logear.php">
                                <p>
                                    <label for="textfield3"></label>
                                    Usuario:</p>
                                <p>
                                    <label for="textfield3"></label>
                                    <span id="sprytextfield1">
                                        <input name="textuser" type="text" class="highlight" id="textfield3">
                                        <span class="textfieldRequiredMsg">Digite su Usuario.</span></span></p>
                                <p>&nbsp;</p>
                                <p>Contraseña:</p>
                                <p>
                                    <label for="textfield4"></label>
                                    <span id="sprytextfield2">
                                        <input name="textpass" type="password" class="highlight" id="textfield4">
                                        <span class="textfieldRequiredMsg">Digite su contraseña.</span></span></p>
                                <p>&nbsp;</p>
                                <p>
                                    <input type="submit" name="button" id="button" value="Ingresar">
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