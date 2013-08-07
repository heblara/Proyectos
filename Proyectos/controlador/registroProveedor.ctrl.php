<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_proveedor = isset($_POST['hidden_cod_proveedor']) ? $_POST['hidden_cod_proveedor'] : '';
$nombre = isset($_POST['txt_nombre_proveedor']) ? $_POST['txt_nombre_proveedor'] : '';
$nit = isset($_POST['txt_nit_proveedor']) ? $_POST['txt_nit_proveedor'] : '';
$razon = isset($_POST['texta_razon_proveedor']) ? $_POST['texta_razon_proveedor'] : '';
$direccion = isset($_POST['texta_direccion_proveedor']) ? $_POST['texta_direccion_proveedor'] : '';
$telefonos = isset($_POST['texta_telefonos_proveedor']) ? $_POST['texta_telefonos_proveedor'] : '';


switch ($accion) {
    case 1: //buscar proveedor
        $opc = isset($_POST['sel_buscar_proveedor']) ? $_POST['sel_buscar_proveedor'] : '';
        $texto = isset($_POST['txt_texto_proveedor']) ? $_POST['txt_texto_proveedor'] : '';
        $array_data = array();
        if ($opc != '' && $texto != '') {
            $sql = "SELECT * FROM proveedores ";
            $sql.="WHERE " . $opc . " like '%" . $texto . "%' ORDER BY NombreProveedor ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idProveedor"],
                    "nombre" => $row["NombreProveedor"],
                    "nit" => $row["NIT"],
                    "razon" => $row["RazonSocial"],
                    "direccion" => $row["Direccion"],
                    "telefonos" => $row["Telefonos"]
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

        $sql = "insert into Proveedores (NombreProveedor, NIT, RazonSocial, Direccion, Telefonos) ";
        $sql.="values('" . $nombre . "','" . $nit . "','" . $razon . "','" . $direccion . "','" . $telefonos . "')";
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PROVEEDOR AGREGADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR AL NUEVO PROVEEDOR. INTENTE DE NUEVO " . $sql;
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 3: //modificando al proveedor
        $sql = "UPDATE proveedores SET NombreProveedor='" . $nombre . "', NIT='" . $nit . "',";

        if ($razon <> "") {
            $sql .= "RazonSocial='" . $razon."',";
        }
        $sql.="Direccion='" . $direccion . "', Telefonos='" . $telefonos . "' ";
        $sql.="WHERE idProveedor=" . $cod_proveedor;

        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PROVEEDOR MODIFICADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR AL PROVEEDOR. INTENTE DE NUEVO.";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 4:
        $sql = "SELECT COUNT(*) total from entradas where idProveedor=" . $cod_proveedor;
        $query = mysql_query($sql, $connection);
        $row = mysql_fetch_array($query);
        if ($row['total'] == 0) {
            //eliminando al proveedor
            $sql = "DELETE FROM proveedores where idProveedor=" . $cod_proveedor;
            $respuesta = mysql_query($sql, $connection);
            if ($respuesta) {
                $mensaje = "PROVEEDOR ELIMINADO";
                $bandera = 1;
            } else {
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ELIMINAR AL PROVEEDOR. INTENTE DE NUEVO";
                $bandera = 0;
            }
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR EL PROVEEDOR PORQUE EXISTEN REGISTROS QUE DEPENDE DE EL";
            $bandera = 0;
        }
        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;
}
sleep(1);
echo json_encode($jsonData);
?>
