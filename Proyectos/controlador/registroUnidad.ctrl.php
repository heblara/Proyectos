<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$descripcion = isset($_POST['texta_descripcion_unidad']) ? $_POST['texta_descripcion_unidad'] : '';
$cod_unidad = isset($_POST['hidden_cod_unidad']) ? $_POST['hidden_cod_unidad'] : '';


switch ($accion) {
    case 1: //buscar personal
        $array_data = array();
        $texto = isset($_POST['txt_texto_unidad']) ? $_POST['txt_texto_unidad'] : '';
        if ($texto != '') {
            $sql = "SELECT * FROM Unidad ";
            $sql.="WHERE Descripcion like '%" . $texto . "%' ORDER BY Descripcion ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idUnidad"],
                    "descripcion" => $row["Descripcion"]
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

        $sql = "insert into Unidad (Descripcion) ";
        $sql.="values('" . $descripcion . "')";
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "UNIDAD AGREGADA";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR LA NUEVA UNIDAD. INTENTE DE NUEVO ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;

    case 3: //modificando la unidad


        $sql = "UPDATE Unidad SET Descripcion='" . $descripcion . "' WHERE idUnidad=" . $cod_unidad;
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "UNIDAD MODIFICADA";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR LA UNIDAD. INTENTE DE NUEVO.";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;

    case 4: //eliminando unidad
        $sql = "SELECT COUNT(*) total from Lineas where idUnidad=" . $cod_unidad;
        $query = mysql_query($sql, $connection);
        $row = mysql_fetch_array($query);
        if ($row['total'] == 0) {
            $sql = "delete from Unidad where idUnidad=" . $cod_unidad;
            $respuesta = mysql_query($sql, $connection);
            if ($respuesta) {
                $mensaje = "UNIDAD ELIMINADA";
                $bandera = 1;
            } else {
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ELIMINAR LA UNIDAD. INTENTE DE NUEVO ";
                $bandera = 0;
            }
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR LA UNIDAD PORQUE HAY REGISTROS QUE DEPENDEN DE ELLA.";
            $bandera = 0;
        }


        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;
}

echo json_encode($jsonData);
?>
