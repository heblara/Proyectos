<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>        
        <link rel="stylesheet" href="css/jquery-ui.css" />        
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>        
        <script src="js/registroEntradas.js"></script>                
        <?php
        include("header.php");
        require("data.php");
        ?>

        <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
    </head>

    <body class="home">
        <!-- WRAPPER -->
        <div id="wrapper">	
            <?php include("baner.php") ?>	
            <!-- MAIN -->
            <div id="main">

                <!-- content --><!-- ENDS content -->

                <!-- Twitter -->
                <div id="twitter">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>                    
                    <p>&nbsp;</p>
                </div>
                <!-- ENDS Twitter -->


            </div>
            <!-- ENDS MAIN -->

            <!-- FOOTER -->
            <div id="footer">
                <div id="content_form">
                    <h2>Registros de Linea</h2>
                    <div id="id_div_form_buscar">
                        <form id="id_form_buscar_entradas" class="form-style">
                            <table width="100%" >
                                <tr>
                                    <td width="18%">Buscar entradas por fecha de compra:</td>                                    
                                    <td width="50%">
                                        <input type="text" id="id_txt_texto_entradas" name="txt_texto_entradas">
                                    </td>
                                    <td width="5%" align="right">
                                        <input type="button" id="id_btn_buscar_entradas" name="btn_buscar_entradas" value="Buscar">
                                    </td>
                                    <td width="17%"></td>
                                </tr>
                            </table>
                        </form>
                        <div id="id_result_busqueda_entradas" align="center" style="overflow-y:auto; "></div>
                    </div>
                    <div id="id_div_form_registrar">

                        <form id="id_registrar_entradas" class="form-style">
                            <table width="100%">
                                <tr>
                                    <td>Proveedores (*):</td>
                                    <td>
                                        <select id="id_sel_proveedores_entradas" name="sel_proveedores_entradas">
                                            <option value="">Seleccione..</option>
                                            <?php
                                            $query = mysql_query("SELECT * FROM Proveedores ORDER BY NombreProveedor ASC", $connection);

                                            while ($row = mysql_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['idProveedor']; ?>"><?php echo $row['NombreProveedor']; ?></option>
                                                <?php
                                            }
                                            ?>                                       
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="25%">Fecha de compra (*):</td>
                                    <td width="45%">
                                        <input type="hidden" id="id_hidden_cod_entradas" name="hidden_cod_entradas">
                                        <input type="text" id="id_txt_fecha_compra_entradas" name="txt_fecha_compra_entradas"> 
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td width="25%">Cantidad de Producto (*):</td>
                                    <td width="45%">                                        
                                        <input type="text" id="id_txt_cantidad_producto_entradas" name="txt_cantidad_producto_entradas"> 
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td width="25%">Valor de Producto (*):</td>
                                    <td width="45%">                                        
                                        <input type="text" id="id_txt_valor_producto_entradas" name="txt_valor_producto_entradas"> 
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td width="25%">Porcentaje IVA (*):</td>
                                    <td width="45%">                                        
                                        <input type="text" id="id_txt_porcentaje_entradas" name="txt_porcentaje_entradas"> 
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td width="25%">Calculo IVA (*):</td>
                                    <td width="45%">                                        
                                        <input type="text" id="id_txt_calculo_iva_entradas" name="txt_calculo_iva_entradas"> 
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td width="25%">Stock Minimo (*):</td>
                                    <td width="45%">                                        
                                        <input type="text" id="id_txt_stock_minimo_entradas" name="txt_stock_minimo_entradas"> 
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td width="25%">Stock Maximo (*):</td>
                                    <td width="45%">                                        
                                        <input type="text" id="id_txt_stock_maximo_entradas" name="txt_stock_maximo_entradas"> 
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td width="25%">Stock Maximo (*):</td>
                                    <td width="45%">                                        
                                        <input type="checkbox" id="id_ckd_anulada_entradas" name="ckd_anulada_entradas"> 
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="right">                                        
                                        <input type="button" id="id_btn_add_entradas" name="btn_add_entradas" value="Agregar">
                                        <input type="button" id="id_btn_update_entradas" name="btn_update_entradas" value="Modificar" style="display: none">
                                        <input type="button" id="id_btn_delete_entradas" name="btn_delete_entradas" value="Eliminar" style="display: none">
                                        <input type="button" id="id_btn_clean_entradas" name="btn_clean_entradas" value="Limpiar">
                                        <input type="button" id="id_btn_cancel_entradas" name="btn_cancel_entradas" value="Cancelar" style="display: none">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><span style="color: #FFD800">Son campos requeridos (*)</span></td>
                                </tr>
                            </table>                        
                        </form>                        
                    </div>

                </div>
                <div id="dialog"></div>

                <!-- footer-cols -->				<!-- ENDS footer-cols -->
                <div id="bottom">
                    <?php include("bottom.php") ?>
                </div>

                <!-- ENDS Bottom -->
            </div>
            <!-- ENDS FOOTER -->

        </div>
        <!-- ENDS WRAPPER -->


</html>
