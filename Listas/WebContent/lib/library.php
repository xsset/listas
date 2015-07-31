<?php
include("data.php");
//SQL
$link = NULL;
function connectar()
{
	ini_set('display_errors', 1);
	error_reporting(E_ALL);	
	
	if(DEBUG)
		echo "Debug Activo<br>";
	$link = mysql_connect(DATABASEURL, DATABASEUSER, DATABASEPASSWORD);
	if (!$link) {
		if(DEBUG)
    		die('Not connected : ' . mysql_error());
	}
	else
	{
		if(DEBUG)
			echo "Conectado a la base de datos <br>";
	}

	// make foo the current db
	$db_selected = mysql_select_db(DATABASE, $link);
	if (!$db_selected) {
		if(DEBUG)
    		die ('Can\'t use foo : ' . mysql_error());
	}
	else
	{
		if(DEBUG)
			echo "Abierta DB<br>";
	}
}
function cerrar()
{
	  mysql_close();
		if(DEBUG)
    		die('cerrada :');
	
}
function ejecutar_sql($sql)
{
	if(DEBUG)
		echo "sql =  $sql<br>";
	return mysql_query($sql);
} 
function sql_to_Element($sql,$elemento)
{
	
	$result=ejecutar_sql($sql);
	$num_rows = mysql_num_rows($result);
	if(DEBUG)
		echo "Registros encontrados $num_rows<br>";
	
	$index=0;
	$row = mysql_fetch_array($result);
	return $row[$elemento];
}
function sql_to_Array($sql,$elemento)
{

	$result=ejecutar_sql($sql);
	if($result)
	{
		if(DEBUG)
		{
			$num_rows = mysql_num_rows($result);
			echo "Registros encontrados $num_rows<br>";
		}
// 	$row = mysql_fetch_array($result);
		$data = array();
	
		while($row = mysql_fetch_array($result)) {
			array_push($data, $row[$elemento]);
		}
		if(DEBUG) 
		{
// 			echo "columnas: ";
			print_r($data);
			echo "<br>";
		}
		return $data;
	}
	return null;
}
function datos_tabla($id_tabla)
{
	$sql = "SELECT * FROM tabla_pedido WHERE id_tabla_pedido";	
	$result=ejecutar_sql($sql);
	$num_rows = mysql_num_rows($result);
	if(DEBUG)
		echo "Registros encontrados $num_rows<br>";
	
	// 	$row = mysql_fetch_array($result);
	$data = array();
	
	while($row = mysql_fetch_array($result)) {
		array_push($data, $row[0]);
	}
	if(DEBUG)
	{
		// 		echo "columnas: ";
		print_r($data);
		echo "<br>";
	}
	return $data;
}
function select_to_Array_index($tabla,$id,$idNombre)
{
	$sql = "SELECT * FROM $tabla WHERE $idNombre= $id";

	$result = ejecutar_sql($sql);
	$arreglo = nombre_Columnas_Tabla($tabla);

	$num_rows = mysql_num_rows($result);
	if(DEBUG)
		echo "Registros encontrados $num_rows<br>";
	$data = array();
	$index2 = 0;
	while($row = mysql_fetch_array($result)) {
		for($index = 0;$index< count($arreglo);$index++)
		{
			$data[$index2][$index] =  $row[$arreglo[$index]];
		}
		$index2++;
	}
	if (DEBUG)
	{
		for($index2 = 0;$index2< count($data);$index2++)
		{
			for($index = 0;$index< count($data[$index2]);$index++)
			{
				echo $data[$index2][$index]." ";
			}
			echo "<br>";
		}
		print_r($data);

	}

	return  $data;
}
function select_to_Array($tabla)
{
	$sql = "SELECT * FROM $tabla";
	
	$result = ejecutar_sql($sql);
	$arreglo = nombre_Columnas_Tabla($tabla);
	
	$num_rows = mysql_num_rows($result);
	if(DEBUG)
		echo "Registros encontrados $num_rows<br>";
	$data = array();
	$index2 = 0;
	while($row = mysql_fetch_array($result)) {
		for($index = 0;$index< count($arreglo);$index++)
		{
			$data[$index2][$index] =  $row[$arreglo[$index]];
		}
		$index2++;
	}
	if (DEBUG)
	{
		for($index2 = 0;$index2< count($data);$index2++)
		{
			for($index = 0;$index< count($data[$index2]);$index++)
			{
				echo $data[$index2][$index]." ";
			}
			echo "<br>";
		}
		print_r($data);
		
	}
	
	return  $data;
} 
function nombre_Columnas_Tabla($tabla)
{
	$sql = "SELECT column_name FROM information_schema.`COLUMNS`
	WHERE table_name = '$tabla'
	AND TABLE_SCHEMA = '".DATABASE."'";

	$result = ejecutar_sql($sql);
	$num_rows = mysql_num_rows($result);

	$data = array();
	while($row = mysql_fetch_array($result)) {
		array_push($data, $row['column_name']);
	}
	if(DEBUG) 
	{
		echo "columnas: ";
		print_r($data);
		echo "<br>";
	}
	return $data;
}
function contar_Columnas_Tabla($tabla)
{
	$sql = "SELECT count(*) FROM information_schema.`COLUMNS` 
			WHERE table_name = '$tabla'
			AND TABLE_SCHEMA = '".DATABASE."'";
	$result = select_tabla($sql);
	$row = mysql_fetch_array($result);
	return  $row['count(*)'];
}
function getMaterial($idMaterial)
{
	 return  sql_to_Element("SELECT nombre FROM material WHERE id_material = '$idMaterial'","nombre");
}
function getObservaciones($idObservaciones)
{
	return  sql_to_Element("SELECT observacion FROM observacion WHERE id_observacion = '$idObservaciones'","observacion");
}
function fila($id_largo)
{
	return  sql_to_Array("SELECT largo FROM tabla_columna_largo INNER JOIN largo ON tabla_columna_largo.id_largo = largo.id_largo  AND tabla_columna_largo.id_columna_largo = '$id_largo'","largo");
	//return  sql_to_Array("SELECT largo FROM conexion_columna_largo INNER JOIN tabla_columna_largo ON conexion_columna_largo.id_columna_largo = tabla_columna_largo.id_columna_largo INNER JOIN largo ON tabla_columna_largo.id_largo = largo.id_largo AND conexion_columna_largo.id_tabla_pedido = $id_Table;","largo");
}
function getFila($idTabla)
{
	return  sql_to_Element("SELECT id_fila_diametro FROM conexion_fila_diametro WHERE   id_tabla_pedido = '$idTabla'","id_fila_diametro");
}
function diametro($id_diametro)
{
	return  sql_to_Array("SELECT diametro FROM tabla_fila_diametro INNER JOIN diametro ON tabla_fila_diametro.id_diametro = diametro.id_diametro AND tabla_fila_diametro.id_fila_diametro = '$id_diametro'","diametro");
}
function tabla_largo($id_diametro_largo)
{
	return  sql_to_Array("SELECT id_largo FROM  tabla_columna_largo WHERE id_columna_largo = '$id_largo'","id_largo");
}
function getColumna($idTabla)
{
	return  sql_to_Element("SELECT  id_columna_largo FROM conexion_columna_largo WHERE  id_tabla_pedido = '$idTabla'","id_columna_largo");
}

