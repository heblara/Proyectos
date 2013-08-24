<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_equipos = isset($_POST['hidden_cod_equipos']) ? $_POST['hidden_cod_equipos'] : '';
$nombre = isset($_POST['txt_nombre_equipos']) ? $_POST['txt_nombre_equipos'] : '';
$actividad = isset($_POST['txt_actividad_equipos']) ? $_POST['txt_actividad_equipos'] : '';


switch ($accion) {
    case 1: //buscar equipos        
        $texto = isset($_POST['txt_texto_equipos']) ? $_POST['txt_texto_equipos'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT * FROM Equipos ";
            $sql.="WHERE nombre like '%" . $texto . "%' ORDER BY nombre ASC";

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

    case 2: //adicionando un nuevo registro

        $sql = "insert into Equipos (nombre,actividad) ";
        $sql.="values('" . $nombre . "','" . $actividad . "')";
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "EQUIPO DE TRABAJO AGREGADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR EL NUEVO EQUIPO DE TRABAJO. INTENTE DE NUEVO ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 3: //modificando al equipos
        $sql = "UPDATE Equipos SET nombre='" . $nombre . "', actividad='" . $actividad . "'";
        $sql.=" WHERE idEquipos=" . $cod_equipos;
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "EQUIPO DE TRABAJO MODIFICADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR EL EQUIPO DE TRABAJO. INTENTE DE NUEVO.";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 4:

        //eliminando al equipos
        $sql = "DELETE FROM Equipos where idEquipos=" . $cod_equipos;
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "EQUIPO DE TRABAJO ELIMINADO";
            $bandera = 1;
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR EL EQUIPO DE TRABAJO PORQUE EXISTEN REGISTROS QUE DEPENDE DE ELLA";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;
}

echo json_encode($jsonData);
?>
