<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>        
        <link rel="stylesheet" href="css/jquery-ui.css" />        
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>             
        <script src="js/money/jquery.price_format.1.8.min.js"></script>
        <script src="js/registroProyecto.js"></script>                
        <?php
        include("header.php");
        ?>

        <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
    </head>

    <body class="home">
        <!-- WRAPPER -->
        <div id="wrapper">	
            <?php
            include("baner.php");
            require("data.php");
            ?>	
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
                        <h2>Registros de Proyectos</h2>
                        <div id="id_div_form_buscar">
                            <form id="id_form_buscar_proyecto" class="form-style">
                                <table width="100%" >
                                    <tr>
                                        <td width="20%">Buscar proyecto:</td>   
                                        <td width="50%">
                                            <input type="text" id="id_txt_texto_proyecto" name="txt_texto_proyecto">
                                        </td>
                                        <td width="5%" align="right">
                                            <input type="button" id="id_btn_buscar_proyecto" name="btn_buscar_proyecto" value="Buscar">
                                        </td>
                                        <td width="17%"></td>
                                    </tr>
                                </table>
                            </form>
                            <div id="id_result_busqueda_proyecto" align="center" style="overflow-y:auto; "></div>
                        </div>
                        <div id="id_div_form_registrar">

                            <form id="id_registrar_proyecto" class="form-style">
                                <table width="100%">                                
                                    <tr>
                                        <td width="25%">Tipo de Proyecto (*):</td>
                                        <td width="45%">
                                            <input type="hidden" id="id_hidden_cod_proyecto" name="hidden_cod_proyecto">
                                            <select id="id_sel_tipo_proyecto" name="sel_tipo_proyecto">
                                                <option value="">Seleccione..</option>
                                                <?php
                                                $query = mysql_query("SELECT * FROM TipoProyecto ORDER BY Nombre ASC", $connection);

                                                while ($row = mysql_fetch_array($query)) {
                                                    ?>
                                                    <option value="<?php echo $row['idTipoProyecto']; ?>"><?php echo $row['Nombre']; ?></option>
                                                    <?php
                                                }
                                                ?>                                       
                                            </select>
                                        </td>        
                                        <td width="30%" aling="left"></td>
                                    </tr>                                                                   
                                    <tr>
                                        <td>Nombre del Proyecto (*):</td>
                                        <td>
                                            <input type="text" id="id_txt_nombre_proyecto" name="txt_nombre_proyecto">
                                        </td>
                                        <td></td>
                                    </tr>              
                                    <tr>
                                        <td>Fecha Inicio (*):</td>
                                        <td>
                                            <input type="text" id="id_txt_fecha_inicio_proyecto" name="txt_fecha_inicio_proyecto" readonly="true">
                                        </td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td>Fecha Fin:</td>
                                        <td>
                                            <input type="text" id="id_txt_fecha_fin_proyecto" name="txt_fecha_fin_proyecto" readonly="true">
                                        </td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td>Costo (*):</td>
                                        <td>
                                            <input type="text" id="id_txt_costo_proyecto" name="txt_costo_proyecto">
                                        </td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td></td>
                                        <td align="right">                                        
                                            <input type="button" id="id_btn_add_proyecto" name="btn_add_proyecto" value="Agregar">
                                            <input type="button" id="id_btn_update_proyecto" name="btn_update_proyecto" value="Modificar" style="display: none">
                                            <input type="button" id="id_btn_delete_proyecto" name="btn_delete_proyecto" value="Eliminar" style="display: none">
                                            <input type="button" id="id_btn_clean_proyecto" name="btn_clean_proyecto" value="Limpiar">
                                            <input type="button" id="id_btn_cancel_proyecto" name="btn_cancel_proyecto" value="Cancelar" style="display: none">
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
