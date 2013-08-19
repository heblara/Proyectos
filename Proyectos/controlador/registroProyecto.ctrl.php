<?php

require("../data.php");


$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_proyecto = isset($_POST['hidden_cod_proyecto']) ? $_POST['hidden_cod_proyecto'] : '';
$nombre = isset($_POST['txt_nombre_proyecto']) ? $_POST['txt_nombre_proyecto'] : '';
$tipo_proyecto = isset($_POST['sel_tipo_proyecto']) ? $_POST['sel_tipo_proyecto'] : '';
$fecha_ini = isset($_POST['txt_fecha_inicio_proyecto']) ? $_POST['txt_fecha_inicio_proyecto'] : '';
$fecha_fin = isset($_POST['txt_fecha_fin_proyecto']) ? $_POST['txt_fecha_fin_proyecto'] : '';
$costo = isset($_POST['txt_costo_proyecto']) ? $_POST['txt_costo_proyecto'] : '';






switch ($accion) {
    case 1: //buscar proyecto        
        $texto = isset($_POST['txt_texto_proyecto']) ? $_POST['txt_texto_proyecto'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT p.*,tp.Nombre label_proyecto FROM Proyectos p ";
            $sql .= "inner join TipoProyecto tp ";
            $sql .= "on p.idTipoProyecto =  tp.idTipoProyecto ";
            $sql.="WHERE p.NombreProyecto like '%" . $texto . "%' ORDER BY p.NombreProyecto ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idProyectos"],
                    "idTipoProyecto" => $row["idTipoProyecto"],
                    "label_proyecto" => $row["label_proyecto"],
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
        break;

    case 2: //adicionando un nuevo registro

        $sql = "insert into Proyectos (idTipoProyecto,NombreProyecto,FechaInicio,FechaFin,CostoProyectado) ";
        $sql.="values(" . $tipo_proyecto . ",'" . $nombre . "','" . $fecha_ini . "','" . $fecha_fin . "','" . $costo . "')";
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


        $sql = "UPDATE Proyectos SET idTipoProyecto=" . $tipo_proyecto . ",";
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
}
sleep(1);
echo json_encode($jsonData);
?>
