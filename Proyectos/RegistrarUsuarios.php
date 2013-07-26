<!DOCTYPE  html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestión de Construcción</title>
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
				  <p>&nbsp;</p>

				    <p>&nbsp;</p>
				    </table>

				  <p>&nbsp;</p>
</div>
			  <!-- ENDS Twitter -->
	
	
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
  <form  method="post" action="Save.php" name="form1" id="form1">	
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Nombres:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input type="text" name="Nombres" value="" size="32" required />

      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Apellidos:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input type="text" name="Apellidos" value="" size="32" required title="Es necesario ingresar por lo menos un Apellido" />
 </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>FechaIngreso:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input name="FechaIngreso" class="fecha" type="text" placeholder="dd/mm/aaaa" size="32" required />

      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>FechaNacimiento:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input name="FechaNacimiento" type="text" class="fecha" placeholder="dd/mm/aaaa" size="32" required />
 </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Habilidad1:</p>
          <p>&nbsp;</p></td>
        <td><input type="text" name="Habilidad1" value="" size="32" required /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Habilidad2:</p>
          <p>&nbsp;</p></td>
        <td><input type="text" name="Habilidad2" value="" size="32" required /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Habilidad3:</p>
          <p>&nbsp;</p></td>
        <td><input type="text" name="Habilidad3" value="" size="32" required /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>DUI:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input type="text" name="DUI" value="" size="32" required />
</tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>NIT:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input type="text" name="NIT" value="" size="32" required />
</tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Pasaporte:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input type="text" name="Pasaporte" value="" size="32" required />
        </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Nacionalidad:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input type="text" name="Nacionalidad" value="" size="32" required />
</tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>AFP:(*)</p>
          <p>&nbsp;</p></td>
        <td><span id="sprytextfield9">
          <input type="text" name="AFP" value="" size="32" required />
</tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>NUP:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input type="number" name="NUP" value="" size="32" required />
 </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>ISSS:(*)</p>
          <p>&nbsp;</p></td>
        <td>          <input type="text" name="ISSS" value="" size="32" required />
</tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>SalarioMensual:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input type="text" name="SalarioMensual" value="" size="32" required />
</tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Insertar registro" /></td>
      </tr>
    </table>

	</form>

</html>