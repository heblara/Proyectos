<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>
        <!--CALENDARIO JQUERY -->
        <link rel="stylesheet" href="css/jquery-ui.css" />
        <link rel="stylesheet" href="js/loading/css/showLoading.css" />
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>        
        <script src="js/registroUsuario.js"></script>        
        <script src="js/loading/js/jquery.showLoading.js"></script>        
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
                    <h2>Registros de Usuarios</h2>
                    <div id="id_div_form_buscar">
                        <form id="id_form_buscar_usuario" class="form-style">
                            <table width="100%" >
                                <tr>
                                    <td width="18%">Buscar empleado por:</td>
                                    <td width="10%">
                                        <select id="id_sel_buscar_empleado" name="sel_buscar_empleado">
                                            <option value="">Seleccione...</option>
                                            <option value="Apellidos">Apellido</option>
                                            <option value="Nombres">Nombre</option>
                                            <option value="DUI">DUI</option>
                                            <option value="NIT">NIT</option>
                                        </select>
                                    </td>
                                    <td width="50%">
                                        <input type="text" id="id_txt_texto_empleado" name="txt_texto_empleado">
                                    </td>
                                    <td width="5%" align="right">
                                        <input type="button" id="id_btn_buscar_empleado" name="btn_buscar_empleado" value="Buscar">
                                    </td>
                                    <td width="17%"></td>
                                </tr>
                            </table>
                        </form>
                        <div id="id_result_busqueda_usuario" align="center"></div>
                    </div>
                    <div id="id_div_form__registrar" style="display: none">

                        <form id="id_registrar_usuario" class="form-style">
                            <table width="100%">
                                <tr>
                                    <td width="25%">Nombre de empleado:</td>
                                    <td width="45%">
                                        <input type="hidden" id="id_hidden_cod_empleado" name="hidden_cod_empleado">
                                        <input type="text" id="id_txt_nombre_empleado_usuario" name="txt_nombre_empleado_usuario" readonly="true">
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td>Nombre de usuario (*):</td>
                                    <td>
                                        <input type="text" id="id_txt_nick_usuario" name="txt_nick_usuario">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Contrase&ntilde;a (*):</td>
                                    <td>
                                        <input type="password" id="id_txt_password_usuario" name="txt_password_usuario">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Confirmacion de Contrase&ntilde;a (*):</td>
                                    <td>
                                        <input type="password" id="id_txt_confirm_password_usuario" name="txt_confirm_password_usuario">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Privilegios (*):</td>
                                    <td>
                                        <select id="id_sel_privilegio_usuario" name="sel_privilegio_usuario">
                                            <option value="">Seleccione..</option>
                                            <?php
                                            $query = mysql_query("SELECT * FROM nivelconfianza ORDER BY Descripcion ASC", $connection);

                                            while ($row = mysql_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['idNivelConfianza']; ?>"><?php echo $row['Descripcion']; ?></option>
                                                <?php
                                            }
                                            ?>                                       
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Estado Activo:</td>
                                    <td>
                                        <input type="checkbox" id="id_ckd_estado_usuario" name="ckd_estado_usuario">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="right">                                        
                                        <input type="button" id="id_btn_add_usuario" name="btn_add_usuario" value="Agregar">
                                        <input type="button" id="id_btn_update_usuario" name="btn_update_usuario" value="Modificar" style="display: none">
                                        <input type="button" id="id_btn_delete_usuario" name="btn_delete_usuario" value="Eliminar" style="display: none">
                                        <input type="button" id="id_btn_clean_usuario" name="btn_clean_usaurio" value="Limpiar">
                                        <input type="button" id="id_btn_cancel_usuario" name="btn_cancel_usaurio" value="Cancelar">
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
