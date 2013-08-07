<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_experiencia = isset($_POST['hidden_cod_experiencia']) ? $_POST['hidden_cod_experiencia'] : '';
$nombre = isset($_POST['txt_nombre_experiencia']) ? $_POST['txt_nombre_experiencia'] : '';



switch ($accion) {
    case 1: //buscar experiencia        
        $texto = isset($_POST['txt_texto_experiencia']) ? $_POST['txt_texto_experiencia'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT * FROM Experiencia ";
            $sql.="WHERE Descripcion like '%" . $texto . "%' ORDER BY Descripcion ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idExperiencia"],
                    "nombre" => $row["Descripcion"]
                );
                $i++;
            }


            $jsonData["mensaje"] = "RECUPERANDO DATOS";
            $jsonData["bandera"] = 1;
            $jsonData["total_rows"] = $i;
            $jsonData["rows"] = $array_data;
        } else {
            $jsonData["mensaje"] = "FALTAN CAMPOS POR LLENAR ".$texto;
            $jsonData["bandera"] = 0;
        }
        break;

    case 2: //adicionando un nuevo registro

        $sql = "insert into Experiencia (Descripcion) ";
        $sql.="values('" . $nombre . "')";
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "EXPERIENCIA AGREGADA";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR LA NUEVA EXPERIENCIA. INTENTE DE NUEVO ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 3: //modificando al experiencia
        $sql = "UPDATE Experiencia SET Descripcion='" . $nombre . "'";
        $sql.="WHERE idExperiencia=" . $cod_experiencia;

        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "EXPERIENCIA MODIFICADA";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR LA EXPERIENCIA. INTENTE DE NUEVO.";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 4:
        $sql = "SELECT COUNT(*) total from TipoEmpleado where idExperiencia=" . $cod_experiencia;
        $query = mysql_query($sql, $connection);
        $row = mysql_fetch_array($query);
        if ($row['total'] == 0) {
            //eliminando al experiencia
            $sql = "DELETE FROM Experiencia where idExperiencia=" . $cod_experiencia;
            $respuesta = mysql_query($sql, $connection);
            if ($respuesta) {
                $mensaje = "EXPERIENCIA ELIMINADA";
                $bandera = 1;
            } else {
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ELIMINAR LA EXPERIENCIA. INTENTE DE NUEVO";
                $bandera = 0;
            }
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR LA EXPERIENCIA PORQUE EXISTEN REGISTROS QUE DEPENDE DE ELLA";
            $bandera = 0;
        }
        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;
}
sleep(1);
echo json_encode($jsonData);
?>
