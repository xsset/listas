/**
 * 
 */

const DEBUG = true;
const LARGO = 0;
const DIAMETRO = 1;
const PRECIO = 2;
const PRECIOORIGINAL = 3;
const PORCENTAJE = 4;
const PRECIOFINAL = 5;


function cambiarPagina(url)
{
	location.href=url;
}

$.fn.selectRange = function(start, end) {
	return this.each(function() {
		if (this.setSelectionRange) {
			this.focus();
			this.setSelectionRange(start, end);
		} else if (this.createTextRange) {
			var range = this.createTextRange();
			range.collapse(true);
			range.moveEnd('character', end);
			range.moveStart('character', start);
			range.select();
		}
	});
};
//set cursor position
$.fn.setCursorPosition = function(position){
	if(this.length == 0) return this;
	return $(this).setSelection(position, position);
};

//set selection range
$.fn.setSelection = function(selectionStart, selectionEnd) {
	if(this.length == 0) return this;
	input = this[0];

	if (input.createTextRange) {
		var range = input.createTextRange();
		range.collapse(true);
		range.moveEnd('character', selectionEnd);
		range.moveStart('character', selectionStart);
		range.select();
	} else if (input.setSelectionRange) {
		input.focus();
		input.setSelectionRange(selectionStart, selectionEnd);
	}
	return this;
};


//Set focus to beginning of input:
$.fn.focusEnd = function(){
	this.setCursorPosition(this.val().length);
};


//Set focus to end of input:
$.fn.focusStart = function(){
	this.setCursorPosition(0);
};


function updateLargo(actual,nuevo)
{
	 $.get( "../update/update.php", { recurso:LARGO,nuevoLargo: nuevo, largo: actual } )
	 .done(function( data ) {
		 alert( "Data Loaded: " + data );
	 }).error( function(d, textStatus, error) {
			if(DEBUG)
			{
	      		console.error("get fallo, estado: " + textStatus + ", error: "+error)
	      		
			}
			alert("Error para guardar compruebe la conexión");
	 }
	 );
}
function updateDiametro(actual,nuevo)
{
	 $.get( "../update/update.php", { recurso:DIAMETRO,nuevoDiametro: nuevo, diametro: actual } )
	 .done(function( data ) {
		 alert( "Data Loaded: " + data );
	 }).error( function(d, textStatus, error) {
			if(DEBUG)
			{
	      		console.error("get fallo, estado: " + textStatus + ", error: "+error)
			}
			alert("Error para guardar compruebe la conexión");
	 }
	 );
}
function updatePrecio(actual,nuevo,id_Diametro,id_Largo)
{
	$.get( "../update/update.php", { recurso:PRECIO,nuevoPrecio: nuevo, precio: actual, idLargo: id_Largo,idDiametro:id_Diametro } )
	.done(function( data ) {
	console.error("Data Loaded: " + data );
	}).error( function(d, textStatus, error) {
		if(DEBUG)
		{
			console.error("get fallo, estado: " + textStatus + ", error: "+error)
			
		}
		alert("Error para guardar compruebe la conexión");
	}
	);
}
function getPrecio(id_Diametro,id_Largo)
{
	var result = null;
    var scriptUrl = "../get/get.php?recurso=" + PRECIO+"&id_largo="+id_Largo+"&id_diametro="+id_Diametro;
    console.error("get url: " + scriptUrl);
    $.ajax({
       url: scriptUrl,
       type: 'get',
       dataType: 'html',
       async: false,
       success: function(data) {    	   
    	   console.error("precio data: " + data);
           result = data;
       } 
    });
    return result;
}
function insertarPrecio(valor_Precio,id_Diametro,id_Largo)
{
	$.get( "../insert/insert.php?", { recurso:PRECIO,id_largo: id_Largo, id_diametro: id_Diametro,precio:valor_Precio } )
	.done(function( data ) {
//		alert( "Data Loaded: " + data );
	}).error( function(d, textStatus, error) {
		if(DEBUG)
		{
			console.error("get fallo, estado: " + textStatus + ", error: "+error)
			
		}
		alert("Error para guardar compruebe la conexión");
	}
	);
}



