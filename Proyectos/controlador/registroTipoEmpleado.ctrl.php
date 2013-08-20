<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_tipo_empleado = isset($_POST['hidden_cod_tipo_empleado']) ? $_POST['hidden_cod_tipo_empleado'] : '';
$nombre = isset($_POST['txt_nombre_tipo_empleado']) ? $_POST['txt_nombre_tipo_empleado'] : '';
$idExperiencia = isset($_POST['sel_experiencia_tipo_empleado']) ? $_POST['sel_experiencia_tipo_empleado'] : '';


switch ($accion) {
    case 1: //buscar tipo_empleado        
        $texto = isset($_POST['txt_texto_tipo_empleado']) ? $_POST['txt_texto_tipo_empleado'] : '';
        $opc = isset($_POST['sel_buscar_tipo_empleado']) ? $_POST['sel_buscar_tipo_empleado'] : '';
        $array_data = array();
        if ($texto != '' && $opc != '') {
            $sql = "SELECT TE.idTipoEmpleado,TE.idExperiencia,TE.Descripcion,E.Descripcion Expe";
            $sql.=" FROM TipoEmpleado TE ";
            $sql.="INNER JOIN Experiencia E ";
            $sql.="ON TE.idExperiencia=E.idExperiencia ";
            $sql.="WHERE " . $opc . " like '%" . $texto . "%' ORDER BY TE.Descripcion ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idTipoEmpleado"],
                    "idExperiencia" => $row["idExperiencia"],
                    "descripcion" => $row["Descripcion"],
                    "experiencia" => $row["Expe"]
                );
                $i++;
            }


            $jsonData["mensaje"] = "RECUPERANDO DATOS";
            $jsonData["bandera"] = 1;
            $jsonData["total_rows"] = $i;
            $jsonData["rows"] = $array_data;
        } else {
            $jsonData["mensaje"] = "FALTAN CAMPOS POR LLENAR " . $texto;
            $jsonData["bandera"] = 0;
        }

        sleep(1);
        break;

    case 2: //adicionando un nuevo registro

        $sql = "insert into TipoEmpleado (idExperiencia,Descripcion) ";
        $sql.="values(" . $idExperiencia . ",'" . $nombre . "')";
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "TIPO DE EMPLEADO AGREGADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR EL TIPO DE EMPLEADO. INTENTE DE NUEVO ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 3: //modificando al tipo_empleado
        $sql = "UPDATE TipoEmpleado SET Descripcion='" . $nombre . "',idExperiencia=" . $idExperiencia;
        $sql.=" WHERE idTipoEmpleado=" . $cod_tipo_empleado;
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "TIPO DE EMPLEADO MODIFICADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR EL TIPO DE EMPLEADO. INTENTE DE NUEVO. ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 4:
        $sql = "SELECT COUNT(*) total from Personal where idTipoEmpleado=" . $cod_tipo_empleado;
        $query = mysql_query($sql, $connection);
        $row = mysql_fetch_array($query);
        if ($row['total'] == 0) {
            //eliminando al tipo_empleado
            $sql = "DELETE FROM TipoEmpleado where idTipoEmpleado=" . $cod_tipo_empleado;
            $respuesta = mysql_query($sql, $connection);
            if ($respuesta) {
                $mensaje = "TIPO DE EMPLEADO ELIMINADO";
                $bandera = 1;
            } else {
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ELIMINAR EL TIPO DE EMPLEADO. INTENTE DE NUEVO";
                $bandera = 0;
            }
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR EL TIPO DE EMPLEADO PORQUE EXISTEN REGISTROS QUE DEPENDE DE EL";
            $bandera = 0;
        }
        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;
}

echo json_encode($jsonData);
?>
