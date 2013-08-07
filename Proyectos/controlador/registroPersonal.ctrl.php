<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$cod_personal = isset($_POST['hidden_cod_personal']) ? $_POST['hidden_cod_personal'] : '';

$sel_tipo_empleado_personal = isset($_POST['sel_tipo_empleado_personal']) ? $_POST['sel_tipo_empleado_personal'] : '';
$txt_nombre_personal = isset($_POST['txt_nombre_personal']) ? $_POST['txt_nombre_personal'] : '';
$txt_apellidos_personal = isset($_POST['txt_apellidos_personal']) ? $_POST['txt_apellidos_personal'] : '';
$txt_fecha_ingreso_personal = isset($_POST['txt_fecha_ingreso_personal']) ? $_POST['txt_fecha_ingreso_personal'] : '';
$txt_fecha_nacimiento_personal = isset($_POST['txt_fecha_nacimiento_personal']) ? $_POST['txt_fecha_nacimiento_personal'] : '';
$txt_dui_personal = isset($_POST['txt_dui_personal']) ? $_POST['txt_dui_personal'] : '';
$txt_nit_personal = isset($_POST['txt_nit_personal']) ? $_POST['txt_nit_personal'] : '';
$txt_pasaporte_personal = isset($_POST['txt_pasaporte_personal']) ? $_POST['txt_pasaporte_personal'] : '';
$txt_afp_personal = isset($_POST['txt_afp_personal']) ? $_POST['txt_afp_personal'] : '';
$txt_nup_personal = isset($_POST['txt_nup_personal']) ? $_POST['txt_nup_personal'] : '';
$txt_isss_personal = isset($_POST['txt_isss_personal']) ? $_POST['txt_isss_personal'] : '';
$txt_nacionalidad_personal = isset($_POST['txt_nacionalidad_personal']) ? $_POST['txt_nacionalidad_personal'] : '';
$texta_habilidad1_personal = isset($_POST['texta_habilidad1_personal']) ? $_POST['texta_habilidad1_personal'] : '';
$texta_habilidad2_personal = isset($_POST['texta_habilidad2_personal']) ? $_POST['texta_habilidad2_personal'] : '';
$texta_habilidad3_personal = isset($_POST['texta_habilidad3_personal']) ? $_POST['texta_habilidad3_personal'] : '';
$txt_salario_personal = isset($_POST['txt_salario_personal']) ? $_POST['txt_salario_personal'] : '';
$txt_personal_personal = isset($_POST['txt_personal_personal']) ? $_POST['txt_personal_personal'] : '';


