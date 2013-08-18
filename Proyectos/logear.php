<?php

require("data.php");

$txtusuario = $_POST['textuser'];
$txtpass = $_POST['textpass'];
$idioma=$_POST["lang"];
$q="SELECT * FROM usuarios WHERE usuario = '$txtusuario' and Contrasena = md5('$txtpass')";
echo $q;
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
    header("location:index.php");
} else {
    ?>
    <script language="Javascript" type="text/javascript">
        alert("Combinación incorrecta de Usuario / Contraseña");
    </script>

    <?php

}
?>