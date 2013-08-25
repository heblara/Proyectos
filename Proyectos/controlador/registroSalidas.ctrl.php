<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_salidas = isset($_POST['hidden_cod_salidas']) ? $_POST['hidden_cod_salidas'] : '';
$hidden_cod_empleado_salidas = isset($_POST['hidden_cod_empleado_salidas']) ? $_POST['hidden_cod_empleado_salidas'] : '';
$hidden_cod_proyecto_salidas = isset($_POST['hidden_cod_proyecto_salidas']) ? $_POST['hidden_cod_proyecto_salidas'] : '';
$txt_descripcion_salidas = isset($_POST['txt_descripcion_salidas']) ? $_POST['txt_descripcion_salidas'] : '';
$txt_cantidad_salidas = isset($_POST['txt_cantidad_salidas']) ? $_POST['txt_cantidad_salidas'] : '';

$txt_fecha_salidas = isset($_POST['txt_fecha_salidas']) ? $_POST['txt_fecha_salidas'] : '';

switch ($accion) {
    case 1: //buscar personal
        $array_data = array();
        $texto1 = isset($_POST['txt_texto_ini_salidas']) ? $_POST['txt_texto_ini_salidas'] : '';
        $texto2 = isset($_POST['txt_texto_fin_salidas']) ? $_POST['txt_texto_fin_salidas'] : '';
        $nombre = isset($_POST['txt_texto_nombre']) ? $_POST['txt_texto_nombre'] : '';

        $opc = isset($_POST['sel_opc_buscar']) ? $_POST['sel_opc_buscar'] : '';


        $sql = "SELECT s.*,CONCAT(pe.Nombres,' ',pe.Apellidos) nom,p.NombreProyecto FROM salidas s ";
        $sql.=" INNER JOIN Proyectos p ";
        $sql.=" ON s.idProyecto=p.idProyectos ";
        $sql.=" INNER JOIN Personal pe ";
        $sql.=" ON s.idPersonal=pe.idPersonal ";
        if ($opc == 1) {
            $sql.="where s.FechaSalida BETWEEN '" . $texto1 . " 00:00:00' AND '" . $texto2 . " 23:59:59' order by s.FechaSalida asc";
        } else if ($opc == 2) {
            $sql.="where p.NombreProyecto like '%" . $nombre . "%' order by p.NombreProyecto asc";
        } else if ($opc == 3) {
            $sql.="where pe.Nombres like '%" . $nombre . "%' OR pe.Apellidos like'%" . $nombre . "%' order by pe.Nombres,pe.Apellidos asc";
        }



        $query = mysql_query($sql, $connection);
        $i = 0;
        while ($row = mysql_fetch_array($query)) {
            $array_data[$i] = array(
                "id" => $row["idSalidas"],
                "idPersonal" => $row["idPersonal"],
                "idProyecto" => $row["idProyecto"],
                "CantidadUtilizada" => $row["CantidadUtilizada"],
                "FechaSalida" => $row["FechaSalida"],
                "nom" => $row["nom"],
                "NombreProyecto" => $row["NombreProyecto"]
            );
            $i++;
        }
        $jsonData["mensaje"] = "RECUPERANDO DATOS";
        $jsonData["bandera"] = 1;
        $jsonData["total_rows"] = $i;
        $jsonData["rows"] = $array_data;

        sleep(1);
        break;

    case 2:

        $texto = isset($_POST['txt_buscar_empleado']) ? $_POST['txt_buscar_empleado'] : '';
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
        $texto = isset($_POST['txt_buscar_proyecto']) ? $_POST['txt_buscar_proyecto'] : '';
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

        sleep(1);
        break;
    case 4: //adicionando un nuevo registro

        $sql = "insert into salidas (idPersonal,idProyecto,Descripcion,CantidadUtilizada,FechaSalida) ";
        $sql.="values(" . $hidden_cod_empleado_salidas . "," . $hidden_cod_proyecto_salidas . ",'".$txt_descripcion_salidas."'," . $txt_cantidad_salidas . ",'" . $txt_fecha_salidas . "')";
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "SALIDA AGREGADA";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR LA SALIDA. INTENTE DE NUEVO ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;

    case 5: //modificando la salidas


        $sql = "UPDATE Salidas SET idPersonal=" . $hidden_cod_empleado_salidas . ",";
        $sql.="idProyecto=" . $hidden_cod_proyecto_salidas . ",CantidadUtilizada=" . $txt_cantidad_salidas . ",";
        $sql.="FechaSalida='" . $txt_fecha_salidas . "'";
        $sql.=" WHERE idSalidas=" . $cod_salidas;
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "SALIDA MODIFICADA";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR LA SALIDA. INTENTE DE NUEVO. " . $sql;
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;

    case 6: //eliminando salidas

        $sql = "delete from Salidas where idSalidas=" . $cod_salidas;
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "SALIDA ELIMINADA";
            $bandera = 1;
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR LA SALIDA PORQUE HAY REGISTROS QUE DEPENDEN DE ELLA.";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;
}

echo json_encode($jsonData);
?>
