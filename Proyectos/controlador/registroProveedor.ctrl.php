<?php

require("../data.php");

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$nick = isset($_POST['txt_nick_usuario']) ? $_POST['txt_nick_usuario'] : '';
$activo = isset($_POST['ckd_estado_usuario']) ? 1 : 0;
$idPersonal = isset($_POST['hidden_cod_empleado']) ? $_POST['hidden_cod_empleado'] : '';
$idNivelConfianza = isset($_POST['sel_privilegio_usuario']) ? $_POST['sel_privilegio_usuario'] : '';
$contrasena = isset($_POST['txt_password_usuario']) ? $_POST['txt_password_usuario'] : '';

switch ($accion) {
    case 1: //buscar personal
        $opc = isset($_POST['sel_buscar_empleado']) ? $_POST['sel_buscar_empleado'] : '';
        $texto = isset($_POST['txt_texto_empleado']) ? $_POST['txt_texto_empleado'] : '';
        if ($opc != '' && $texto != '') {
            $sql = "SELECT a.idPersonal, concat( a.nombres, ' ', a.apellidos ) nom, ifnull( b.idNivelConfianza, '' ) idNivel, ";
            $sql.="ifnull( b.Usuario, '' ) user, ifnull( b.Contrasena, '' ) pass, IF(b.Activo=0, 0, IF(b.Activo=1,1,''))  estado, ";
            $sql.="a.dui, a.nit, ifnull(c.Descripcion,'') des ";
            $sql.="FROM personal a ";
            $sql.="LEFT JOIN usuarios b ";
            $sql.="on a.idPersonal=b.idPersonal ";
            $sql.="LEFT JOIN nivelconfianza c ON c.idNivelConfianza = b.idNivelConfianza ";
            $sql.="WHERE a." . $opc . " like '%" . $texto . "%' ORDER BY a.Apellidos,a.Nombres ASC";

            $query = mysql_query($sql, $connection);
            $i = 0;
            while ($row = mysql_fetch_array($query)) {
                $array_data[$i] = array(
                    "id" => $row["idPersonal"],
                    "idPrivilegio" => $row["idNivel"],
                    "labelPrivilegio" => $row["des"],
                    "nick" => $row["user"],
                    "password" => $row["pass"],
                    "estado" => $row["estado"],
                    "nombre" => $row["nom"],
                    "dui" => $row["dui"],
                    "nit" => $row["nit"]
                );
                $i++;
            }


            $jsonData["mensaje"] = "RECUPERANDO DATOS";
            $jsonData["bandera"] = 1;
            $jsonData["total_rows"] = $i;
            $jsonData["rows"] = $array_data;
        } else {
            $jsonData["mensaje"] = "FALTAN CAMPOS POR LLENAR";
            $jsonData["bandera"] = 0;
        }
        sleep(1);
        break;

    case 2: //adicionando un nuevo registro
        //verificando que no exista el nombre del usuario        
        $sql = "select count(*) total from Usuarios where Usuario='" . $nick . "'";
        $query = mysql_query($sql, $connection);
        $row = mysql_fetch_array($query);

        if ($row['total'] == 0) {
            $sql = "insert into Usuarios (idNivelConfianza, idPersonal, Usuario, Contrasena, Activo) ";
            $sql.="values(" . $idNivelConfianza . "," . $idPersonal . ",'" . $nick . "','" . $contrasena . "'," . $activo . ")";
            $respuesta = mysql_query($sql, $connection);
            if ($respuesta) {
                $mensaje = "USUARIO AGREGADO";
                $bandera = 1;
            } else {
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR AL NUEVO USUARIO. INTENTE DE NUEVO";
                $bandera = 0;
            }
        } else {
            $mensaje = "YA EXISTE EL NICK DE USUARIO";
            $bandera = 0;
        }
        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;

    case 3: //modificando al usuario
        //verificando si el nuevo nombre de nick lo tiene otro usuario
        $sql = "select count(*) total from usuarios where idPersonal<>" . $idPersonal . " and Usuario='" . $nick . "'";
        $query = mysql_query($sql, $connection);
        $row = mysql_fetch_array($query);
        $campos = array();
        $i = 0;
        if ($row['total'] == 0) {
            $sql = "update Usuarios set ";

            if ($idNivelConfianza <> "") {
                $campos[$i] = "idNivelConfianza=" . $idNivelConfianza;
                $i++;
            }

            if ($nick <> "") {
                $campos[$i] = "Usuario='" . $nick."'";
                $i++;
            }
            if ($contrasena <> "") {
                $campos[$i] = " Contrasena='" . $contrasena . "'";
                $i++;
            }

            if ($activo <> "") {
                $campos[$i] = " Activo=" . $activo;
                $i++;
            }
            $sql_query = "";
            foreach ($campos as $key => $value) {
                $sql_query.=$value . ",";
            }

            $sql.=substr($sql_query,0,-1) . " where idPersonal=" . $idPersonal;
            $respuesta = mysql_query($sql, $connection);
            if ($respuesta) {
                $mensaje = "USUARIO MODIFICADO";
                $bandera = 1;
            } else {
                $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR AL NUEVO USUARIO. INTENTE DE NUEVO.";
                $bandera = 0;
            }
        } else {
            $mensaje = "YA EXISTE EL NICK DE USUARIO";
            $bandera = 0;
        }
        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;

    case 4:
        //eliminando al asuario
        $sql = "delete from Usuarios where idPersonal=" . $idPersonal;
        $respuesta = mysql_query($sql, $connection);
        if ($respuesta) {
            $mensaje = "USUARIO ELIMINADO";
            $bandera = 1;
        } else {
            $mensaje = "SE PRODUJO UN ERROR AL MOMENTO DE REGISTRAR AL NUEVO USUARIO. INTENTE DE NUEVO " . $sql;
            $bandera = 0;
        }

        $jsonData["mensaje"] = $mensaje;
        $jsonData["bandera"] = $bandera;
        break;
}

echo json_encode($jsonData);
?>
