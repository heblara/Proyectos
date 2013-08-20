<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>        
        <link rel="stylesheet" href="css/jquery-ui.css" />        
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>             
        <script src="js/money/jquery.price_format.1.8.min.js"></script>
        <script src="js/registroProyecto.js"></script>                
        <?php
        include("header.php");
        ?>

        <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
    </head>

    <body class="home">
        <!-- WRAPPER -->
        <div id="wrapper">	
            <?php
            include("baner.php");
            require("data.php");
            ?>	
            <!-- MAIN -->
            <div id="main">

                <!-- content --><!-- ENDS content -->

                <!-- Twitter -->
                <div id="twitter">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>                    
                    <p>&nbsp;</p>
                </div>
                <!-- ENDS Twitter -->
            </div>
            <!-- ENDS MAIN -->

            <!-- FOOTER -->
            <div id="footer">
                <!-- content -->
			<div id="content">
				
				<!-- title -->
				<div id="page-title">
					<span class="title">Listado de Proyectos</span>
					<span class="subtitle">Vea nuestro portafolio de proyectos</span>
				</div>
				<!-- ENDS title -->
				
				<!-- Portfolio -->
				<div id="projects-list">
					
					<?php 
$consultarProyectos="SELECT * FROM proyectos";
$pr=mysql_query($consultarProyectos);
while($proyecto=mysql_fetch_assoc($pr)){
?>
					<div class="project">
						<h1><a href="project.html"><?php echo $proyecto["NombreProyecto"] ?></a></h1>
						
						<!-- shadow -->
						<div class="project-shadow">
							<!-- project-thumb -->
							<div class="project-thumbnail">
								
								<!-- meta -->
								<ul class="meta">
									<li><strong>Project date</strong> <?php echo "Del ".$proyecto["FechaInicio"]." al ".$proyecto["FechaFin"] ?> </li>
									<li><strong>Costo proyectado</strong> <?php echo $proyecto["CostoProyectado"] ?></li> 
								</ul>
								<!-- ENDS meta -->
								
								<a href="project.html" class="cover"><img src="img/dummies/438x267.gif"  alt="Feature image" /></a>
							</div>
							<!-- ENDS project-thumb -->
							
							<div class="the-excerpt">
								
							</div>	
							<a href="project.html" class="read-more">View project</a>
						
						</div>
						<!-- ENDS shadow -->
					</div>
					<!-- ENDS project -->
<?php
}
?>

				</div>
				<!-- ENDS Portfolio -->

			</div>
			<!-- ENDS content -->

                <!-- footer-cols -->				<!-- ENDS footer-cols -->
                <div id="bottom">
                    <?php include("bottom.php") ?>
                </div>

                <!-- ENDS Bottom -->
            </div>
            <!-- ENDS FOOTER -->

        </div>
        <!-- ENDS WRAPPER -->


</html>
