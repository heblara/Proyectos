<?php

require("../data.php");


$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_proyecto = isset($_POST['hidden_cod_proyecto']) ? $_POST['hidden_cod_proyecto'] : '';
$nombre = isset($_POST['txt_nombre_proyecto']) ? $_POST['txt_nombre_proyecto'] : '';
$tipo_proyecto = isset($_POST['sel_tipo_proyecto']) ? $_POST['sel_tipo_proyecto'] : '';
$fecha_ini = isset($_POST['txt_fecha_inicio_proyecto']) ? $_POST['txt_fecha_inicio_proyecto'] : '';
$fecha_fin = isset($_POST['txt_fecha_fin_proyecto']) ? $_POST['txt_fecha_fin_proyecto'] : '';
$costo = isset($_POST['txt_costo_proyecto']) ? $_POST['txt_costo_proyecto'] : '';
$idEquipos = isset($_POST['hidden_cod_personal_equipo']) ? $_POST['hidden_cod_personal_equipo'] : '';


switch ($accion) {
    case 1: //buscar proyecto        
        $texto = isset($_POST['txt_texto_proyecto']) ? $_POST['txt_texto_proyecto'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT p.*,tp.Nombre label_proyecto,eq.nombre label_equipo FROM Proyectos p ";
            $sql .= "inner join TipoProyecto tp ";
            $sql .= "on p.idTipoProyecto =  tp.idTipoProyecto ";
            $sql.=" inner join Equipos eq ";
            $sql.=" on p.idEquipos=eq.idEquipos ";
            $sql.="WHERE p.NombreProyecto like '%" . $texto . "%' ORDER BY p.NombreProyecto ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idProyectos"],
                    "idTipoProyecto" => $row["idTipoProyecto"],
                    "label_proyecto" => $row["label_proyecto"],
                    "idEquipos" => $row["idEquipos"],
                    "label_equipo" => $row["label_equipo"],
                    "nombre" => $row["NombreProyecto"],
                    "fecha_ini" => $row["FechaInicio"],
                    "fecha_fin" => $row["FechaFin"],
                    "costo" => $row["CostoProyectado"]
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

        $sql = "insert into Proyectos (idTipoProyecto,idEquipos,NombreProyecto,FechaInicio,FechaFin,CostoProyectado) ";
        $sql.="values(" . $tipo_proyecto . "," . $idEquipos . ",'" . $nombre . "','" . $fecha_ini . "','" . $fecha_fin . "','" . $costo . "')";
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PROYECTO AGREGADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR EL PROYECTO. INTENTE DE NUEVO ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 3: //modificando al proyecto


        $sql = "UPDATE Proyectos SET idTipoProyecto=" . $tipo_proyecto . ",idEquipos=" . $idEquipos . ",";
        $sql .="NombreProyecto='" . $nombre . "',FechaInicio='" . $fecha_ini . "',";
        $sql.="CostoProyectado='" . $costo . "',FechaFin='" . $fecha_fin . "'";
        $sql.=" WHERE idProyectos=" . $cod_proyecto;
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PROYECTO MODIFICADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR EL PROYECTO. INTENTE DE NUEVO. ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 4:

        //eliminando al proyecto
        $sql = "DELETE FROM Proyectos where idProyectos=" . $cod_proyecto;
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PROYECTO ELIMINADO";
            $bandera = 1;
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR EL PROYECTO PORQUE EXISTEN REGISTROS QUE DEPENDE DE EL";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 5:
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
}

echo json_encode($jsonData);
?>
