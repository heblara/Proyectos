
<?php
include("../../data.php");
require_once("../dompdf_config.inc.php");
$consulta="SELECT * FROM proyectos";
$execute=mysql_query($consulta);
$html="<table width='100%' align='center'>";
$html.="<tr>";
  $html.="<td>"; 
  $html.="Numero";
  $html.="</td>";
  $html.="<td>"; 
  $html.="Nombre Proyecto";
  $html.="</td>";
  $html.="<td>"; 
  $html.="Fecha Inicio";
  $html.="</td>";
  $html.="<td>"; 
  $html.="Fecha Fin";
  $html.="</td>";
  $html.="</tr>";
$i=0;
  $html.=mysql_num_rows($execute);
while($proyecto=mysql_fetch_assoc($execute)){
  $i++;
  $html.="<tr>";
  $html.="<td>"; 
  $html.=$i;
  $html.="</td>";
  $html.="<td>"; 
  $html.=$proyecto["NombreProyecto"];
  $html.="</td>";
  $html.="<td>"; 
  $html.=$proyecto["FechaInicio"];
  $html.="</td>";
  $html.="<td>"; 
  $html.=$proyecto["FechaFin"];
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
?>
