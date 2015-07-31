--CREATE TABLE precios();
CREATE TABLE material(
	id_material int NOT NULL AUTO_INCREMENT,
	nombre varchar(100),
	PRIMARY KEY (id_material));
	
CREATE TABLE observacion(	
	id_observacion int NOT NULL AUTO_INCREMENT,
	observacion varchar(100),
	PRIMARY KEY (id_observacion));
	
CREATE TABLE diametro(
	id_diametro int NOT NULL AUTO_INCREMENT,
	diametro varchar(50),
	PRIMARY KEY (id_diametro));
	
CREATE TABLE largo(
	id_largo int  NOT NULL AUTO_INCREMENT,
	largo varchar(50),
	PRIMARY KEY (id_largo));

CREATE TABLE opciones(
	id_opciones int  NOT NULL AUTO_INCREMENT,
	opcion varchar (100),
	PRIMARY KEY (id_opciones));

CREATE TABLE fila_diametro(
	id_fila_diametro int NOT NULL AUTO_INCREMENT, 
	id_diametro int, 
	num_columna int,
	PRIMARY KEY (id_fila_diametro));
	
CREATE TABLE columna_largo(
	id_columna_largo int NOT NULL AUTO_INCREMENT, 
	id_largo int, 
	num_fila int,
	PRIMARY KEY (id_columna_largo));
	
CREATE TABLE tabla_pedido(
	id_tabla_pedido int NOT NULL AUTO_INCREMENT,
	id_material int, 
	id_observacion int,
	id_fila_diametro int, 
	id_columna_largo int,
	PRIMARY KEY (id_tabla_pedido));
	
	
	
INSERT INTO `ditsa`.`material` (`id_material`, `nombre`) VALUES (NULL, 'TORNILLO HEXAGONAL NEGRO UNC S/TUERCA');
INSERT INTO `ditsa`.`observacion` (`id_observacion`, `observacion`) VALUES (NULL, 'PRECIO POR PIEZA – DESCUENTO MAXIMO __________%');
INSERT INTO `ditsa`.`diametro` (`id_diametro`, `diametro`) VALUES (NULL, '5/16');
INSERT INTO `ditsa`.`largo` (`id_largo`, `largo`) VALUES (NULL, '1/2');
INSERT INTO `ditsa`.`opciones` (`id_opciones`, `opcion`) VALUES (NULL, 'TUERCAS');
INSERT INTO `ditsa`.`fila_diametro` (`id_fila_diametro`, `id_diametro`, `num_columna`) VALUES (NULL, '1', '1');
INSERT INTO `ditsa`.`columna_largo` (`id_columna_largo`, `id_largo`, `num_fila`) VALUES (NULL, '1', '1');
INSERT INTO `ditsa`.`tabla_pedido` (`id_tabla_pedido`, `id_material`, `id_observacion`, `id_fila_diametro`, `id_columna_largo`) VALUES (NULL, '1', '1', '1', '1');

