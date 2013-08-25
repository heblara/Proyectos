<?php

require("data.php");
ob_start();
$respuesta = new stdClass();
$txtusuario = $_POST['textuser'];
$txtpass = $_POST['textpass'];
$idioma=$_POST["lstIdioma"];
if($txtusuario=="" || $txtpass==""){
    $respuesta->mensaje = 1;
}else{
    $q="SELECT * FROM usuarios WHERE usuario = '$txtusuario' and Contrasena = md5('$txtpass')";
    //echo $q;
    $query = mysql_query($q, $connection);
    $usuario = "";
    $pass = "";

    while ($row = mysql_fetch_array($query)) {
        $usuario = $row['Usuario'];
        $pass = $row['Contrasena'];
    }

    if ($txtusuario == $usuario and md5($txtpass == $pass)) {
        session_start();
        $_SESSION["autenticado"] = "si";
        $_SESSION["usuario"] = $usuario;
        $_SESSION["idioma"]=$idioma;
        $respuesta->mensaje = 3;
        //header("location:index.php");
    } else {
        $respuesta->mensaje = 2;
    }
}
echo json_encode($respuesta);
ob_end_flush();
?>