// {
// 	return  sql_to_Array("SELECT  id_diametro FROM tabla_fila_diametro WHERE  id_fila_diametro = '$id_fila_diametro'","id_diametro");
// }
function get_Id_Diametro($diametro)
{
	$sql = "SELECT id_diametro FROM diametro WHERE diametro = '$diametro'";
	$arraySQL = sql_to_Array($sql,"id_diametro");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else 
	{
		return NULL;
	}
}
function get_Id_Largo($largo)
{
	$sql = "SELECT id_largo FROM largo WHERE largo = '$largo'";
	$arraySQL = sql_to_Array($sql,"id_largo");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function insertarFila_Id_Diametro($id_Columna,$id_diametro)
{
	if(existeFila_Id_Diametro($id_diametro,$id_Columna))
	{
		return;
	}
	else
	{
		$sql = "INSERT INTO `tabla_fila_diametro` (`id_fila_diametro`, `id_diametro`) VALUES ('$id_Columna', '$id_diametro')";
		if (DEBUG)
			echo $sql."<br>";
		$resultado = mysql_query ( $sql );
		if (DEBUG)
			echo "Registro dado de alta $resultado <br>";
	}
	
}
function existeFila_Id_Diametro($id_Columna,$id_diametro)
{
	$sql = "SELECT id_fila_diametro FROM tabla_fila_diametro WHERE id_fila_diametro = '$id_Columna' AND id_diametro = '$id_diametro'";
	$arraySQL = sql_to_Array($sql,"id_fila_diametro");
	
	if(count($arraySQL) > 0)
		return true;
	return false;
}
function insertarDiametro($diametro)
{
// 	$sql = "INSERT INTO ".TABLEDATOS." values($num,'$mat','$piez','$id')";
// 	//if(DEBUG)
// 	echo $sql;
// 	$resultado=mysql_query($sql);
	if(existeDiametro($diametro))
	{
		return;
	}
	else 
	{
		$sql = "INSERT INTO `diametro` (`id_diametro`, `diametro`) VALUES (NULL, '$diametro')";
		if(DEBUG)
			echo $sql."<br>";
		$resultado=mysql_query($sql);
		if(DEBUG)
			echo "Registro dado de alta $resultado <br>";
		
	}
}
//////////////columna-Largo
function insertarColumna_Id_Largo($id_Fila,$id_largo)
{
	if(existeColumna_Id_Largo($id_Fila,$id_largo))
	{
		return;
	}
	else
	{
		$sql = "INSERT INTO tabla_columna_largo (`id_columna_largo`, `id_largo`) VALUES ('$id_Fila', '$id_largo')";
		if (DEBUG)
			echo $sql."<br>";
		$resultado = mysql_query ( $sql );
		if (DEBUG)
			echo "Registro dado de alta $resultado <br>";
	}

}
// function insertarFila_Id_Diametro($id_diametro,$id_largo)
// {
// 	if(existeColumna_Id_Largo($id_diametro,$id_largo))
// 	{
// 		return;
// 	}
// 	else
// 	{
// 		$sql = "INSERT INTO tabla_columna_largo (`id_columna_largo`, `id_largo`) VALUES ('$id_diametro', '$id_largo')";
// 		if (DEBUG)
// 			echo $sql."<br>";
// 		$resultado = mysql_query ( $sql );
// 		if (DEBUG)
// 			echo "Registro dado de alta $resultado <br>";
// 	}

// }
function existeColumna_Id_Largo($id_Fila,$id_largo)
{
	$sql = " SELECT id_columna_largo FROM tabla_columna_largo WHERE id_columna_largo  = '$id_Fila' AND id_largo = '$id_largo'";
	$arraySQL = sql_to_Array($sql,"id_columna_largo");

	if(count($arraySQL) > 0)
		return true;
	return false;	
}
////////////////////////////////////Largo

function insertarLargo($largo)
{
	// 	$sql = "INSERT INTO ".TABLEDATOS." values($num,'$mat','$piez','$id')";
	// 	//if(DEBUG)
		// 	echo $sql;
		// 	$resultado=mysql_query($sql);
		if(existeLargo($largo))
		{
			return;
		}
		else
		{
			$sql = "INSERT INTO `largo` (`id_largo`, `largo`) VALUES (NULL, '$largo')";
			if(DEBUG)
				echo $sql."<br>";
			$resultado=mysql_query($sql);
			if(DEBUG)
				echo "Registro dado de alta $resultado <br>";

		}
}
function existeLargo($largo)
{
	$sql = "SELECT id_largo FROM largo WHERE largo = '$largo'";
	$arraySQL = sql_to_Array($sql,"id_largo");

	if(count($arraySQL) > 0)
		return true;
	return false;
}
function updateLargo($largo,$nuevoLargo)
{
	$id_largo = get_Id_Largo($largo);
	$sql = "UPDATE largo SET largo = '$nuevoLargo' WHERE id_largo = $id_largo";
	$sqlElement = ejecutar_sql($sql);
}
////////////////////////////////////Diametro

function existeDiametro($diametro)
{
	$sql = "SELECT id_diametro FROM diametro WHERE diametro = '$diametro'";
	$arraySQL = sql_to_Array($sql,"id_diametro");

	if(count($arraySQL) > 0)
		return true;
	return false;
}
function updateDiametro($diametro,$nuevoDiametro)
{
	$id_diametro = get_Id_Diametro($diametro);
	$sql = "UPDATE diametro SET diametro = '$nuevoDiametro' WHERE id_diametro = $id_diametro";
	$sqlElement = ejecutar_sql($sql);
}
////////////////////////////////////final
function get_Id_Precio2($id_diametro,$id_largo)
{
	$sql = "SELECT id_Precios FROM tabla_precios_original WHERE id_diametro = $id_diametro AND id_largo= $id_largo";
	$arraySQL = sql_to_Array($sql,"id_Precios");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function get_Precio($id_diametro,$id_largo)
{
	$id_Precio = get_Id_Precio2($id_diametro,$id_largo);
	$sql = "SELECT precio FROM precios WHERE id_Precios = $id_Precio ";
	$arraySQL = sql_to_Array($sql,"precio");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function insertarPrecio($precio)
{
	if(existePrecio($precio))
	{
		return;
	}
	else
	{
		$sql = "INSERT INTO `precios` (`id_Precios`, `precio`) VALUES (NULL, '$precio')";
		if(DEBUG)
			echo $sql."<br>";
		$resultado=mysql_query($sql);
		if(DEBUG)
			echo "Registro dado de alta $resultado <br>";
	}
}
function updatePrecio($precio,$nuevoPrecio)
{
	$id_Precio = get_Id_Precio($precio);
	$sql = "UPDATE precios SET precio = '$nuevoPrecio' WHERE id_Precios = $id_Precio";
	$sqlElement = ejecutar_sql($sql);
}
function  updatePrecioLargoAncho($precio,$nuevoPrecio,$id_diametro,$id_largo)
{
	$id_viejoPrecio = get_Id_PrecioLargoAncho($id_diametro,$id_largo);
	$id_nuevoPrecio = get_Id_Precio($nuevoPrecio);
	if( $id_nuevoPrecio == NULL)
	{
		insertarPrecio($nuevoPrecio);
		$id_nuevoPrecio = get_Id_Precio($nuevoPrecio);
	}
	$sql = "UPDATE tabla_precios SET id_Precios = '$id_nuevoPrecio' WHERE id_Precios = $id_viejoPrecio AND id_diametro = $id_diametro AND id_largo = $id_largo";
	echo  $sql;
	$sqlElement = ejecutar_sql($sql);
}
function existePrecio($precio)
{
	$sql = "SELECT id_Precios FROM precio_final WHERE precio  = '$precio'";
	$arraySQL = sql_to_Array($sql,"id_Precios");

	if(count($arraySQL) > 0)
		return true;
	return false;
}
function get_Id_PrecioLargoAncho($id_diametro,$id_largo)
{

	$sql ="SELECT id_Precios FROM `tabla_precios` WHERE id_diametro = '$id_diametro' AND id_largo = '$id_largo'";
	$arraySQL = sql_to_Array($sql,"id_Precios");
	echo $sql;
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function get_Id_Precio($precio)
{
	$sql ="SELECT id_Precios FROM precios WHERE precio  = '$precio'";
	echo $sql;
	$arraySQL = sql_to_Array($sql,"id_Precios");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function insertaTablaPrecio($id_precios,$id_diametro,$id_largo)
{
	if(existeTablaPrecio($id_precios,$id_diametro,$id_largo))
	{
		return;
	}
	else
	{
		$sql = "INSERT INTO `tabla_precios` (`id_Precios`, `id_diametro`, `id_largo`) VALUES ('$id_precios', '$id_diametro', '$id_largo')";
		if(DEBUG)
			echo $sql."<br>";
		$resultado=mysql_query($sql);
		if(DEBUG)
			echo "Registro dado de alta $resultado <br>";

	}
}
function get_Tabla_Precio($id_diametro,$id_largo)
{
	$sql = "SELECT id_Precios FROM tabla_precios WHERE id_diametro = $id_diametro AND id_largo= $id_largo";
	$arraySQL = sql_to_Array($sql,"id_Precios");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function updateTablePrecio($id_precios,$id_diametro,$id_largo,$nuevo_id_precios,$nuevo_id_diametro,$nuevo_id_largo)
{
	$id_Precio = get_Id_Precio($id_diametro,$id_largo);
	$sql = "UPDATE tabla_precios SET id_Precios = $nuevo_id_precios,id_diametro = $nuevo_id_diametro,id_largo = $nuevo_id_largo WHERE id_Precios = $id_precios AND id_diametro = $id_diametro AND id_largo = $id_largo";
	$sqlElement = ejecutar_sql($sql);
}
function get_Table_Id_Precio($id_diametro,$id_largo)
{
	$sql ="SELECT id_Precios FROM tabla_precios  WHERE id_diametro = $id_diametro AND id_largo = $id_largo";
	$arraySQL = sql_to_Array($sql,"id_Precios");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function existeTablaPrecio($id_precios,$id_diametro,$id_largo)
{
	$sql = "SELECT id_Precios FROM tabla_precios WHERE id_Precios = $id_precios AND id_diametro = $id_diametro AND id_largo = $id_largo";
	$arraySQL = sql_to_Array($sql,"id_Precios");

	if(count($arraySQL) > 0)
		return true;
	return false;
}
/////////////////////////////////////////porcentaje
function  updatePorcentajeLargoAncho($precio,$nuevoPrecio,$id_diametro,$id_largo)
{
	$id_viejoPrecio = get_Id_PorcentajeLargoAncho($id_diametro,$id_largo);
	$id_nuevoPrecio = get_Id_Porcentaje($nuevoPrecio);
	if( $id_nuevoPrecio == NULL)
	{
		insertarPorcentaje($nuevoPrecio);
		$id_nuevoPrecio = get_Id_Porcentaje($nuevoPrecio);
	}
	$sql = "UPDATE tabla_porcentaje SET id_Precios = '$id_nuevoPrecio' WHERE id_Precios = $id_viejoPrecio AND id_diametro = $id_diametro AND id_largo = $id_largo";
	echo  $sql;
	$sqlElement = ejecutar_sql($sql);
}
function get_Id_PorcentajeLargoAncho($id_diametro,$id_largo)
{

	$sql ="SELECT id_Precios FROM `tabla_porcentaje` WHERE id_diametro = '$id_diametro' AND id_largo = '$id_largo'";
	$arraySQL = sql_to_Array($sql,"id_Precios");
	echo $sql;
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function get_Id_Porcentaje($porcentaje)
{
	$sql ="SELECT id_Precios FROM porcentaje WHERE porcentaje  = '$porcentaje'";
	echo $sql;
	$arraySQL = sql_to_Array($sql,"id_Precios");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function existeTablaPorcentaje($id_precios,$id_diametro,$id_largo)
{
	$sql = "SELECT id_Precios FROM tabla_porcentaje WHERE id_Precios = $id_precios AND id_diametro = $id_diametro AND id_largo = $id_largo";
	$arraySQL = sql_to_Array($sql,"id_Precios");

	if(count($arraySQL) > 0)
		return true;
	return false;
}
function insertaTablaPorcentaje($id_precios,$id_diametro,$id_largo)
{
	if(existeTablaPorcentaje($id_precios,$id_diametro,$id_largo))
	{
		return;
	}
	else
	{
		$sql = "INSERT INTO `tabla_porcentaje` (`id_Precios`, `id_diametro`, `id_largo`) VALUES ('$id_precios', '$id_diametro', '$id_largo')";
		// 		if(DEBUG)
		echo $sql."<br>";
		$resultado=mysql_query($sql);
		if(DEBUG)
			echo "Registro dado de alta $resultado <br>";

	}
}
function  get_Id_Porcentaje2($id_diametro,$id_largo)
{
	$sql = "SELECT id_Precios FROM tabla_porcentaje WHERE id_diametro = $id_diametro AND id_largo= $id_largo";
	$arraySQL = sql_to_Array($sql,"id_Precios");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function get_Porcentaje($id_diametro,$id_largo)
{
	$id_Porcentaje = get_Id_Porcentaje2($id_diametro,$id_largo);
	$sql = "SELECT porcentaje FROM porcentaje WHERE id_Precios = $id_Porcentaje ";
	$arraySQL = sql_to_Array($sql,"porcentaje");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function insertarPorcentaje($porcentaje)
{
	if(existePorcentaje($porcentaje))
	{
		return;
	}
	else
	{
		$sql = "INSERT INTO `porcentaje` (`id_Precios`, `porcentaje`) VALUES (NULL, '$porcentaje')";
		// 		if(DEBUG)
		echo $sql."<br>";
		$resultado=mysql_query($sql);
			// 		if(DEBUG)
			echo "Registro dado de alta $resultado <br>";

	}
}
function updatePorcentaje($porcentaje,$nuevoPorcentaje)
{
	$id_Porcentaje = get_Id_Porcentaje($porcentaje);
	$sql = "UPDATE porcentaje SET porcentaje = '$nuevoPorcentaje' WHERE id_Precios = $id_Porcentaje";
	$sqlElement = ejecutar_sql($sql);
}
function existePorcentaje($porcentaje)
{
	$sql = "SELECT id_Precios FROM porcentaje WHERE porcentaje  = '$porcentaje'";
	$arraySQL = sql_to_Array($sql,"id_Precios");

	if(count($arraySQL) > 0)
		return true;
	return false;
}
/////////////////////////////////////////////////original
function get_Id_PrecioOriginalLargoAncho($id_diametro,$id_largo)
{

	$sql ="SELECT id_Precios FROM tabla_precios_original WHERE id_diametro = '$id_diametro' AND id_largo = '$id_largo'";
	$arraySQL = sql_to_Array($sql,"id_Precios");
	echo $sql;
	if(count($arraySQL) > 0)
	{
		echo "No ";
		return  $arraySQL[0];
	}
	else
	{
		echo "nULL ";
		return NULL;
	}
}
function get_PrecioOriginal($id_diametro,$id_largo)
{
	$id_Precio = get_Id_PrecioOriginal2($id_diametro,$id_largo);
	$sql = "SELECT precio_original FROM precio_original WHERE id_Precios = $id_Precio ";
	$arraySQL = sql_to_Array($sql,"precio_original");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function get_Id_PrecioOriginal($precio)
{//SELECT id_Precios FROM precio_original WHERE precio_original = '0'
	$sql ="SELECT id_Precios FROM precio_original WHERE precio_original  = '$precio'";
	echo $sql;
	$arraySQL = sql_to_Array($sql,"id_Precios");
	if(count($arraySQL) > 0)
	{
		echo "No2 ";
		return  $arraySQL[0];
	}
	else
	{
		echo "NULL2 ";
		return NULL;
	}
}
function get_Id_PrecioOriginal2($id_diametro,$id_largo)
{
	$sql = "SELECT id_Precios FROM tabla_precios_original WHERE id_diametro = $id_diametro AND id_largo= $id_largo";
	$arraySQL = sql_to_Array($sql,"id_Precios");
	if(count($arraySQL) > 0)
	{
		return  $arraySQL[0];
	}
	else
	{
		return NULL;
	}
}
function insertarPrecioOriginal($precio)
{
	if(existePrecioOriginal($precio))
	{
		return;
	}
	else
	{
		$sql = "INSERT INTO `precio_original` (`id_Precios`, `precio_original`) VALUES (NULL, '$precio')";
		if(DEBUG)
			echo $sql."<br>";
		$resultado=mysql_query($sql);
		if(DEBUG)
			echo "Registro dado de alta $resultado <br>";
	}
}
function updatePrecioOriginal($precio,$nuevoPrecio)
{
	$id_Precio = get_Id_PrecioOriginal($precio);
	$sql = "UPDATE precio_original SET precio_original = '$nuevoPrecio' WHERE id_Precios = $id_Precio";
	$sqlElement = ejecutar_sql($sql);
}
function  updatePrecioOriginalLargoAncho($precio,$nuevoPrecio,$id_diametro,$id_largo)
{
	$id_viejoPrecio = get_Id_PrecioOriginalLargoAncho($id_diametro,$id_largo);
	$id_nuevoPrecio = get_Id_PrecioOriginal($nuevoPrecio);
	echo " _".$id_nuevoPrecio."_ ";
	if( $id_nuevoPrecio == NULL)
	{
		insertarPrecioOriginal($nuevoPrecio);
		$id_nuevoPrecio = get_Id_PrecioOriginal($nuevoPrecio);
	}
	$sql = "UPDATE tabla_precios_original SET id_Precios = '$id_nuevoPrecio' WHERE id_Precios = $id_viejoPrecio AND id_diametro = $id_diametro AND id_largo = $id_largo";
	echo  $sql;
	$sqlElement = ejecutar_sql($sql);
}
function existePrecioOriginal($precio)
{
	$sql = "SELECT id_Precios FROM precio_original WHERE precio_original  = '$precio'";
	$arraySQL = sql_to_Array($sql,"id_Precios");

	if(count($arraySQL) > 0)
		return true;
	return false;
}
function insertaTablaPrecioOriginal($id_precios,$id_diametro,$id_largo)
{
	if(existeTablaPreciosOriginal($id_precios,$id_diametro,$id_largo))
	{
		return;
	}
	else
	{
		$sql = "INSERT INTO `tabla_precios_original` (`id_Precios`, `id_diametro`, `id_largo`) VALUES ('$id_precios', '$id_diametro', '$id_largo')";
		// 		if(DEBUG)
		echo $sql."<br>";
		$resultado=mysql_query($sql);
		if(DEBUG)
			echo "Registro dado de alta $resultado <br>";

	}
}
function existeTablaPreciosOriginal($id_precios,$id_diametro,$id_largo)
{
	$sql = "SELECT id_Precios FROM tabla_precios_original WHERE id_Precios = $id_precios AND id_diametro = $id_diametro AND id_largo = $id_largo";
	$arraySQL = sql_to_Array($sql,"id_Precios");

	if(count($arraySQL) > 0)
		return true;
	return false;
}
//////////////////////////////////////Tabla

function insertTabla($id_material,$id_observacion) {
	$sql = "INSERT INTO tabla_pedido (`id_tabla_pedido`, `id_material`, `id_observacion`) VALUES (NULL, $id_material, $id_observacion)";
}

function insertarObservacion($observacion)
 {
	$sql = "INSERT INTO observacion (`id_observacion`, `observacion`) VALUES (NULL, '$observacion')";
}

function insertarMaterial($material)
{
	$sql = "INSERT INTO material (`id_material`, `nombre`) VALUES (NULL, '$material')";
}
function get_Max_Id_Columna()
{
	$sql = "SELECT MAX(id_fila_diametro) FROM tabla_fila_diametro";
	return sql_to_Element($sql, "MAX(id_fila_diametro)");
	
}
function get_Max_Id_Fila()
{
	$sql = "SELECT MAX(id_columna_largo) FROM tabla_columna_largo";
	return sql_to_Element($sql, "MAX(id_columna_largo)");	
}
function nuevaTabla()
{
	$sql = "SELECT MAX(id_tabla_pedido) FROM tabla_pedido WHERE 1";
	$id_tabla_pedido = sql_to_Element($sql,'MAX(id_tabla_pedido)') + 1;
	$sql = "SELECT MAX(id_tabla_pedido) FROM tabla_pedido WHERE 1";
	$id_tabla_pedido = sql_to_Element($sql,'MAX(id_tabla_pedido)') + 1;
	$id_diametro = get_Id_Diametro(0);
	if($id_diametro == NULL)
	{
		insertarDiametro(0);
		$id_diametro = get_Id_Diametro ( 0 );
	}
	
	$id_largo = get_Id_Largo(0);
	if($id_largo == NULL)
	{
		insertarLargo(0);
		$id_largo = get_Id_Largo ( 0 );
	}
	echo "numero: ".$id_tabla_pedido."<br>";
	$id_columna= get_Max_Id_Columna() + 1;
	insertarFila_Id_Diametro($id_columna,$id_diametro);
	
	$id_fila = get_Max_Id_Fila() + 1;
	insertarColumna_Id_Largo($id_fila,$id_largo);
	
// 	$sql = "INSERT INTO tabla_columna_largo (`id_columna_largo`, `id_largo`) VALUES ('2', '1')";
// 	$sql = "INSERT INTO `ditsa2`.`tabla_columna_largo` (`id_columna_largo`, `id_largo`) VALUES ('2', '1')";
}