switch ($accion) {
    case 1: //buscar personal        
        $texto = isset($_POST['txt_texto_personal']) ? $_POST['txt_texto_personal'] : '';
        $opc = isset($_POST['sel_buscar_personal']) ? $_POST['sel_buscar_personal'] : '';
        $array_data = array();
        if ($texto != '') {
            $sql = "SELECT P.*,TE.Descripcion TipoEmp FROM Personal P ";
            $sql.="INNER JOIN TipoEmpleado TE ";
            $sql.="ON P.idTipoEmpleado=TE.idTipoEmpleado ";
            $sql.="WHERE " . $opc . " like '%" . $texto . "%' ORDER BY P.Nombres,P.Apellidos ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idPersonal"],
                    "id_tipo_empleado" => $row["idTipoEmpleado"],
                    "label_tipo_empleado" => $row["TipoEmp"],
                    "nombres" => $row["Nombres"],
                    "apellidos" => $row["Apellidos"],
                    "fecha_ingreso" => $row["FechaIngreso"],
                    "fecha_nacimiento" => $row["FechaNacimiento"],
                    "habilidad1" => $row["Habilidad1"],
                    "habilidad2" => $row["Habilidad2"],
                    "habilidad3" => $row["Habilidad3"],
                    "dui" => $row["DUI"],
                    "nit" => $row["NIT"],
                    "pasaporte" => $row["Pasaporte"],
                    "nacionalidad" => $row["Nacionalidad"],
                    "afp" => $row["AFP"],
                    "nup" => $row["NUP"],
                    "isss" => $row["ISSS"],
                    "salario" => $row["SalarioMensual"],
                    "personal" => $row["Personalcol"]
                );
                $i++;
            }


            $jsonData["mensaje"] = "RECUPERANDO DATOS ";
            $jsonData["bandera"] = 1;
            $jsonData["total_rows"] = $i;
            $jsonData["rows"] = $array_data;
        } else {
            $jsonData["mensaje"] = "FALTAN CAMPOS POR LLENAR";
            $jsonData["bandera"] = 0;
        }
        break;

    case 2: //adicionando un nuevo registro
        //validaciones para el archivo

        $sql = "insert into Personal (idTipoEmpleado,Nombres,Apellidos,FechaIngreso,FechaNacimiento,";
        $sql.= "Habilidad1,Habilidad2,Habilidad3,DUI,NIT,Pasaporte,Nacionalidad,AFP,NUP,ISSS,SalarioMensual,Personalcol) ";
        $sql.="values(" . $sel_tipo_empleado_personal . ",'" . $txt_nombre_personal . "','" . $txt_apellidos_personal . "','" . $txt_fecha_ingreso_personal . "',";
        $sql.="'" . $txt_fecha_nacimiento_personal . "','" . $texta_habilidad1_personal . "','" . $texta_habilidad2_personal . "','" . $texta_habilidad3_personal . "',";
        $sql.="'" . $txt_dui_personal . "','" . $txt_nit_personal . "','" . $txt_pasaporte_personal . "','" . $txt_nacionalidad_personal . "',";
        $sql.=$txt_afp_personal . ",'" . $txt_nup_personal . "','" . $txt_isss_personal . "','" . $txt_salario_personal . "','" . $txt_personal_personal . "')";
        mysql_query("SET NAMES 'utf8'");
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PERSONAL AGREGADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR EL PERSONAL. INTENTE DE NUEVO " . $sql;
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 3: //modificando al personal

        $sql = "UPDATE Personal SET idTipoEmpleado=" . $sel_tipo_empleado_personal . ",Nombres='" . $txt_nombre_personal . "',";
        $sql.="Apellidos='" . $txt_apellidos_personal . "',FechaIngreso='" . $txt_fecha_ingreso_personal . "',";
        $sql.="FechaNacimiento='" . $txt_fecha_nacimiento_personal . "',DUI='" . $txt_dui_personal . "',";
        $sql.="NIT='" . $txt_nit_personal . "',Nacionalidad='" . $txt_nacionalidad_personal . "',";
        $sql.="AFP=" . $txt_afp_personal . ",ISSS='" . $txt_isss_personal . "',SalarioMensual='" . $txt_salario_personal . "'";

        if ($texta_habilidad1_personal != "") {
            $sql.=",Habilidad1='" . $texta_habilidad1_personal . "'";
        }

        if ($texta_habilidad2_personal != "") {
            $sql.=",Habilidad2='" . $texta_habilidad2_personal . "'";
        }

        if ($texta_habilidad3_personal != "") {
            $sql.=",Habilidad3='" . $texta_habilidad3_personal . "'";
        }

        if ($txt_pasaporte_personal != "") {
            $sql.=",Pasaporte='" . $txt_pasaporte_personal . "'";
        }

        if ($txt_nup_personal != "") {
            $sql.=",NUP='" . $txt_nup_personal . "'";
        }

        if ($txt_personal_personal != "") {
            $sql.=",Personalcol='" . $txt_personal_personal . "'";
        }

        $sql.=" WHERE idPersonal=" . $cod_personal;

        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "PERSONAL MODIFICADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ACTUALIZAR EL PERSONAL. INTENTE DE NUEVO. ";
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;

    case 4:
        $sql = "SELECT COUNT(*) total from Proyectos where idTipoProyecto=" . $cod_personal;
        $query = mysql_query($sql, $connection);
        $row = mysql_fetch_array($query);
        if ($row['total'] == 0) {
            //eliminando al personal
            $sql = "DELETE FROM TipoProyecto where idTipoProyecto=" . $cod_personal;
            $respuesta = mysql_query($sql, $connection);
            if ($respuesta) {
                $mensaje = "TIPO DE PROYECTO ELIMINADO";
                $bandera = 1;
            } else {
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE ELIMINAR EL TIPO DE PROYECTO. INTENTE DE NUEVO";
                $bandera = 0;
            }
        } else {
            $mensaje = "NO SE PUEDE ELIMINAR EL TIPO DE PROYECTO PORQUE EXISTEN REGISTROS QUE DEPENDE DE EL";
            $bandera = 0;
        }
        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;

        break;
}
sleep(1);
echo json_encode($jsonData);
?>
