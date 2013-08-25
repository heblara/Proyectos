<?php

require("../data.php");
session_start();
$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_entradas = isset($_POST['hidden_cod_entradas']) ? $_POST['hidden_cod_entradas'] : '';
$sel_proveedores_entradas = isset($_POST['sel_proveedores_entradas']) ? $_POST['sel_proveedores_entradas'] : '';
$txt_fecha_compra_entradas = isset($_POST['txt_fecha_compra_entradas']) ? $_POST['txt_fecha_compra_entradas'] : '';
$txt_cantidad_producto_entradas = isset($_POST['txt_cantidad_producto_entradas']) ? $_POST['txt_cantidad_producto_entradas'] : '';
$txt_valor_producto_entradas = isset($_POST['txt_valor_producto_entradas']) ? $_POST['txt_valor_producto_entradas'] : '';
$txt_porcentaje_entradas = isset($_POST['txt_porcentaje_entradas']) ? $_POST['txt_porcentaje_entradas'] : '';
$txt_descripcion_entradas = isset($_POST['txt_descripcion_entradas']) ? $_POST['txt_descripcion_entradas'] : '';
$txt_calculo_iva_entradas = isset($_POST['txt_calculo_iva_entradas']) ? $_POST['txt_calculo_iva_entradas'] : '';
$txt_stock_minimo_entradas = isset($_POST['txt_stock_minimo_entradas']) ? $_POST['txt_stock_minimo_entradas'] : '';
$txt_stock_maximo_entradas = isset($_POST['txt_stock_maximo_entradas']) ? $_POST['txt_stock_maximo_entradas'] : '';
$ckd_anulada_entradas = isset($_POST['ckd_anulada_entradas']) ? $_POST['ckd_anulada_entradas'] : 0;


switch ($accion) {
    case 1: //buscar personal
        $array_data = array();
        $texto1 = isset($_POST['txt_texto_ini_entradas']) ? $_POST['txt_texto_ini_entradas'] : '';
        $texto2 = isset($_POST['txt_texto_fin_entradas']) ? $_POST['txt_texto_fin_entradas'] : '';

        if ($texto1 != '' || $texto2 != '') {

            $sql = "select * from entradas ";
            $sql.="where FechaCompra BETWEEN '" . $texto1 . " 00:00:00' AND '" . $texto2 . " 23:59:59' order by FechaCompra asc";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idEntradas"],
                    "idProveedor" => $row["idProveedor"],
                    "Descripcion" => $row["Descripcion"],
                    "FechaCompra" => $row["FechaCompra"],
                    "CantidadProducto" => $row["CantidadProducto"],
                    "ValorProducto" => $row["ValorProducto"],
                    "PorcentajeIVA" => $row["PorcentajeIVA"],
                    "CalculoIVA" => $row["CalculoIVA"],
                    "StockMinimo" => $row["StockMinimo"],
                    "StockMaximo" => $row["StockMaximo"],
                    "Anulada" => $row["Anulada"]
                );
                $i++;
            }
            if($_SESSION["idioma"]=="es"){
                $jsonData["mensaje"] = "RECUPERANDO DATOS";
            }else{ 
                $jsonData["mensaje"] = "RETREIVING DATA ";
            }
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

        $sql = "insert into Entradas (idProveedor,Descripcion,FechaCompra,CantidadProducto,ValorProducto,PorcentajeIVA,CalculoIVA,StockMinimo,StockMaximo,Anulada) ";
        $sql.="values(" . $sel_proveedores_entradas . ",'".$txt_descripcion_entradas."','" . $txt_fecha_compra_entradas . "'," . $txt_cantidad_producto_entradas . ",'" . $txt_valor_producto_entradas . "',";
        $sql.="" . $txt_porcentaje_entradas . ",'" . $txt_calculo_iva_entradas . "'," . $txt_stock_minimo_entradas . "," . $txt_stock_maximo_entradas . "," . $ckd_anulada_entradas . ")";
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "ENTRADA AGREGADA";
            $bandera = 1;
        } else {
            if($_SESSION["idioma"]=="es"){
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR LA ENTRADA. INTENTE DE NUEVO ";
            }else{ 
                $mensaje = "AN ERROR HAS OCURRED AT THE MOMENT  OF ADD THE ENTRY. PLEASE TRY AGAIN";
            }
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;

    case 3: //modificando la entradas


        $sql = "UPDATE Entradas SET Descripcion='".$txt_descripcion_entradas."', FechaCompra='" . $txt_fecha_compra_entradas . "',";
        $sql.="CantidadProducto=" . $txt_cantidad_producto_entradas . ",ValorProducto='" . $txt_valor_producto_entradas . "',";
        $sql.="PorcentajeIVA=" . $txt_porcentaje_entradas . ",CalculoIVA='" . $txt_calculo_iva_entradas . "',";
        $sql.="StockMinimo=" . $txt_stock_minimo_entradas . ",StockMaximo=" . $txt_stock_maximo_entradas . ",Anulada=" . $ckd_anulada_entradas;
        $sql.=" WHERE idProveedor=" . $cod_entradas;
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            if($_SESSION["idioma"]=="es"){
                $mensaje = "ENTRADA MODIFICADA";
            }else{ 
                $mensaje = "ENTRY UPDATED";
            }
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR LA ENTRADA. INTENTE DE NUEVO. " . $sql;
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;

    case 4: //eliminando entradas

        $sql = "delete from Entradas where idEntradas=" . $cod_entradas;
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "ENTRADA ELIMINADA";
            $bandera = 1;
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR LA ENTRADA PORQUE HAY REGISTROS QUE DEPENDEN DE ELLA.";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;
}

echo json_encode($jsonData);
?>
