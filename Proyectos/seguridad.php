<?php
session_start(); 
if(isset($_SESSION["autenticado"])){
	if(!$_SESSION["autenticado"]=="si"){
		header("Location:index.php");
	}
}else{
	header("Location:index.php");
}
?>