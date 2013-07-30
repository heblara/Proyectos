<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$descripcion = isset($_POST['texta_descripcion_linea']) ? $_POST['texta_descripcion_linea'] : '';
$idUnidad = isset($_POST['sel_unidad_linea']) ? $_POST['sel_unidad_linea'] : '';
$cod_linea = isset($_POST['hidden_cod_linea']) ? $_POST['hidden_cod_linea'] : '';


switch ($accion) {
    case 1: //buscar personal
        $array_data = array();
        $texto = isset($_POST['txt_texto_linea']) ? $_POST['txt_texto_linea'] : '';
        $opc = isset($_POST['sel_buscar_linea']) ? $_POST['sel_buscar_linea'] : '';



        if ($texto != '' || $opc != '') {

            $sql = "select l.idLineas,l.Descripcion Linea, u.idUnidad, u.Descripcion Unidad from Lineas l ";
            $sql.="inner join Unidad u on l.idUnidad=u.idUnidad ";
            $sql.="where " . $opc . " like '%" . $texto . "%' order by l.Descripcion asc";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idLineas"],
                    "idUnidad" => $row["idUnidad"],
                    "label_unidad" => $row["Unidad"],
                    "descripcion" => $row["Linea"]
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

        $sql = "insert into Linea (idUnidad,Descripcion) ";
        $sql.="values(" . $idUnidad . ",'" . $descripcion . "')";
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "LINEA AGREGADA";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR LA NUEVA LINEA. INTENTE DE NUEVO ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;

    case 3: //modificando la linea


        $sql = "UPDATE Lineas SET Descripcion='" . $descripcion . "', idUnidad=" . $idUnidad . " WHERE idLineas=" . $cod_linea;
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "LINEA MODIFICADA";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR LA LINEA. INTENTE DE NUEVO.";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;

    case 4: //eliminando linea
        $sql = "SELECT COUNT(*) total from Especifico where idLinea=" . $cod_linea;
        $query = mysql_query($sql, $connection);
        $row = mysql_fetch_array($query);
        if ($row['total'] == 0) {
            $sql = "delete from Lineas where idLineas=" . $cod_linea;
            $respuesta = mysql_query($sql, $connection);
            if ($respuesta) {
                $mensaje = "LINEA ELIMINADA";
                $bandera = 1;
            } else {
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ELIMINAR LA LINEA. INTENTE DE NUEVO ";
                $bandera = 0;
            }
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR LA LINEA PORQUE HAY REGISTROS QUE DEPENDEN DE ELLA.";
            $bandera = 0;
        }


        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;
}

echo json_encode($jsonData);
?>
