
<?php
include("data.php");
require_once("dompdf/dompdf_config.inc.php");
$consulta="SELECT * FROM proyectos";
$html="";
$html.="<table width='100%' align='center'>";
$html.="<caption><h1 align='center'>LISTADO DE PROYECTOS</h1></caption>";
$execute=mysql_query($consulta);

$html.="<tr>";
  $html.="<th>"; 
  $html.="Numero";
  $html.="</th>";
  $html.="<th>"; 
  $html.="Nombre Proyecto";
  $html.="</th>";
  $html.="<th>"; 
  $html.="Fecha Inicio";
  $html.="</th>";
  $html.="<th>"; 
  $html.="Fecha Fin";
  $html.="</th>";
  $html.="</tr><tr><td colspan='4'><hr /></td>";
  $html.="</tr>";
$i=0;
  //$html.=mysql_num_rows($execute);
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
