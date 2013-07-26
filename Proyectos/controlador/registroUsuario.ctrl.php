<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
switch ($accion) {
    case 1: //buscar personal
        $opc = isset($_POST['sel_buscar_empleado']) ? $_POST['sel_buscar_empleado'] : '';
        $texto = isset($_POST['txt_texto_empleado']) ? $_POST['txt_texto_empleado'] : '';
        if ($opc != '' && $texto != '') {
            $sql = "SELECT a.idPersonal, concat( a.nombres, ', ', a.apellidos ) nom, ifnull( b.idNivelConfianza, '' ) idNivel, ";
            $sql.="ifnull( b.Usuario, '' ) user, ifnull( b.Contrasena, '' ) pass, IF(b.Activo=0, 0, IF(b.Activo=1,1,''))  estado, ";
            $sql.="a.dui, a.nit, ifnull(c.Descripcion,'') des ";
            $sql.="FROM personal a ";
            $sql.="LEFT JOIN usuarios b ";
            $sql.="on a.idPersonal=b.idPersonal ";
            $sql.="LEFT JOIN nivelconfianza c ON c.idNivelConfianza = b.idNivelConfianza ";
            $sql.="WHERE a." . $opc . " like '%" . $texto . "%' ORDER BY a.Apellidos,a.Nombres ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idPersonal"],
                    "idPrivilegio"=>$row["idNivel"],
                    "labelPrivilegio"=>$row["des"],
                    "nick"=>$row["user"],
                    "password"=>$row["pass"],
                    "estado"=>$row["estado"],
                    "nombre" => $row["nom"],
                    "dui" => $row["dui"],
                    "nit" => $row["nit"]
                );
                $i++;
            }


            $jsonData["mensaje"] = "RECUPERANDO DATOS";
            $jsonData["bandera"] = 1;
            $jsonData["total_rows"] = $i;
            $jsonData["rows"] = $array_data;
        } else {
            $jsonData["mensaje"] = "FALTAN CAMPOS POR LLENAR";
            $jsonData["bandera"] = 0;
        }

        break;
}
sleep(1);
echo json_encode($jsonData);
?>
