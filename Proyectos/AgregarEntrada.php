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
				<p>&nbsp;</p>
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
        <br>
        <br>
        <br>
        <br>
        <br>
		<!-- ENDS WRAPPER -->
  <form  method="post" action="GuardarEntrada.php" name="form1" id="form1">	
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Específico:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <label for="select2"></label>
      <select name="lstEspecifico" id="select2">
      <?php
	  $Consultar = mysql_query("Select * from especifico",$connection);
	  while($row = mysql_fetch_array ($Consultar)){
		  echo"<option value='".$row["idEspecifico"]."'>".$row["Descripcion"]."</option>";
		  }
	  ?>
      </select>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Fecha de la Compra:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input name="FechaCompra" class="fecha" type="text" placeholder="dd/mm/aaaa" size="32" required />

      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Cantidad:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input name="Cantidad" type="number" size="32" required />
 </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Valor:</p>
          <p>&nbsp;</p></td>
        <td><input type="text" name="Habilidad1" value="" size="32" required /></td>
      </tr>
            <tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Stock Minimo:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input type="number" name="StockMin" value="" size="32" required />
</tr>
<tr valign="baseline">
        <td nowrap="nowrap" align="right"><p>Stock Máxmo:(*)</p>
          <p>&nbsp;</p></td>
        <td>
          <input type="number" name="StockMax" value="" size="32" required />
</tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Insertar registro" /></td>
      </tr>
    </table>

	</form>

</html>