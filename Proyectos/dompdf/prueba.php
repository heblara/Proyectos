<?php
/*include_once ('../SISNEJ/DBManager.class.php'); //Clase de Conexión a las Base de Datos
include('../SISNEJ/sisnej.class.php');
include("../SISNEJ/conf.php");
include("../SISNEJ/conexion.php");*/
?>
<div id="Formulario" align="center" style="display:none; font-weight:bold;">
<?php 
/*$objSisnej=new Sisnej();
$id=base64_decode($_GET["id"]);
$consultarNot=$objSisnej->consultar_notificacion($id);
$resNot=$consultarNot->fetch(PDO::FETCH_OBJ);*/
?>
<?php 
$html = <<<EOD
<table width="50%" style="background-color:#FFF;">
	<tbody><tr>
		<td rowspan="3"><img src="img/CSJ.png"></td>
		<td><h3>JUZGADO PRIMERO DE PAZ DE SAN SALVADOR, SAN SALVADOR</h3></td>
	</tr>
	<tr>
		<td>HEBER LARA</td>
	</tr>
	<tr>
		<td>27-06-2013 04:21:15 PM</td>
	</tr>
	<tr>
		<td>Enviado a:</td>
		<td>Heber Mauricio Lara Peña (heberlara07@gmail.com)</td>
	</tr>
	<tr>
		<td>Observaciones:</td>
		<td style="text-decoration:underline;">EL USUARIO INGRESÓ CERO  VECES</td>
	</tr>
</tbody></table>
EOD;
?>

<!--<input type='text' value='' id='txtId' />-->
<?php

require_once("dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("portrait", "letter");
$dompdf->render();

$dompdf->stream("dompdf_out.pdf");
exit(0); 
?>