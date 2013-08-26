<?php
ob_start();
include("data.php");
require_once("dompdf/dompdf_config.inc.php");
$consulta="SELECT * FROM proyectos";
$html="";
$html.="<table width='100%' align='center'>";
$html.="<caption><h1 align='center'>LISTADO DE COSTO DE PROYECTOS</h1></caption>";
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
  $html.="<th>"; 
  $html.="Costo";
  $html.="</th>";
  $html.="</tr><tr><td colspan='5'><hr /></td>";
  $html.="</tr>";
$i=0;
  //$html.=mysql_num_rows($execute);
$costo=0;
while($proyecto=mysql_fetch_assoc($execute)){
  $costo=0;
  $conEquipo=mysql_query("select * from equipos as e INNER JOIN equipo_personal as ep on e.idEquipos=ep.idEquipos where e.idEquipos=".$proyecto["idEquipos"]);
  if(mysql_num_rows($conEquipo)>0){
    while ($equipo=mysql_fetch_assoc($conEquipo)) {
      $conSueldo=mysql_query("select SalarioMensual from personal where idPersonal=".$equipo["idPersonal"]);
      $sueldo=mysql_fetch_assoc($conSueldo);
      $costo=$costo+$sueldo["SalarioMensual"];
    }
  }

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
  $costo+=$proyecto["CostoProyectado"];
  $html.="<td>$"; 
  $html.=$costo;
  $html.="</td>";
  $html.="</tr>";
}
$html.="</table>";
//echo $html;
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("letter", "portrait");
$dompdf->render();
$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
exit(0);
ob_end_flush();
?>
