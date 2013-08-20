<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_nivel_confianza = isset($_POST['hidden_cod_nivel_confianza']) ? $_POST['hidden_cod_nivel_confianza'] : '';
$nombre = isset($_POST['txt_nombre_nivel_confianza']) ? $_POST['txt_nombre_nivel_confianza'] : '';



switch ($accion) {
    case 1: //buscar nivel_confianza        
        $texto = isset($_POST['txt_texto_nivel_confianza']) ? $_POST['txt_texto_nivel_confianza'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT * FROM NivelConfianza ";
            $sql.="WHERE Descripcion like '%" . $texto . "%' ORDER BY Descripcion ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idNivelConfianza"],
                    "nombre" => $row["Descripcion"]
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

        $sql = "insert into NivelConfianza (Descripcion) ";
        $sql.="values('" . $nombre . "')";
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PERFIL DE USUARIO AGREGADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR EL NUEVO PERFIL DE USUARIO. INTENTE DE NUEVO ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 3: //modificando al nivel_confianza
        $sql = "UPDATE NivelConfianza SET Descripcion='" . $nombre . "'";
        $sql.="WHERE idNivelConfianza=" . $cod_nivel_confianza;
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PERFIL DE USUARIO MODIFICADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR EL PERFIL DE USUARIO. INTENTE DE NUEVO.";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 4:
        $sql = "SELECT COUNT(*) total from Usuarios where idNivelConfianza=" . $cod_nivel_confianza;
        $query = mysql_query($sql, $connection);
        $row = mysql_fetch_array($query);
        if ($row['total'] == 0) {
            //eliminando al nivel_confianza
            $sql = "DELETE FROM NivelConfianza where idNivelConfianza=" . $cod_nivel_confianza;
            $respuesta = mysql_query($sql, $connection);
            if ($respuesta) {
                $mensaje = "PERFIL DE USUARIOS ELIMINADO";
                $bandera = 1;
            } else {
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ELIMINAR EL PERFIL DE USUARIO. INTENTE DE NUEVO";
                $bandera = 0;
            }
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR EL PERFIL DE USUARIO PORQUE EXISTEN REGISTROS QUE DEPENDE DE EL";
            $bandera = 0;
        }
        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;
}
sleep(1);
echo json_encode($jsonData);
?>
