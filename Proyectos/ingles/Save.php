<?php
include("data.php");

$Nombres = $_POST['Nombres'];
$Apellidos = $_POST['Apellidos'];
$FechaIngreso = $_POST['FechaIngreso'];
$FechaNacimiento = $_POST['FechaNacimiento'];
$Habilidad1 = $_POST['Habilidad1'];
$Habilidad2 = $_POST['Habilidad2'];
$Habilidad3 = $_POST['Habilidad3'];
$DUI = $_POST['DUI'];
$NIT = $_POST['NIT'];
$Pasaporte = $_POST['Pasaporte'];
$Nacionalidad = $_POST['Nacionalidad'];
$AFP= $_POST['AFP'];
$NUP = $_POST['NUP'];
$ISSS = $_POST['ISSS'];
$SalarioMensual = $_POST['SalarioMensual'];



$query = mysql_query("INSERT INTO `proyectosciviles`.`personal` (`Nombres`, `Apellidos`, `FechaIngreso`, `FechaNacimiento`, `Habilidad1`, `Habilidad2`, `Habilidad3`, `DUI`, `NIT`, `Pasaporte`, `Nacionalidad`, `AFP`, `NUP`, `ISSS`, `SalarioMensual`) VALUES ('$Nombres', '$Apellidos', '$FechaIngreso', '$FechaNacimiento', '$Habilidad1', '$Habilidad2', '$Habilidad3', '$DUI', '$NIT', '$Pasaporte', '$Nacionalidad', '$AFP', '$NUP', '$ISSS', '$SalarioMensual');");

header('location: RegistrarUsuarios.php')

?>