<?php include("header.php"); ?>
<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>        
        <link rel="stylesheet" href="css/jquery-ui.css" />        
        <!--<script src="js/jquery-1.9.1.js"></script>-->
        <script src="js/jquery-ui.js"></script>        
        <script src="js/money/jquery.price_format.1.8.min.js"></script>                
        <script src="js/registroPersonal.js"></script>                
        <?php
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
                        <h2><?php if($_SESSION["idioma"]=="es"){
                echo "Registro de personal";
            }else{ 
                echo "Personal register";
            } ?></h2>
                        <div id="id_div_form_buscar">
                            <form id="id_form_buscar_personal" class="form-style">
                                <table width="100%" >
                                    <tr>
                                        <td width="20%"><?php if($_SESSION["idioma"]=="es"){
                echo "Buscar personal por:";
            }else{ 
                echo "Search personal by:";
            } ?></td>   
                                        <td width="10%">
                                            <select id="id_sel_buscar_personal" name="sel_buscar_personal">
                                                <option value=""><?php if($_SESSION["idioma"]=="es"){
                echo "Seleccionar";
            }else{ 
                echo "Select";
            } ?></option>
                                                <option value="P.Nombres"><?php if($_SESSION["idioma"]=="es"){
                echo "Nombres";
            }else{ 
                echo "Name";
            } ?></option>                                            
                                                <option value="P.Apellidos"><?php if($_SESSION["idioma"]=="es"){
                echo "Apellidos";
            }else{ 
                echo "Lastname";
            } ?></option>
                                                <option value="P.DUI">DUI</option>
                                                <option value="P.NIT">NIT</option>
                                            </select>
                                        </td>
                                        <td width="50%">
                                            <input type="text" id="id_txt_texto_personal" name="txt_texto_personal">
                                        </td>
                                        <td width="5%" align="right">
                                            <input type="button" id="id_btn_buscar_personal" name="btn_buscar_personal" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Buscar";
            }else{ 
                echo "Search";
            } ?>">
                                        </td>
                                        <td width="17%"></td>
                                    </tr>
                                </table>
                            </form>
                            <div id="id_result_busqueda_personal" align="center" style="overflow-y:auto; "></div>
                        </div>
                        <div id="id_div_form_registrar">

                            <form id="id_registrar_personal" class="form-style">
                                <table width="100%">
                                    <tr>
                                        <td><?php if($_SESSION["idioma"]=="es"){
                echo "Tipo de empleado";
            }else{ 
                echo "Employee type";
            } ?> (*):</td>
                                        <td>
                                            <select id="id_sel_tipo_empleado_personal" name="sel_tipo_empleado_personal">
                                                <option value="">Seleccione..</option>
                                                <?php
                                                $query = mysql_query("SELECT * FROM TipoEmpleado ORDER BY Descripcion ASC", $connection);

                                                while ($row = mysql_fetch_array($query)) {
                                                    ?>
                                                    <option value="<?php echo $row['idTipoEmpleado']; ?>"><?php echo $row['Descripcion']; ?></option>
                                                    <?php
                                                }
                                                ?>                                       
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td width="25%"><?php if($_SESSION["idioma"]=="es"){
                echo "Nombres";
            }else{ 
                echo "Name";
            } ?> (*):</td>
                                        <td width="45%">
                                            <input type="hidden" id="id_hidden_cod_personal" name="hidden_cod_personal">
                                            <input type="text" id="id_txt_nombre_personal" name="txt_nombre_personal">
                                        </td>        
                                        <td width="30%" aling="left"></td>
                                    </tr>
                                    <tr>
                                        <td><?php if($_SESSION["idioma"]=="es"){
                echo "Apellidos";
            }else{ 
                echo "Lastname";
            } ?> (*):</td>
                                        <td>
                                            <input type="text" id="id_txt_apellidos_personal" name="txt_apellidos_personal">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><?php if($_SESSION["idioma"]=="es"){
                echo "Fecha de ingreso";
            }else{ 
                echo "Join date:";
            } ?> (*):</td>
                                        <td>
                                            <input type="text" id="id_txt_fecha_ingreso_personal" name="txt_fecha_ingreso_personal" readonly="true">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><?php if($_SESSION["idioma"]=="es"){
                echo "Fecha de nacimiento:";
            }else{ 
                echo "Birthdate";
            } ?> (*):</td>
                                        <td>
                                            <input type="text" id="id_txt_fecha_nacimiento_personal" name="txt_fecha_nacimiento_personal" readonly="true">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>DUI (*):</td>
                                        <td>
                                            <input type="text" id="id_txt_dui_personal" name="txt_dui_personal">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>NIT (*):</td>
                                        <td>
                                            <input type="text" id="id_txt_nit_personal" name="txt_nit_personal">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><?php if($_SESSION["idioma"]=="es"){
                echo "Pasaporte";
            }else{ 
                echo "Passport";
            } ?>:</td>
                                        <td>
                                            <input type="text" id="id_txt_pasaporte_personal" name="txt_pasaporte_personal">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>AFP (*):</td>
                                        <td>
                                            <input type="text" id="id_txt_afp_personal" name="txt_afp_personal">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>NUP:</td>
                                        <td>
                                            <input type="text" id="id_txt_nup_personal" name="txt_nup_personal">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>ISSS (*):</td>
                                        <td>
                                            <input type="text" id="id_txt_isss_personal" name="txt_isss_personal">
                                        </td>
                                        <td></td>
                                    </tr>                                    
                                    <tr>
                                        <td><?php if($_SESSION["idioma"]=="es"){
                echo "Nacionalidad";
            }else{ 
                echo "Nacionality";
            } ?> (*):</td>
                                        <td>
                                            <input type="text" id="id_txt_nacionalidad_personal" name="txt_nacionalidad_personal">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><?php if($_SESSION["idioma"]=="es"){
                echo "Habilidad";
            }else{ 
                echo "Aptitude";
            } ?> 1:</td>
                                        <td>
                                            <textarea id="id_texta_habilidad1_personal" name="texta_habilidad1_personal"></textarea>
                                        </td>
                                        <td></td>
                                    </tr>                                     
                                    <tr>
                                        <td><?php if($_SESSION["idioma"]=="es"){
                echo "Habilidad";
            }else{ 
                echo "Aptitude";
            } ?> 2:</td>
                                        <td>
                                            <textarea id="id_texta_habilidad2_personal" name="texta_habilidad2_personal"></textarea>
                                        </td>
                                        <td></td>
                                    </tr>                                     
                                    <tr>
                                        <td><?php if($_SESSION["idioma"]=="es"){
                echo "Habilidad";
            }else{ 
                echo "Aptitude";
            } ?> 3:</td>
                                        <td>
                                            <textarea id="id_texta_habilidad3_personal" name="texta_habilidad3_personal"></textarea>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><?php if($_SESSION["idioma"]=="es"){
                echo "Salario mensual";
            }else{ 
                echo "Monthly salary";
            } ?>(*):</td>
                                        <td>
                                            <input type="text" id="id_txt_salario_personal" name="txt_salario_personal">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Personal:</td>
                                        <td>
                                            <input type="text" id="id_txt_personal_personal" name="txt_personal_personal">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td align="right">                                        
                                            <input type="button" id="id_btn_add_personal" name="btn_add_personal" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Agregar";
            }else{ 
                echo "Add";
            } ?>">
                                            <input type="button" id="id_btn_update_personal" name="btn_update_personal" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Modificar";
            }else{ 
                echo "Update";
            } ?>" style="display: none">
                                            <input type="button" id="id_btn_delete_personal" name="btn_delete_personal" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Eliminar";
            }else{ 
                echo "Update";
            } ?>" style="display: none">
                                            <input type="button" id="id_btn_clean_personal" name="btn_clean_personal" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Limpiar";
            }else{ 
                echo "Clear";
            } ?>">
                                            <input type="button" id="id_btn_cancel_personal" name="btn_cancel_personal" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Cancelar";
            }else{ 
                echo "Cancel";
            } ?>" style="display: none">
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
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
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




