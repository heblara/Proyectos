<!-- HEADER -->
<div id="header">
    <!-- Social -->
    <div id="social-holder"><h5>&nbsp;</h5>
    </div>
    <!-- ENDS Social -->

    <!-- Navigation -->

    <?php
    @session_start();
    if (isset($_SESSION["autenticado"])) {
        include("barramenu.php");
    } 
//    else {
        ?>
        <!-- Navigation -->					
        <!-- search --><!-- ENDS search -->

        <!-- headline -->
        <div id="headline">Gestión de  <a href="#">Construcción.</a>
        </div>
        <!-- ENDS headline -->

        <!-- Slider -->
        <div id="slider-block">
            <div id="slider-holder">	<!-- headline -->

                <!-- ENDS headline -->
                <!-- Slider -->
                <div id="slider-block">
                    <div id="slider-holder">
                        <div id="slider">
                            <a href="#"><img src="images/01.jpg" title="Proyecto para Semana de Juventud 2013." alt="" /></a>
                            <a href="#"><img src="images/02.jpg" title="Proyecto para Ingenieria Civil." alt="" /></a>
                        </div>
                    </div>
                </div></div>
        </div>
        <!-- ENDS Slider -->
        <?php
//    }
    ?>
</div>
<!-- ENDS HEADER -->



