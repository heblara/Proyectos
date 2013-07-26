<!-- HEADER -->
		  <div id="header">
          <!-- Social -->
			  <div id="social-holder"><h5>&nbsp;</h5>
	      </div>
				<!-- ENDS Social -->
				
				<!-- Navigation -->
                
                <?php 
				session_start();
				if(isset($_SESSION["autenticado"])){
						include("barramenu.php");
				} ?>
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
						<a href="#"><img src="images/01.jpg" title="Project for Youth Week 2013." alt="" /></a>
						<a href="#"><img src="images/02.jpg" title="Civil Engineering Project." alt="" /></a>
					</div>
				</div>
			</div></div>
			</div>
			<!-- ENDS Slider -->
				
      </div>
			<!-- ENDS HEADER -->