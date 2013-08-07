<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>        
        <link rel="stylesheet" href="css/jquery-ui.css" />        
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>        
        <script src="js/registroTipoEmpleado.js"></script>                
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
                <div id="contents">

                    <div id="content_form">
                        <h2>Registros de Tipos de Empleados</h2>
                        <div id="id_div_form_buscar">
                            <form id="id_form_buscar_tipo_empleado" class="form-style">
                                <table width="100%" >
                                    <tr>
                                        <td width="20%">Buscar tipo de empleado por:</td>   
                                        <td width="10%">
                                            <select id="id_sel_buscar_tipo_empleado" name="sel_buscar_tipo_empleado">
                                                <option value="">Seleccione...</option>
                                                <option value="TE.Descripcion">Descripcion de Tipo Empleado</option>
                                                <option value="E.Descripcion">Descripcion Experiencia</option>
                                            </select>
                                        </td>
                                        <td width="50%">
                                            <input type="text" id="id_txt_texto_tipo_empleado" name="txt_texto_tipo_empleado">
                                        </td>
                                        <td width="5%" align="right">
                                            <input type="button" id="id_btn_buscar_tipo_empleado" name="btn_buscar_tipo_empleado" value="Buscar">
                                        </td>
                                        <td width="17%"></td>
                                    </tr>
                                </table>
                            </form>
                            <div id="id_result_busqueda_tipo_empleado" align="center" style="overflow-y:auto; "></div>
                        </div>
                        <div id="id_div_form_registrar">

                            <form id="id_registrar_tipo_empleado" class="form-style">
                                <table width="100%">
                                    <tr>
                                        <td width="25%">Experiencia (*):</td>
                                        <td width="45%">
                                            <select id="id_sel_experiencia_tipo_empleado" name="sel_experiencia_tipo_empleado">
                                                <option value="">Seleccione..</option>
                                                <?php
                                                $query = mysql_query("SELECT * FROM experiencia ORDER BY Descripcion ASC", $connection);

                                                while ($row = mysql_fetch_array($query)) {
                                                    ?>
                                                    <option value="<?php echo $row['idExperiencia']; ?>"><?php echo $row['Descripcion']; ?></option>
                                                    <?php
                                                }
                                                ?>                                       
                                            </select>
                                        </td>        
                                        <td width="30%" aling="left"></td>
                                    </tr>  
                                    <tr>
                                        <td width="25%">Descripcion (*):</td>
                                        <td width="45%">
                                            <input type="hidden" id="id_hidden_cod_tipo_empleado" name="hidden_cod_tipo_empleado">
                                            <input type="text" id="id_txt_nombre_tipo_empleado" name="txt_nombre_tipo_empleado">
                                        </td>        
                                        <td width="30%" aling="left"></td>
                                    </tr>                                                                   
                                    <tr>
                                        <td></td>
                                        <td align="right">                                        
                                            <input type="button" id="id_btn_add_tipo_empleado" name="btn_add_tipo_empleado" value="Agregar">
                                            <input type="button" id="id_btn_update_tipo_empleado" name="btn_update_tipo_empleado" value="Modificar" style="display: none">
                                            <input type="button" id="id_btn_delete_tipo_empleado" name="btn_delete_tipo_empleado" value="Eliminar" style="display: none">
                                            <input type="button" id="id_btn_clean_tipo_empleado" name="btn_clean_tipo_empleado" value="Limpiar">
                                            <input type="button" id="id_btn_cancel_tipo_empleado" name="btn_cancel_tipo_empleado" value="Cancelar" style="display: none">
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
