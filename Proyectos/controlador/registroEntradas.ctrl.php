<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$descripcion = isset($_POST['texta_descripcion_entradas']) ? $_POST['texta_descripcion_entradas'] : '';
$idUnidad = isset($_POST['sel_unidad_entradas']) ? $_POST['sel_unidad_entradas'] : '';
$cod_entradas = isset($_POST['hidden_cod_entradas']) ? $_POST['hidden_cod_entradas'] : '';


switch ($accion) {
    case 1: //buscar personal
        $array_data = array();
        $texto = isset($_POST['txt_texto_entradas']) ? $_POST['txt_texto_entradas'] : '';
        $opc = isset($_POST['sel_buscar_entradas']) ? $_POST['sel_buscar_entradas'] : '';



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
        mysql_query("SET NAMES 'utf8'");
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

    case 3: //modificando la entradas


        $sql = "UPDATE Lineas SET Descripcion='" . $descripcion . "', idUnidad=" . $idUnidad . " WHERE idLineas=" . $cod_entradas;
        mysql_query("SET NAMES 'utf8'");
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

    case 4: //eliminando entradas
        $sql = "SELECT COUNT(*) total from Especifico where idLinea=" . $cod_entradas;
        $query = mysql_query($sql, $connection);
        $row = mysql_fetch_array($query);
        if ($row['total'] == 0) {
            $sql = "delete from Lineas where idLineas=" . $cod_entradas;
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
