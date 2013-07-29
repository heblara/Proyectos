<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>        
        <link rel="stylesheet" href="css/jquery-ui.css" />        
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>        
        <script src="js/registroProveedor.js"></script>                
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
                    <h2>Registros de Proveedores</h2>
                    <div id="id_div_form_buscar">
                        <form id="id_form_buscar_usuario" class="form-style">
                            <table width="100%" >
                                <tr>
                                    <td width="18%">Buscar proveedor por:</td>
                                    <td width="10%">
                                        <select id="id_sel_buscar_proveedor" name="sel_buscar_proveedor">
                                            <option value="">Seleccione...</option>
                                            <option value="NombreProveedor">Nombre</option>                                            
                                            <option value="NIT">NIT</option>
                                        </select>
                                    </td>
                                    <td width="50%">
                                        <input type="text" id="id_txt_texto_proveedor" name="txt_texto_proveedor">
                                    </td>
                                    <td width="5%" align="right">
                                        <input type="button" id="id_btn_buscar_proveedor" name="btn_buscar_proveedor" value="Buscar">
                                    </td>
                                    <td width="17%"></td>
                                </tr>
                            </table>
                        </form>
                        <div id="id_result_busqueda_proveedor" align="center"></div>
                    </div>
                    <div id="id_div_form_registrar">

                        <form id="id_registrar_proveedor" class="form-style">
                            <table width="100%">
                                <tr>
                                    <td width="25%">Nombre de Proveedor (*):</td>
                                    <td width="45%">
                                        <input type="hidden" id="id_hidden_cod_proveedor" name="hidden_cod_proveedor">
                                        <input type="text" id="id_txt_nombre_proveedor" name="txt_nombre_proveedor">
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td>NIT (*):</td>
                                    <td>
                                        <input type="text" id="id_txt_nit_usuario" name="txt_nit_usuario">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Razon Social:</td>
                                    <td>
                                        <textarea id="id_texta_razon_proveedor" name="texta_razon_proveedor"></textarea>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Direccion (*):</td>
                                    <td>
                                        <textarea id="id_texta_direccion_proveedor" name="texta_direccion_proveedor"></textarea>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Telefonos (*):</td>
                                    <td>
                                        <textarea id="id_texta_telefonos_proveedor" name="texta_telefonos_proveedor"></textarea>
                                    </td>
                                    <td></td>
                                </tr>                                
                                <tr>
                                    <td></td>
                                    <td align="right">                                        
                                        <input type="button" id="id_btn_add_proveedor" name="btn_add_proveedor" value="Agregar">
                                        <input type="button" id="id_btn_update_proveedor" name="btn_update_proveedor" value="Modificar" style="display: none">
                                        <input type="button" id="id_btn_delete_proveedor" name="btn_delete_proveedor" value="Eliminar" style="display: none">
                                        <input type="button" id="id_btn_clean_proveedor" name="btn_clean_proveedor" value="Limpiar">
                                        <input type="button" id="id_btn_cancel_proveedor" name="btn_cancel_proveedor" value="Cancelar" style="display: none">
                                    </td>
                                    <td></td>
                                </tr>
                            </table>                        
                        </form>
                        <span style="color: #FFD800">Son campos requeridos (*) al momento de registrar un nuevo usuario</span>
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
