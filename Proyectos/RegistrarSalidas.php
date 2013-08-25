<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>        
        <link rel="stylesheet" href="css/jquery-ui.css" />        
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>                
        <script src="js/registroSalidas.js"></script>                
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
                    <h2>Registros de Salidas</h2>
                    <div id="id_div_form_buscar">
                        <form id="id_form_buscar_salidas" class="form-style">
                            <table width="100%" >
                                <tr>
                                    <td width="18%">Buscar salidas por :</td>                                    
                                    <td width="22%">
                                        <select id="id_sel_opc_buscar" name="sel_opc_buscar">
                                            <option value="1">Rango de Fecha Salida</option>
                                            <option value="2">Nombre Proyecto</option>
                                            <option value="3">Nombre Empleado</option>
                                        </select>
                                    </td>
                                    <td width="50%">
                                        <div id="id_div_rango_fechas">
                                        <input type="text" id="id_txt_texto_ini_salidas" name="txt_texto_ini_salidas" style="width: 40%">
                                        Hasta
                                        <input type="text" id="id_txt_texto_fin_salidas" name="txt_texto_fin_salidas" style="width: 40%">
                                        </div>
                                        <div id="id_div_nombre" style="display: none">
                                            <input type="text" id="id_txt_texto_nombre" name="txt_texto_nombre">
                                        </div>
                                    </td>
                                    <td width="5%" align="right">
                                        <input type="button" id="id_btn_buscar_salidas" name="btn_buscar_salidas" value="Buscar">
                                    </td>                                    
                                </tr>
                            </table>
                        </form>
                        <div id="id_result_busqueda_salidas" align="center" style="overflow-y:auto; "></div>
                    </div>

                    <div id="id_div_form_proyecto" style="display: none">
                        <form id="id_form_buscar_proyecto" class="form-style">
                            <table width="100%" border="1" class="table-style">
                                <tr>
                                    <td width="20%">Nombre de proyecto:</td>   
                                    <td width="70%">
                                        <input type="text" id="id_txt_buscar_proyecto" name="txt_buscar_proyecto">
                                    </td>                                        
                                    <td width="10%" align="right">
                                        <input type="button" id="id_btn_buscar_proyecto" name="btn_buscar_proyecto" value="Buscar">
                                    </td>

                                </tr>
                            </table>
                        </form>
                        <div id="id_result_busqueda_proyecto" align="center" style="overflow-y:auto; "></div>
                    </div>


                    <div id="id_div_form_buscar_empleado" style="display: none">
                        <form id="id_form_buscar_empleado" class="form-style">
                            <table width="100%" border="1" class="table-style">
                                <tr>
                                    <td width="20%">Nombre de empleado:</td>   
                                    <td width="70%">
                                        <input type="text" id="id_txt_buscar_empleado" name="txt_buscar_empleado">
                                    </td>                                        
                                    <td width="10%" align="right">
                                        <input type="button" id="id_btn_buscar_empleado" name="btn_buscar_empleado" value="Buscar">
                                    </td>

                                </tr>
                            </table>
                        </form>
                        <div id="id_result_busqueda_empleado" align="center" style="overflow-y:auto; "></div>
                    </div>


                    <div id="id_div_form_registrar">

                        <form id="id_registrar_salidas" class="form-style">
                            <table width="100%">
                                <tr>
                                    <td>Nombre del personal (*):</td>
                                    <td>
                                        <input type="hidden" id="id_hidden_cod_salidas" name="hidden_cod_salidas">
                                        <input type="hidden" id="id_hidden_cod_empleado_salidas" name="hidden_cod_empleado_salidas">
                                        <input type="text" id="id_txt_nombre_empleado_salidas" name="txt_nombre_empleado_salidas" placeholder="Presione el boton buscar para seleccionar un empleado" readonly="true" style="width: 70%">
                                        <input type="button" id="id_btn_show_buscar_empleado" name="btn_show_buscar_proyecto" value="Buscar Empleado" style="float:right;position:absolute;">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="25%">Proyecto (*):</td>
                                    <td width="45%">
                                        <input type="hidden" id="id_hidden_cod_proyecto_salidas" name="hidden_cod_proyecto_salidas">
                                        <input type="text" id="id_txt_nombre_proyecto_salidas" name="txt_nombre_proyecto_salidas" placeholder="Presione el boton buscar para seleccionar un proyecto" readonly="true" style="width: 70%">
                                        <input type="button" id="id_btn_show_buscar_proyecto" name="btn_show_buscar_proyecto" value="Buscar Proyecto" style="float:right;position:absolute;">
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td width="25%">Descripcion (*):</td>
                                    <td width="45%">                                        
                                        <input type="text" id="id_txt_descripcion_salidas" name="txt_descripcion_salidas"> 
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td width="25%">Cantidad Utilizada (*):</td>
                                    <td width="45%">                                        
                                        <input type="text" id="id_txt_cantidad_salidas" name="txt_cantidad_salidas"> 
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td width="25%">Fecha Salida (*):</td>
                                    <td width="45%">                                        
                                        <input type="text" id="id_txt_fecha_salidas" name="txt_fecha_salidas"> 
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>                                
                                <tr>
                                    <td></td>
                                    <td align="right">                                        
                                        <input type="button" id="id_btn_add_salidas" name="btn_add_salidas" value="Agregar">
                                        <input type="button" id="id_btn_update_salidas" name="btn_update_salidas" value="Modificar" style="display: none">
                                        <input type="button" id="id_btn_delete_salidas" name="btn_delete_salidas" value="Eliminar" style="display: none">
                                        <input type="button" id="id_btn_clean_salidas" name="btn_clean_salidas" value="Limpiar">
                                        <input type="button" id="id_btn_cancel_salidas" name="btn_cancel_salidas" value="Cancelar" style="display: none">
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
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>


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
