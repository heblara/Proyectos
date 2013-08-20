<?php

require("../data.php");


$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

$idPersonal = isset($_POST['txt_idPersonal']) ? $_POST['txt_idPersonal'] : '';
$idProyecto = isset($_POST['txt_idProyecto']) ? $_POST['txt_idProyecto'] : '';



switch ($accion) {
    case 1: //buscar personal_proyecto        
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

    case 2:



        $texto = isset($_POST['txt_buscar_personal']) ? $_POST['txt_buscar_personal'] : '';
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

        $sql = "insert into Proyectos_has_Personal (idPersonal,idProyecto) ";
        $sql.="values(" . $idPersonal . "," . $idProyecto . ")";
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PERSONAL AGREGADO AL PROYECTO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR EL PERSONAL AL PROYECTO. INTENTE DE NUEVO " . $sql;
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 4:

        //eliminando al personal_proyecto
        $sql = "DELETE FROM Proyectos_has_Personal where idPersonal=" . $idPersonal . " AND idProyecto=" . $idProyecto;
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PERSONAL ELIMINADO DEL PROYECTO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ELIMINAR EL PERSONAL. INTENTE DE NUEVO";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;


    case 5:

        $texto = isset($_POST['txt_id_proyecto']) ? $_POST['txt_id_proyecto'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT a.idProyecto,a.idPersonal,CONCAT(b.Nombres,' ',b.Apellidos) nom from Proyectos_has_Personal a ";
            $sql.=" INNER JOIN Personal b ";
            $sql.=" ON a.idPersonal=b.idPersonal ";
            $sql.="WHERE a.idProyecto=" . $texto;

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idPersonal"],
                    "nombre" => $row["nom"],
                    "idProyecto" => $row["idProyecto"]
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
