
<?php
require_once(dirname(__FILE__).'/../lib/library.php');
connectar();
print_r( nombre_Columnas_Tabla('largo'));
echo contar_Columnas_Tabla('largo');
select_to_Array('tabla_pedido');
?>