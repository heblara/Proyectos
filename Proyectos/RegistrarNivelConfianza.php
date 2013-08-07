<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>        
        <link rel="stylesheet" href="css/jquery-ui.css" />        
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>        
        <script src="js/registroNivelConfianza.js"></script>                
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
                        <h2>Registros de Perfiles de Usuarios</h2>
                        <div id="id_div_form_buscar">
                            <form id="id_form_buscar_nivel_confianza" class="form-style">
                                <table width="100%" >
                                    <tr>
                                        <td width="20%">Buscar perfil de usuario:</td>                                       
                                        <td width="50%">
                                            <input type="text" id="id_txt_texto_nivel_confianza" name="txt_texto_nivel_confianza">
                                        </td>
                                        <td width="5%" align="right">
                                            <input type="button" id="id_btn_buscar_nivel_confianza" name="btn_buscar_nivel_confianza" value="Buscar">
                                        </td>
                                        <td width="17%"></td>
                                    </tr>
                                </table>
                            </form>
                            <div id="id_result_busqueda_nivel_confianza" align="center" style="overflow-y:auto; "></div>
                        </div>
                        <div id="id_div_form_registrar">

                            <form id="id_registrar_nivel_confianza" class="form-style">
                                <table width="100%">
                                    <tr>
                                        <td width="25%">Descripcion (*):</td>
                                        <td width="45%">
                                            <input type="hidden" id="id_hidden_cod_nivel_confianza" name="hidden_cod_nivel_confianza">
                                            <input type="text" id="id_txt_nombre_nivel_confianza" name="txt_nombre_nivel_confianza">
                                        </td>        
                                        <td width="30%" aling="left"></td>
                                    </tr>                                                                   
                                    <tr>
                                        <td></td>
                                        <td align="right">                                        
                                            <input type="button" id="id_btn_add_nivel_confianza" name="btn_add_nivel_confianza" value="Agregar">
                                            <input type="button" id="id_btn_update_nivel_confianza" name="btn_update_nivel_confianza" value="Modificar" style="display: none">
                                            <input type="button" id="id_btn_delete_nivel_confianza" name="btn_delete_nivel_confianza" value="Eliminar" style="display: none">
                                            <input type="button" id="id_btn_clean_nivel_confianza" name="btn_clean_nivel_confianza" value="Limpiar">
                                            <input type="button" id="id_btn_cancel_nivel_confianza" name="btn_cancel_nivel_confianza" value="Cancelar" style="display: none">
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