function updatePorcentaje(actual,nuevo,id_Diametro,id_Largo)
{
	$.get( "../update/update.php", { recurso:PORCENTAJE,nuevoPrecio: nuevo, precio: actual, idLargo: id_Largo,idDiametro:id_Diametro } )
	.done(function( data ) {
		console.error("Data Loaded: " + data );
	}).error( function(d, textStatus, error) {
		if(DEBUG)
		{
			console.error("get fallo, estado: " + textStatus + ", error: "+error)
			
		}
		alert("Error para guardar compruebe la conexión");
	}
	);
}
function getPorcentaje(id_Diametro,id_Largo)
{
	var result = null;
    var scriptUrl = "../get/get.php?recurso=" + PORCENTAJE+"&id_diametro="+id_Diametro+"&id_largo="+id_Largo;
    console.error("get url: " + scriptUrl);
    $.ajax({
       url: scriptUrl,
       type: 'get',
       dataType: 'html',
       async: false,
       success: function(data) {    	   
    	   console.error("porcentaje data: " + data);
           result = data;
       } 
    });
    return result;
}
function insertarPorcentaje(valor_Precio,id_Diametro,id_Largo)
{
	
	console.error("Entro insertar");
	
	$.get( "../insert/insert.php?", { recurso:PORCENTAJE, id_diametro: id_Diametro ,id_largo: id_Largo ,porcentaje:valor_Precio } )
	.done(function( data ) {
//		if(DEBUG)
//		{
			console.error("Data Loaded Insertar: " + data);
			
//		}
//		alert( "Data Loaded: " + data );
	}).error( function(d, textStatus, error) {
		if(DEBUG)
		{
			console.error("get fallo, estado: " + textStatus + ", error: "+error);
			
		}
		alert("Error para guardar compruebe la conexión");
	}
	);
}

function updatePrecioOriginal(actual,nuevo,id_Diametro,id_Largo)
{
	$.get( "../update/update.php", { recurso:PRECIOORIGINAL,nuevoPrecio: nuevo, precioOriginal: actual, idLargo: id_Largo,idDiametro:id_Diametro } )
	.done(function( data ) {
		console.error("Data Loaded: " + data );
	}).error( function(d, textStatus, error) {
		if(DEBUG)
		{
			console.error("get fallo, estado: " + textStatus + ", error: "+error)
			
		}
		alert("Error para guardar compruebe la conexión");
	}
	);
}
function getPrecioOriginal(id_Diametro,id_Largo)
{
	var result = null;
    var scriptUrl = "../get/get.php?recurso=" + PRECIOORIGINAL+"&id_diametro="+id_Diametro+"&id_largo="+id_Largo;
    console.error("get url: " + scriptUrl);
    $.ajax({
       url: scriptUrl,
       type: 'get',
       dataType: 'html',
       async: false,
       success: function(data) {    	   
//    	   console.error("Original data: " + data);
           result = data;
       } 
    });
    return result;
}
function insertarPrecioOriginal(valor_Precio,id_Diametro,id_Largo)
{
	
	console.error("Entro insertar");
	
	$.get( "../insert/insert.php?", { recurso:PRECIOORIGINAL, id_diametro: id_Diametro ,id_largo: id_Largo ,precioOriginal:valor_Precio } )
	.done(function( data ) {
//		if(DEBUG)
//		{
			console.error("Data Loaded Insertar: " + data);
			
//		}
//		alert( "Data Loaded: " + data );
	}).error( function(d, textStatus, error) {
		if(DEBUG)
		{
			console.error("get fallo, estado: " + textStatus + ", error: "+error);
			
		}
		alert("Error para guardar compruebe la conexión");
	}
	);
}

function isInt(x) {
	   var y = parseInt(x, 10);
	   return !isNaN(y) && x == y && x.toString() == y.toString();
	}
