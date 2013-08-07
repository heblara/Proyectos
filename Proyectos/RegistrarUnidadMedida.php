<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>        
        <link rel="stylesheet" href="css/jquery-ui.css" />        
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>        
        <script src="js/registroUnidadMedida.js"></script>                
        <?php
        include("header.php");
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
                <div id="contents">

                    <div id="content_form">
                        <h2>Registros de Unidades de Medida</h2>
                        <div id="id_div_form_buscar">
                            <form id="id_form_buscar_unidad_medida" class="form-style">
                                <table width="100%" >
                                    <tr>
                                        <td width="20%">Buscar Unidad de Medida:</td>                                       
                                        <td width="50%">
                                            <input type="text" id="id_txt_texto_unidad_medida" name="txt_texto_unidad_medida">
                                        </td>
                                        <td width="5%" align="right">
                                            <input type="button" id="id_btn_buscar_unidad_medida" name="btn_buscar_unidad_medida" value="Buscar">
                                        </td>
                                        <td width="17%"></td>
                                    </tr>
                                </table>
                            </form>
                            <div id="id_result_busqueda_unidad_medida" align="center" style="overflow-y:auto; "></div>
                        </div>
                        <div id="id_div_form_registrar">

                            <form id="id_registrar_unidad_medida" class="form-style">
                                <table width="100%">
                                    <tr>
                                        <td width="25%">Descripcion (*):</td>
                                        <td width="45%">
                                            <input type="hidden" id="id_hidden_cod_unidad_medida" name="hidden_cod_unidad_medida">
                                            <input type="text" id="id_txt_nombre_unidad_medida" name="txt_nombre_unidad_medida">
                                        </td>        
                                        <td width="30%" aling="left"></td>
                                    </tr>                                                                   
                                    <tr>
                                        <td></td>
                                        <td align="right">                                        
                                            <input type="button" id="id_btn_add_unidad_medida" name="btn_add_unidad_medida" value="Agregar">
                                            <input type="button" id="id_btn_update_unidad_medida" name="btn_update_unidad_medida" value="Modificar" style="display: none">
                                            <input type="button" id="id_btn_delete_unidad_medida" name="btn_delete_unidad_medida" value="Eliminar" style="display: none">
                                            <input type="button" id="id_btn_clean_unidad_medida" name="btn_clean_unidad_medida" value="Limpiar">
                                            <input type="button" id="id_btn_cancel_unidad_medida" name="btn_cancel_unidad_medida" value="Cancelar" style="display: none">
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
                </div>

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
