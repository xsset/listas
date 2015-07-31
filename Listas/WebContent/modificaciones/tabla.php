<html>
<head>
<script src="../js/jquery-2.1.1.min.js"></script>
<script src="../js/jquery-ui-1.11.0.custom/jquery-ui.min.js"></script>
<script src="../js/jquery-ui-1.11.0.custom/jquery-ui.js"></script>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"
	media="screen">
<script src="../bootstrap/js/bootstrap.min.js"></script>
<link href="../css/MyStyle.css" rel="stylesheet">
<script src="../js/utilidades.js"></script>
</head>
<body>
	<?php
		require_once (dirname ( __FILE__ ) . '/../lib/library.php');
		connectar();
		nuevaTabla();
		tabla_Texto();
		function tablaIndex($index)
		{
			echo "index".$index;
			//$tabla = select_to_Array('tabla_pedido');
			
			$tabla = select_to_Array_index('tabla_pedido',$index,'id_tabla_pedido');
		
			print_r($tabla);
			$idMaterial = $tabla[0][1];
			$idObservaciones = $tabla[0][2];
			$idFila  = getFila($tabla[0][0]);
			$idColumna = getColumna($tabla[0][0]);
			$fila = fila($idFila);
			$diametro = diametro($idColumna);
			
// 			if (DEBUG)
// 			{
				echo "<br>";
				echo "table id: ".$tabla[0][0]."<br>";
				echo "material id:: ".$idMaterial."<br>";
				echo "Observacion id:: ".$idObservaciones."<br>";
				
				echo "material: ". getMaterial($idMaterial)."<br>";
				echo "Observacion: ". getObservaciones($idObservaciones)."<br>";
				echo "id_Fila: ". $idFila."<br>";
				echo "id_Columna: ".$idColumna."<br>";
				echo "fila: ";
				print_r($fila);
				echo "<br> ";
				echo "diametro: ";
				print_r($diametro);
				echo "<br>";
// 			}
			?>
			<h1>ENCABEZADO</h1>
			<div>
			<strong>MATERIAL: <?php echo getMaterial($idMaterial)?></strong>
				</div>
				<BR>
				<div>OBSERVACION:<?php echo getObservaciones($idObservaciones)?></div>
				<BR>
				<form>
					<input type="radio" name="tipo" value="original" id="checkOriginal" checked>Precio Proveedor
					<input type="radio" name="tipo" value="porcentaje" id="checkPorcentaje" >Porcentaje
					<input type="radio" name="tipo" value="final" id="checkFinal" >Precio Final
				</form>
				<script>
					id_tabla = <?php echo $index ?>;
					id_tipo_tabla = PRECIOORIGINAL;
					$("#checkOriginal").change(function () {
						id_tipo_tabla = PRECIOORIGINAL;
						console.error("tabla tipo: "+ id_tipo_tabla);
					});
					$("#checkPorcentaje").change(function () {
						id_tipo_tabla = PORCENTAJE;
						console.error("tabla tipo: "+ id_tipo_tabla);
					});
					$("#checkFinal").change(function () {
						id_tipo_tabla = PRECIOFINAL;
						console.error("tabla tipo: "+ id_tipo_tabla);
					});
				</script>
				<table class="claseBordes table table-bordered table-hover">
					<tr class="claseBordes">
						<th> --
						</th>
<!--*** -->
						<?php
							for($index_diametro = 0; $index_diametro < count ( $diametro ); $index_diametro ++)
							{
						?>
					<th class='tableDiametro claseBordes'
							id='columna<?php echo $index_diametro?>'>
							<p id='fieldClick'>
									<?php echo $diametro[$index_diametro]?>
									</p>
						</th>
						<script>
					//************************* Diametro
									$('#columna<?php echo $index_diametro?>').on('click', '#fieldClick', function()  {
										$(this).replaceWith("<input size='1' id='field' type='text' value='<?php echo $diametro[$index_diametro] ?>'>");
										$('#field').focus();
										$('#field').focusEnd();
										actual = $('#field').val();
										$('#columna<?php echo $index_diametro?>').on('blur', '#field', function()  
										{
											nuevo = $('#field').val();
											if(nuevo)
											{
												if(actual != nuevo)
												{
													$(this).replaceWith("<p id = 'fieldClick'>"+nuevo+"</p>");
					// 								event.preventDefault();
													updateDiametro(actual,nuevo);	
												}
												else
												{
													$(this).replaceWith("<p id = 'fieldClick'>"+actual+"</p>");
												}
											}
										});
										$('#columna<?php echo $index_diametro?>').on('keydown', '#field',function( event ) 
										{
											nuevo = $('#field').val();
											if ( event.which == 13 ) 
											{
												if(nuevo)
												{
													if(actual != nuevo)
													{
														$(this).replaceWith("<p id = 'fieldClick'>"+nuevo+"</p>");
					// 						    		event.preventDefault();
														updateDiametro(actual,nuevo);
													}
													else
													{
														$(this).replaceWith("<p id = 'fieldClick'>"+actual+"</p>");
													}
												}
											}
										});
									});
								</script>
<!-- 	*** -->
					<?php 
							}
							echo "</tr>\n";
							for ($index_largo = 0;$index_largo < count($fila); $index_largo++ )
							{
								echo "<tr class=\"claseBordes\">\n";
								?>
								<th class='tableFila claseBordes' id='fila<?php echo $index_largo?>'>
							<p id='fieldClick'>
									<?php echo $fila[$index_largo]?>
								</p>
						</th>
						<script>
					//************************* Largo
								var actual = 0;
								var nuevo = 0;
								$('#fila<?php echo $index_largo?>').on('click', '#fieldClick', function()  
								{
									$(this).replaceWith("<input size='1' id='field' type='text' value='<?php echo $fila[$index_largo] ?>'>");
									$('#field').focus();
									$('#field').focusEnd();
							 		actual = $('#field').val();
									$('#fila<?php echo $index_largo?>').on('blur', '#field', function()  
									{
										nuevo = $('#field').val();
										if(nuevo)
										{
											if(actual != nuevo)
											{
												updateLargo(actual,nuevo);
												$(this).replaceWith("<p id = 'fieldClick'>"+nuevo+"</p>");
					// 					event.preventDefault();
											}
											else
											{
												$(this).replaceWith("<p id = 'fieldClick'>"+actual+"</p>");
											}
										}
										else
										{
											$(this).replaceWith("<p id = 'fieldClick'>"+actual+"</p>");
										}
									});
									$('#fila<?php echo $index_largo?>').on('keydown', '#field',function( event ) 
									{
									nuevo = $('#field').val();
									if ( event.which == 13 ) 
									{
										if(nuevo)
										{
											if(actual != nuevo)
											{
												updateLargo(actual,nuevo);
												$(this).replaceWith("<p id = 'fieldClick'>"+nuevo+"</p>");
					// 			    		event.preventDefault();
											}
											else
											{
												$(this).replaceWith("<p id = 'fieldClick'>"+actual+"</p>");
											}
										}
										else
										{
											$(this).replaceWith("<p id = 'fieldClick'>"+actual+"</p>");
										}
									}
								});
							});
							</script>
<!-- *****					 -->
					<?php 
						//************************* Precios
							for ($index_diametro = 0;$index_diametro < count($diametro); $index_diametro++ )
							{
								echo "(".$index_diametro.",".$index_largo.") ";
							?>
								<td class='tableFila claseBordes'
									id='valor<?php echo $index_diametro.'-'.$index_largo?>'>
									<p id='fieldClick'>
										<script>
											var valor ="";
// 											console.log( "entro"  );
											//	return getPrecio(<?php echo $index_diametro?>,<?php echo$index_largo?>);
											if (id_tipo_tabla == PRECIOORIGINAL)
											{
												console.log( "Precio Original"  );
												valor =  getPrecioOriginal(<?php echo $index_diametro?>,<?php echo$index_largo?>);
											}
											else if (id_tipo_tabla == PRECIOFINAL)
											{
												console.log( "Precio Final "  );
											//	valor = getPrecio(<?php echo $index_diametro?>,<?php echo$index_largo?>);
											}
											else if (id_tipo_tabla == PORCENTAJE)
											{
// 												console.log( "Porcentaje Antes"  );
												//console.log( "<?php echo $index_diametro?>,<?php echo$index_largo?>");
												valor = getPorcentaje(<?php echo $index_diametro?>,<?php echo$index_largo?>);
											}
											//val = 0;
											//console.log( "var Precio: " + precio );
			// 								precio = "1";
											if(!isInt(valor))
											{
												valor = 0;
												if (id_tipo_tabla == PRECIOORIGINAL)
												{
	 												console.log( "Precio Original"  );
													insertarPrecioOriginal(valor,<?php echo $index_diametro?>,<?php echo$index_largo?>);
												}
												else if (id_tipo_tabla == PRECIOFINAL)
												{
	 												console.log( "Precio Final "  );
													insertarPrecio(valor,<?php echo $index_diametro?>,<?php echo$index_largo?>);
												}
												else if (id_tipo_tabla == PORCENTAJE)
												{
	 												console.log( "Se insertara "+"<?php echo $index_diametro?>,<?php echo$index_largo?>"  );
	 												//console.log( "<?php echo $index_diametro?>,<?php echo$index_largo?>");
													insertarPorcentaje(valor,<?php echo $index_diametro?>,<?php echo$index_largo?>);
												}
												//insertarPrecio(valor,<?php echo $index_diametro?>,<?php echo$index_largo?>);
											}
											document.write(valor);
										</script>
									</p>
								</td>
								<script>
									
									$('#valor<?php echo $index_diametro."-".$index_largo?>').on('click', '#fieldClick', function()  {
										//var precio = getPrecio(<?php echo $index_diametro?>,<?php echo$index_largo?>;
										var valor = "";
// 												console.log( "valor"+ id_tipo_tabla  );
											//	return getPrecio(<?php echo $index_diametro?>,<?php echo$index_largo?>);
											if (id_tipo_tabla == PRECIOORIGINAL)
											{
// 												console.log( "Precio Original"  );
												valor =  getPrecioOriginal(<?php echo $index_diametro?>,<?php echo$index_largo?>);
											}
											else if (id_tipo_tabla == PRECIOFINAL)
											{
// 												console.log( "Precio Final "  );
												valor = getPrecio(<?php echo $index_diametro?>,<?php echo$index_largo?>);
											}
											else if (id_tipo_tabla == PORCENTAJE)
											{
// 												console.log( "Porcentaje"  );
												valor =  getPorcentaje(<?php echo $index_diametro?>,<?php echo$index_largo?>);
											}
										//val = 0;
			// 							alert(precio);
// 										if(valor)
// 										{
// 										}
// 										else
// 										{
											
// 											alert("No hay precio, se insertara unp nuevo");
											//insertarPrecio(valor,<?php echo $index_diametro?>,<?php echo$index_largo?>);
// 			// 								precio = 0;
											
// 										}
										
										$(this).replaceWith("<input size='1' id='field' type='text' value='"+valor+"'>");
										$('#field').focus();
										$('#field').focusEnd();
										actual = $('#field').val();
										$('#valor<?php echo $index_diametro."-".$index_largo?>').on('blur', '#field', function()  
										{
											nuevo = $('#field').val();
											if(nuevo)
											{
												if(actual != nuevo)
												{
													$(this).replaceWith("<p id = 'fieldClick'>"+nuevo+"</p>");
					// 								event.preventDefault();
													if (id_tipo_tabla == PRECIOORIGINAL)
													{
//		 												console.log( "Precio Original"  );
														updatePrecioOriginal(actual,nuevo,<?php echo $index_diametro?>,<?php echo$index_largo?>);	
													//	valor =  getPrecio(<?php echo $index_diametro?>,<?php echo$index_largo?>);
													}
													else if (id_tipo_tabla == PRECIOFINAL)
													{
//		 												console.log( "Precio Final "  );
														updatePrecio(actual,nuevo,<?php echo $index_diametro?>,<?php echo$index_largo?>);	
													//	valor = getPrecio(<?php echo $index_diametro?>,<?php echo$index_largo?>);
													}
													else if (id_tipo_tabla == PORCENTAJE)
													{
		 												console.log( "Update Porcentaje"  );
														updatePorcentaje(actual,nuevo,<?php echo $index_diametro?>,<?php echo$index_largo?>);	
													//	valor =  getPorcentaje(<?php echo $index_diametro?>,<?php echo$index_largo?>);
													}
												}
												else
												{
													$(this).replaceWith("<p id = 'fieldClick'>"+actual+"</p>");
												}
											}
										});
										$('#valor<?php echo $index_diametro."-".$index_largo?>').on('keydown', '#field',function( event ) 
										{
											nuevo = $('#field').val();
											if ( event.which == 13 ) 
											{
												if(nuevo)
												{
													if(actual != nuevo)
													{
														$(this).replaceWith("<p id = 'fieldClick'>"+nuevo+"</p>");
														if (id_tipo_tabla == PRECIOORIGINAL)
														{
//			 												console.log( "Precio Original"  );
															updatePrecioOriginal(actual,nuevo,<?php echo $index_diametro?>,<?php echo$index_largo?>);	
														//	valor =  getPrecio(<?php echo $index_diametro?>,<?php echo $index_largo?>);
														}
														else if (id_tipo_tabla == PRECIOFINAL)
														{
//			 												console.log( "Precio Final "  );
															updatePrecio(actual,nuevo,<?php echo $index_diametro?>,<?php echo $index_largo?>);	
														//	valor = getPrecio(<?php echo $index_diametro?>,<?php echo $index_largo?>);
														}
														else if (id_tipo_tabla == PORCENTAJE)
														{
//			 												console.log( "Porcentaje"  );
															updatePorcentaje(actual,nuevo,<?php echo $index_diametro?>,<?php echo $index_largo?>);	
														//	valor =  getPorcentaje(<?php echo $index_diametro?>,<?php echo $index_largo?>);
														}
													}
													else
													{
														$(this).replaceWith("<p id = 'fieldClick'>"+actual+"</p>");
													}
												}
											}
										});
									});
									
									</script>
					<?php 
								}
								echo "</tr>\n";
							}		
							echo "</table>\n";
						
		}
		
		function tabla_Texto()
		{
			$tabla = select_to_Array('tabla_pedido');
		
			for ($indexTabla = 1;$indexTabla <= count($tabla) ; $indexTabla++ )
			{
// 				$idMaterial = $tabla[$indexTabla][1];
// 				$idObservaciones = $tabla[$indexTabla][2];
// 				$idFila  = getFila($tabla[$indexTabla][0]);
// 				$idColumna = getColumna($tabla[$indexTabla][0]);
// 				$fila = fila($idFila);
// 				$diametro = diametro($idColumna);
		
						
				tablaIndex($indexTabla);
			
			}
		}
	?>
	



</body>
</html>