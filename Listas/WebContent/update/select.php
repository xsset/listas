<?php
	include("../lib/data.php");
	include("../lib/library.php");
	connectar();
	$recurso = $_GET['recurso'];
	$elemnto = $_GET['elemento'];
	if (DEBUG) {
// 		echo $recurso;
}
	if ($elemnto == ID) {
		
		if ($recurso == LARGO) {
			if (DEBUG)
// 				echo "LARGO";
			$largo = $_GET ['largo'];
			$id_largo = get_Id_Largo($largo);
			echo $id_largo;
		} else if ($recurso == DIAMETRO) {
			$nuevoDiametro = $_GET ['nuevoDiametro'];
			$diametro = $_GET ['diametro'];
			if (DEBUG)
				echo "DIAMETRO";
			updateDiametro ( $diametro, $nuevoDiametro );
		}
	}

?>