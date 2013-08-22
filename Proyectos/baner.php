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
        <div id="headline"><?php if(isset($_SESSION["idioma"])){ if($_SESSION["idioma"]=="es"){ ?>Gestión de  <a href="#">Construcción.</a><?php }else{ echo "Construction Management."; }}else{ echo "Gestion de Construcción";} ?>
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
                            <a href="#"><img src="images/01.jpg" title="<?php if(isset($_SESSION['idioma'])){if($_SESSION["idioma"]=="es"){ ?>Proyecto para Semana de Juventud 2013.<?php }else{ echo "Project for Youth Week";}}else{ echo "Proyecto para Semana de Juventud 2013"; } ?>" alt="Proyecto para Semana de Juventud 2013" /></a>
                            <a href="#"><img src="images/02.jpg" title="<?php if(isset($_SESSION['idioma'])){if($_SESSION["idioma"]=="es"){ ?>Proyecto para Ingenieria Civil.<?php }else{ echo "Civil Engeneering oriented Project";}}else{ echo "Proyecto para Ingenieria Civil."; } ?>" alt="" /></a>
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



