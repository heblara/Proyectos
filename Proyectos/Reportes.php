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
                    <li class="col"><table>
	<tr>
		<td>DETALLE</td>
		<td>LINK</td>
	</tr>
	<tr>
		<td>Reporte de proyectos</td>
		<td><a href="ReporteProyectos.php">Proyectos</a></td>
	</tr>
	<tr>
		<td>Reporte de Personal</td>
		<td><a href="ReportePersonal.php">Personal</a></td>
	</tr>
</table></li>

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