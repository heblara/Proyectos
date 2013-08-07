<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_tipo_proyecto = isset($_POST['hidden_cod_tipo_proyecto']) ? $_POST['hidden_cod_tipo_proyecto'] : '';
$nombre = isset($_POST['txt_nombre_tipo_proyecto']) ? $_POST['txt_nombre_tipo_proyecto'] : '';
$descripcion = isset($_POST['texta_descripcion_tipo_proyecto']) ? $_POST['texta_descripcion_tipo_proyecto'] : '';


/* OPCIONES PARA LAS IMAGENES */
$destino = str_replace('controlador', 'images', rtrim(dirname($_SERVER['PHP_SELF']), '/\\')) . '/proyectos/';
$server = $_SERVER['DOCUMENT_ROOT']  . $destino;
$buscarCaracteres = array(' ', 'ñ', 'Ñ', 'á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'ü');
$reemplazarCaracteres = array('_', 'n', 'N', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'U', 'u');



switch ($accion) {
    case 1: //buscar tipo_proyecto        
        $texto = isset($_POST['txt_texto_tipo_proyecto']) ? $_POST['txt_texto_tipo_proyecto'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT * FROM TipoProyecto ";
            $sql.="WHERE Nombre like '%" . $texto . "%' ORDER BY nombre ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idTipoProyecto"],
                    "nombre" => $row["Nombre"],
                    "descripcion" => $row["Descripcion"],
                    "imagen" => $row["Imagen"]
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
        //validaciones para el archivo
        if (isset($_FILES['fil_imagen_tipo_proyecto'])) {
            $tamano = $_FILES['fil_imagen_tipo_proyecto']['size'];

            $archivo = str_replace($buscarCaracteres, $reemplazarCaracteres, $_FILES['fil_imagen_tipo_proyecto']['name']);

            $tipo = $_FILES['fil_imagen_tipo_proyecto']['type'];
            $date = date('d-m-Y_H-i-s-a');
            $name_archivo = substr($archivo, 0, -4) . "(" . $date . ")" . substr($archivo, -4);
            $name_dir = $destino . $name_archivo;
        } else {
            $name_dir = '';            
        }


        $sql = "insert into TipoProyecto (Nombre,Descripcion,Imagen) ";
        $sql.="values('" . $nombre . "','" . $descripcion . "','" . $name_dir . "')";
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            if (isset($_FILES['fil_imagen_tipo_proyecto'])) {
                copy($_FILES['fil_imagen_tipo_proyecto']['tmp_name'], $server . $name_archivo);
            }
            $mensaje = "TIPO DE PROYECTO AGREGADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR EL TIPO DE PROYECTO. INTENTE DE NUEVO ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 3: //modificando al tipo_proyecto

        if (isset($_FILES['fil_imagen_tipo_proyecto'])) {
            $tamano = $_FILES['fil_imagen_tipo_proyecto']['size'];

            $archivo = str_replace($buscarCaracteres, $reemplazarCaracteres, $_FILES['fil_imagen_tipo_proyecto']['name']);

            $tipo = $_FILES['fil_imagen_tipo_proyecto']['type'];
            $date = date('d-m-Y_H-i-s-a');
            $name_archivo = substr($archivo, 0, -4) . "(" . $date . ")" . substr($archivo, -4);
            $name_dir = $destino . $name_archivo;
        } else {
            $name_dir = '';            
        }

        $sql = "UPDATE TipoProyecto SET Nombre='" . $nombre . "',Descripcion='" . $descripcion . "'";
        if ($name_dir != "") {
            $sql.=",Imagen='" . $name_dir . "'";
        }
        $sql.=" WHERE idTipoProyecto=" . $cod_tipo_proyecto;

        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            if (isset($_FILES['fil_imagen_tipo_proyecto'])) {
                copy($_FILES['fil_imagen_tipo_proyecto']['tmp_name'], $server . $name_archivo);
            }
            $mensaje = "TIPO DE PROYECTO MODIFICADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR EL TIPO DE PROYECTO. INTENTE DE NUEVO. ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 4:
        $sql = "SELECT COUNT(*) total from Proyectos where idTipoProyecto=" . $cod_tipo_proyecto;
        $query = mysql_query($sql, $connection);        
        $row = mysql_fetch_array($query);
        if ($row['total'] == 0) {
            //eliminando al tipo_proyecto
            $sql = "DELETE FROM TipoProyecto where idTipoProyecto=" . $cod_tipo_proyecto;
            $respuesta = mysql_query($sql, $connection);
            if ($respuesta) {                
                $mensaje = "TIPO DE PROYECTO ELIMINADO";
                $bandera = 1;
            } else {
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ELIMINAR EL TIPO DE PROYECTO. INTENTE DE NUEVO";
                $bandera = 0;
            }
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR EL TIPO DE PROYECTO PORQUE EXISTEN REGISTROS QUE DEPENDE DE EL";
            $bandera = 0;
        }
        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;
}
sleep(1);
echo json_encode($jsonData);
?>
