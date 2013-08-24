<?php

require("../data.php");


$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

$idPersonal = isset($_POST['txt_idPersonal']) ? $_POST['txt_idPersonal'] : '';
$idEquipos = isset($_POST['txt_idEquipo']) ? $_POST['txt_idEquipo'] : '';



switch ($accion) {
    case 1: //buscar personal_equipo        
        $texto = isset($_POST['txt_buscar_equipo']) ? $_POST['txt_buscar_equipo'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT * FROM Equipos ";
            $sql.=" WHERE nombre like '%" . $texto . "%' ORDER BY nombre ASC";
            mysql_query("SET NAMES 'utf8'");
            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idEquipos"],
                    "nombre" => $row["nombre"],
                    "actividad" => $row["actividad"]
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

        sleep(1);
        break;

    case 2:



        $texto = isset($_POST['txt_buscar_personal']) ? $_POST['txt_buscar_personal'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT p.*,te.Descripcion TipoEmp FROM Personal p ";
            $sql.=" INNER JOIN TipoEmpleado te ";
            $sql.=" ON p.idTipoEmpleado=te.idTipoEmpleado ";
            $sql.="WHERE p.Nombres like '%" . $texto . "%' OR p.Apellidos like '%" . $texto . "%' ORDER BY p.Nombres,p.Apellidos ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idPersonal"],
                    "nombre" => $row["Nombres"] . " " . $row["Apellidos"],
                    "TipoEmp" => $row["TipoEmp"]
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

    case 3:

        $sql = "insert into equipo_personal (idPersonal,idEquipos) ";
        $sql.="values(" . $idPersonal . "," . $idEquipos . ")";
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PERSONAL AGREGADO AL EQUIPO DE TRABAJO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR EL PERSONAL AL EQUIPO DE TRABAJO. INTENTE DE NUEVO ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 4:

        //eliminando al personal_equipo
        $sql = "DELETE FROM equipo_personal where idPersonal=" . $idPersonal . " AND idEquipos=" . $idEquipos;
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PERSONAL ELIMINADO DEL EQUIPO DE TRABAJO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ELIMINAR EL PERSONAL DEL EQUIPO DE TRABAJO. INTENTE DE NUEVO";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;


    case 5:

        $texto = isset($_POST['txt_id_equipo']) ? $_POST['txt_id_equipo'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT a.idPersonal,a.idEquipos,CONCAT(b.Nombres,' ',b.Apellidos) nom from equipo_personal a ";
            $sql.=" INNER JOIN Personal b ";
            $sql.=" ON a.idPersonal=b.idPersonal ";
            $sql.=" WHERE a.idEquipos=" . $texto;

            $query = mysql_query($sql, $connection);
            
            $i = 0;            
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idPersonal"],
                    "nombre" => $row["nom"],
                    "idEquipo" => $row["idEquipos"]
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

echo json_encode($jsonData);
?>
