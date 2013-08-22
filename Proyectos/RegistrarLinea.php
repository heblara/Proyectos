<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de Construcción</title>        
        <link rel="stylesheet" href="css/jquery-ui.css" />        
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>        
        <script src="js/registroLinea.js"></script>                
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
                        <form id="id_form_buscar_linea" class="form-style">
                            <table width="100%" >
                                <tr>
                                    <td width="18%">Buscar linea por:</td>
                                    <td width="10%">
                                        <select id="id_sel_buscar_linea" name="sel_buscar_linea">
                                            <option value=""><?php if($_SESSION["idioma"]=="es"){
                echo "Seleccion..";
            }else{ 
                echo "Select...";
            } ?></option>
                                            <option value="l.Descripcion"><?php if($_SESSION["idioma"]=="es"){
                echo "Nombre de linea";
            }else{ 
                echo "Line's name";
            } ?></option>                                            
                                            <option value="u.Descripcion"><?php if($_SESSION["idioma"]=="es"){
                echo "Nombre de Unidad";
            }else{ 
                echo "Unit name";
            } ?></option>
                                        </select>
                                    </td>
                                    <td width="50%">
                                        <input type="text" id="id_txt_texto_linea" name="txt_texto_linea">
                                    </td>
                                    <td width="5%" align="right">
                                        <input type="button" id="id_btn_buscar_linea" name="btn_buscar_linea" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Buscar";
            }else{ 
                echo "Search";
            } ?>">
                                    </td>
                                    <td width="17%"></td>
                                </tr>
                            </table>
                        </form>
                        <div id="id_result_busqueda_linea" align="center" style="overflow-y:auto; "></div>
                    </div>
                    <div id="id_div_form_registrar">

                        <form id="id_registrar_linea" class="form-style">
                            <table width="100%">
                                <tr>
                                    <td><?php if($_SESSION["idioma"]=="es"){
                echo "Unidad";
            }else{ 
                echo "Unit";
            } ?> (*):</td>
                                    <td>
                                        <select id="id_sel_unidad_linea" name="sel_unidad_linea">
                                            <option value=""><?php if($_SESSION["idioma"]=="es"){
                echo "Seleccione";
            }else{ 
                echo "Select";
            } ?></option>
                                            <?php
                                            $query = mysql_query("SELECT * FROM Unidad ORDER BY Descripcion ASC", $connection);

                                            while ($row = mysql_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['idUnidad']; ?>"><?php echo $row['Descripcion']; ?></option>
                                                <?php
                                            }
                                            ?>                                       
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="25%">Descripcion (*):</td>
                                    <td width="45%">
                                        <input type="hidden" id="id_hidden_cod_linea" name="hidden_cod_linea">
                                        <textarea id="id_texta_descripcion_linea" name="texta_descripcion_linea"></textarea>
                                    </td>        
                                    <td width="30%" aling="left"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="right">                                        
                                        <input type="button" id="id_btn_add_linea" name="btn_add_linea" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Agregar";
            }else{ 
                echo "Add";
            } ?>">
                                        <input type="button" id="id_btn_update_linea" name="btn_update_linea" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Modificar";
            }else{ 
                echo "Update";
            } ?>" style="display: none">
                                        <input type="button" id="id_btn_delete_linea" name="btn_delete_linea" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Eliminar";
            }else{ 
                echo "Delete";
            } ?>" style="display: none">
                                        <input type="button" id="id_btn_clean_linea" name="btn_clean_linea" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Limpiar";
            }else{ 
                echo "Clear";
            } ?>">
                                        <input type="button" id="id_btn_cancel_linea" name="btn_cancel_linea" value="<?php if($_SESSION["idioma"]=="es"){
                echo "Cancelar";
            }else{ 
                echo "Cancel";
            } ?>" style="display: none">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><span style="color: #FFD800"><?php if($_SESSION["idioma"]=="es"){
                echo "Son campos requeridos (*)";
            }else{ 
                echo "This fields are required (*)";
            } ?></span></td>
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
