<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_unidad_medida = isset($_POST['hidden_cod_unidad_medida']) ? $_POST['hidden_cod_unidad_medida'] : '';
$nombre = isset($_POST['txt_nombre_unidad_medida']) ? $_POST['txt_nombre_unidad_medida'] : '';



switch ($accion) {
    case 1: //buscar unidad_medida        
        $texto = isset($_POST['txt_texto_unidad_medida']) ? $_POST['txt_texto_unidad_medida'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT * FROM UnidadesMedida ";
            $sql.="WHERE Descripcion like '%" . $texto . "%' ORDER BY Descripcion ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idUnidadesMedida"],
                    "nombre" => $row["Descripcion"]
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

        $sql = "insert into UnidadesMedida (Descripcion) ";
        $sql.="values('" . $nombre . "')";
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "UNIDAD DE MEDIDA AGREGADA";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR LA NUEVA UNIDAD DE MEDIDA. INTENTE DE NUEVO ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 3: //modificando al unidad_medida
        $sql = "UPDATE UnidadesMedida SET Descripcion='" . $nombre . "'";
        $sql.="WHERE idUnidadesMedida=" . $cod_unidad_medida;
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "UNIDAD DE MEDIDA MODIFICADA";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR LA UNIDAD DE MEDIDA. INTENTE DE NUEVO.";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 4:
        $sql = "SELECT COUNT(*) total from Especifico where idUnidadMedida=" . $cod_unidad_medida;
        $query = mysql_query($sql, $connection);
        $row = mysql_fetch_array($query);
        if ($row['total'] == 0) {
            //eliminando al unidad_medida
            $sql = "DELETE FROM UnidadesMedida where idUnidadesMedida=" . $cod_unidad_medida;
            $respuesta = mysql_query($sql, $connection);
            if ($respuesta) {
                $mensaje = "UNIDAD DE MEDIDA ELIMINADA";
                $bandera = 1;
            } else {
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ELIMINAR LA UNIDAD DE MEDIDA. INTENTE DE NUEVO";
                $bandera = 0;
            }
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR LA UNIDAD DE MEDIDA PORQUE EXISTEN REGISTROS QUE DEPENDE DE ELLA";
            $bandera = 0;
        }
        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;
}
sleep(1);
echo json_encode($jsonData);
?>
