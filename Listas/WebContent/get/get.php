<?php
	include("../lib/data.php");
	include("../lib/library.php");
	connectar();
	$recurso = $_GET['recurso'];
	if(DEBUG)
	{
		echo "recursos: ".$recurso;
	}
	if($recurso == PRECIO)
	{
		$id_largo = $_GET['id_largo'];
		$id_diametro = $_GET['id_diametro'];
		echo get_Precio($id_largo,$id_diametro);
		
	}
	else if($recurso == LARGO)
	{
		$id_largo = $_GET['id_largo'];
		echo get_Largo($id_largo);
		
	}
	else if($recurso == DIAMETRO)
	{
		$id_diametro = $_GET['id_diametro'];
		echo get_Diametro($id_diametro);
		
	}
	else if($recurso == PORCENTAJE)
	{
		$id_largo = $_GET['id_largo'];
		$id_diametro = $_GET['id_diametro'];
		echo get_Porcentaje($id_diametro,$id_largo);
		
	}
	else if($recurso == PRECIOORIGINAL)
	{
		$id_largo = $_GET['id_largo'];
		$id_diametro = $_GET['id_diametro'];
		echo get_PrecioOriginal($id_diametro,$id_largo);
		
	}
?>