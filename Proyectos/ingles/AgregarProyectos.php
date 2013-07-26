<!DOCTYPE  html>
<html>
	<head>
		<meta charset="utf-8">
		<title>ControlIndex</title>
		<!--CALENDARIO JQUERY -->
        <link rel="stylesheet" href="css/jquery-ui.css" />
		  <script src="js/jquery-1.9.1.js"></script>
          <script src="js/jquery-ui.js"></script>
          <link rel="stylesheet" href="/resources/demos/style.css" />
          <script>
          $(function() {
            $( ".fecha" ).datepicker({
              changeMonth: true,
              changeYear: true,
			  yearRange: '-100:+0'
            });
          });
          </script>
		<?php include("header.php") ?>

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
				<div id="twitter">


</div>
			  <!-- ENDS Twitter -->
	<br>
<br>
<br>
<br>
<br>
<br>
<br>
	<h1> Add New Project</h1>
<form  method="post" action="Save.php" name="form1" id="form1">	
    <table align="center">

  <tr>
    <td>Name:</td>
    <td><label for="textfield"></label>
      <input type="text" name="txtNombre" id="textfield"></td>
  </tr>
  <tr>
    <td>Started day::</td>
    <td><label for="textfield2"></label>
      <input type="text" name="txtfechaini" id="textfield2"></td>
  </tr>
  <tr>
    <td>Death line::</td>
    <td><label for="textfield3"></label>
      <input type="text" name="txtfechafin" id="textfield3"></td>
  </tr>
  <tr>
    <td>Type Project::</td>
    <td><label for="select"></label>
      <select name="lstTipoProyecto" id="select">
      <option value="0">Select</option>
      <?php
	  $ConsultarTipoProyecto = mysql_query("Select * from tipoproyecto",$connection);
	  while($TipoProyecto = mysql_fetch_array ($ConsultarTipoProyecto)){
		  echo"<option value='".$TipoProyecto["idTipoProyecto"]."'>".$TipoProyecto["Nombre"]."</option>";
		  }
	  ?>
      </select></td>
  </tr>
  <tr>
    <td>Prospected Cost:</td>
    <td><label for="textfield4"></label>
      <input type="text" name="txtcostoProyectado" id="textfield4"></td>
  </tr>
  <tr>
    <td>Worked:</td>
    <td><label for="select2"></label>
      <select name="lstPersonal" id="select2" multiple>
      <?php
	  $ConsultarTipoProyecto = mysql_query("Select * from personal",$connection);
	  while($TipoProyecto = mysql_fetch_array ($ConsultarTipoProyecto)){
		  echo"<option value='".$TipoProyecto["idPersonal"]."'>".$TipoProyecto["Nombres"]."</option>";
		  }
	  ?>
      </select></td>
  </tr>
</table>



	</form>
<br>
<br>
		  </div>
			<!-- ENDS MAIN -->
			
			<!-- FOOTER -->
			<div id="footer">
				
				<!-- footer-cols -->				<!-- ENDS footer-cols -->
				
				<!-- Bottom -->
				<!-- ENDS Bottom -->
</div>
			<!-- ENDS FOOTER -->
		
		</div>
		<!-- ENDS WRAPPER -->
  
</html>