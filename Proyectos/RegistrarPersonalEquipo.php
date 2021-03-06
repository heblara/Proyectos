<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>        
        <link rel="stylesheet" href="css/jquery-ui.css" />                        
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>                     
        <script src="js/registroPersonalEquipo.js"></script>                   


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
                        <h2>Registros del Personal asignados a Equipos de Trabajo</h2>

                        <div id="id_div_form_buscar" style="display: none">
                            <form id="id_form_buscar_equipo" class="form-style">
                                <table width="100%" border="1" class="table-style">
                                    <tr>
                                        <td width="20%">Nombre del equipo de trabajo:</td>   
                                        <td width="70%">
                                            <input type="text" id="id_txt_buscar_equipo" name="txt_buscar_equipo">
                                        </td>                                        
                                        <td width="10%" align="right">
                                            <input type="button" id="id_btn_buscar_equipo" name="btn_buscar_equipo" value="Buscar">
                                        </td>

                                    </tr>
                                </table>
                            </form>
                            <div id="id_result_busqueda_equipo" align="center" style="overflow-y:auto; "></div>
                        </div>


                        <div id="id_div_form_buscar_personal" style="display: none">
                            <form id="id_form_buscar_personal" class="form-style">
                                <table width="100%" border="1" class="table-style">
                                    <tr>
                                        <td width="20%">Nombre del empleado:</td>   
                                        <td width="70%">
                                            <input type="text" id="id_txt_buscar_personal" name="txt_buscar_personal">
                                        </td>                                        
                                        <td width="10%" align="right">
                                            <input type="button" id="id_btn_buscar_personal" name="btn_buscar_personal" value="Buscar">
                                        </td>

                                    </tr>
                                </table>
                            </form>
                            <div id="id_result_busqueda_personal" align="center" style="overflow-y:auto; "></div>
                        </div>

                        <div id="id_div_form_registrar">



                            <form id="id_registrar_personal_equipo" class="form-style">
                                <table width="100%">                                
                                    <tr>
                                        <td width="25%">Equipo seleccionado (*):</td>
                                        <td width="45%">
                                            <input type="hidden" id="id_hidden_cod_personal_equipo" name="hidden_cod_personal_equipo">
                                            <input type="hidden" id="id_hidden_cod_tipo_equipo_personal_equipo" name="hidden_cod_tipo_equipo_personal_equipo">
                                            <input type="text" id="id_txt_nombre_equipo_personal_equipo" name="nombre_equipo_personal_equipo" placeholder="Presione el boton buscar para seleccionar un equipo" readonly="false" style="width: 70%">
                                            <input type="button" id="id_btn_show_buscar_equipo" name="btn_show_buscar_equipo" value="Buscar Equipo de Trabajo" style="float:right;position:absolute;">
                                        </td>        
                                        <td width="30%" aling="left"></td>
                                    </tr>                                                                   
                                    <tr>
                                        <td>Personal Seleccionado (*):</td>
                                        <td>   
                                            <input type="button" id="id_btn_show_buscar_personal" name="btn_show_buscar_personal" value="Buscar Empleados">
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
