<?php
include("../lib/data.php");
include("../lib/library.php");
connectar();
$recurso = $_GET['recurso'];
// if(DEBUG)
// {
	echo "recursos: ".$recurso;
// }
if($recurso == PRECIO)
{
	$id_largo = $_GET['id_largo'];
	$id_diametro = $_GET['id_diametro'];
	$precio = $_GET['precio'];
	echo insertarPrecio($precio);
	$id_precio = get_Id_Precio($precio);
	echo insertaTablaPrecio($id_precio,$id_diametro,$id_largo);

}
if($recurso == PRECIOORIGINAL)
{
	$id_largo = $_GET['id_largo'];
	$id_diametro = $_GET['id_diametro'];
	$precioOriginal = $_GET['precioOriginal'];
	echo insertarPrecioOriginal($precioOriginal);
	$id_precioOriginal = get_Id_PrecioOriginal($precioOriginal);
	echo insertaTablaPrecioOriginal($id_precioOriginal,$id_diametro,$id_largo);

}
if($recurso == PORCENTAJE)
{
	echo "http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	$id_diametro = $_GET['id_diametro'];
	$id_largo = $_GET['id_largo'];
	$porcentaje = $_GET['porcentaje'];
	echo insertarPorcentaje($porcentaje);
	$id_precio = get_Id_Porcentaje($porcentaje);
	echo insertaTablaPorcentaje($id_precio,$id_diametro,$id_largo);

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
?>