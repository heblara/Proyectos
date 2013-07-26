<?php

require("data.php");

$txtusuario = $_POST['textuser'];
$txtpass = $_POST['textpass'];

$query = mysql_query("SELECT * FROM usuarios WHERE usuario = '$txtusuario' and Contrasena = '$txtpass'", $connection);
$usuario = "";
$pass = "";

while ($row = mysql_fetch_array($query)) {
    $usuario = $row['Usuario'];
    $pass = $row['Contrasena'];
}

if ($txtusuario == $usuario and $txtpass == $pass) {
    session_start();
    $_SESSION["autenticado"] = "si";
    $_SESSION["usuario"] = $usuario;
    header("location:index.php");
} else {
    ?>
    <script language="Javascript" type="text/javascript">
        alert("Combinación incorrecta de Usuario / Contraseña");
    </script>

    <?php

}
?>