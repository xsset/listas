<?php
	include("../lib/data.php");
	include("../lib/library.php");
	connectar();
	$recurso = $_GET['recurso'];
// 		echo $recurso;
		if($recurso == LARGO)
		{
			echo "LARGO";
			$nuevoLargo = $_GET['nuevoLargo'];
			$largo = $_GET['largo'];
			updateLargo($largo,$nuevoLargo);
		}
		else if($recurso == DIAMETRO)
		{
			$nuevoDiametro = $_GET['nuevoDiametro'];
			$diametro = $_GET['diametro'];
			echo "DIAMETRO";
			updateDiametro($diametro,$nuevoDiametro);
		}
		else if($recurso == PRECIO)
		{
// 			echo "http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
		
			$nuevoPrecio = $_GET['nuevoPrecio'];
			$precio = $_GET['precio'];
			$idDiametro=$_GET['idDiametro'];
			$idLargo = $_GET['idLargo'];
			echo "PRECIO";
			updatePrecioLargoAncho($precio,$nuevoPrecio,$idDiametro,$idLargo);
		}
		else if($recurso == PRECIOORIGINAL)
		{
// 			echo "http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
		
			$nuevoPrecio = $_GET['nuevoPrecio'];
			$precioOriginal = $_GET['precioOriginal'];
			$idDiametro=$_GET['idDiametro'];
			$idLargo = $_GET['idLargo'];
			echo "PRECIOORIGINAL";
			updatePrecioOriginalLargoAncho($precioOriginal,$nuevoPrecio,$idDiametro,$idLargo);
		}
		else if($recurso == PORCENTAJE)
		{
			echo "http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
		
			$nuevoPrecio = $_GET['nuevoPrecio'];
			$precio = $_GET['precio'];
			$idDiametro=$_GET['idDiametro'];
			$idLargo = $_GET['idLargo'];
			echo "PRECIO";
			updatePorcentajeLargoAncho($precio,$nuevoPrecio,$idDiametro,$idLargo);
		}
	
?>