<?php
include("data.php");
ob_start();
require_once("dompdf/dompdf_config.inc.php");
$consulta="SELECT * FROM personal";
$html="";
$html.="<table width='100%' align='center'>";
$html.="<caption><h1 align='center'>LISTADO DE PERSONAL DE LA EMPRESA</h1></caption>";
$execute=mysql_query($consulta);

$html.="<tr>";
  $html.="<th>"; 
  $html.="Numero";
  $html.="</th>";
  $html.="<th>"; 
  $html.="Nombre completo";
  $html.="</th>";
  $html.="<th>"; 
  $html.="Fecha de ingreso";
  $html.="</th>";
  $html.="<th>"; 
  $html.="Habilidades";
  $html.="</th>";
  $html.="</tr><tr><td colspan='4'><hr /></td>";
  $html.="</tr>";
$i=0;
  //$html.=mysql_num_rows($execute);
while($personal=mysql_fetch_assoc($execute)){
  $i++;
  $html.="<tr>";
  $html.="<td>"; 
  $html.=$i;
  $html.="</td>";
  $html.="<td>"; 
  $html.=$personal["Nombres"]." ".$personal["Apellidos"];
  $html.="</td>";
  $html.="<td>"; 
  $html.=$personal["FechaIngreso"];
  $html.="</td>";
  $html.="<td>"; 
  $html.=$personal["Habilidad1"].", ".$personal["Habilidad2"].", ".$personal["Habilidad3"];
  $html.="</td>";
  $html.="</tr>";
}
$html.="</table>";
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("letter", "portrait");
$dompdf->render();
$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
exit(0);
ob_end_flush();
?>
