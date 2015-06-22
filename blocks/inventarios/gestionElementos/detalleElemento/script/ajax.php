<?php
/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */

// URL base
$url = $this->miConfigurador->getVariableConfiguracion ( "host" );
$url .= $this->miConfigurador->getVariableConfiguracion ( "site" );

$urlDirectorio = $url;

$urlDirectorio = $urlDirectorio . "/plugin/scripts/javascript/dataTable/Spanish.json";

$url .= "/index.php?";

// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar .= "&procesarAjax=true";
$cadenaACodificar .= "&action=index.php";
$cadenaACodificar .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar .= $cadenaACodificar . "&funcion=Consulta";
$cadenaACodificar .= "&tiempo=" . $_REQUEST ['tiempo'];

if (isset ( $_REQUEST ['fecha_inicio'] ) && $_REQUEST ['fecha_inicio'] != '') {
	$fechaInicio = $_REQUEST ['fecha_inicio'];
} else {
	$fechaInicio = '';
}

if (isset ( $_REQUEST ['fecha_final'] ) && $_REQUEST ['fecha_final'] != '') {
	$fechaFinal = $_REQUEST ['fecha_final'];
} else {
	$fechaFinal = '';
}

if (isset ( $_REQUEST ['placa'] ) && $_REQUEST ['placa'] != '') {
	$placa = $_REQUEST ['placa'];
} else {
	$placa = '';
}

if (isset ( $_REQUEST ['serie1'] ) && $_REQUEST ['serie1'] != '') {
	$serie = $_REQUEST ['serie1'];
} else {
	$serie = '';
}


if (isset ( $_REQUEST ['id_entrada'] ) && $_REQUEST ['id_entrada'] != '') {
	$entrada = $_REQUEST ['id_entrada'];
} else {
	$entrada = '';
}


if (isset ( $_REQUEST ['id_funcionario'] ) && $_REQUEST ['id_funcionario'] != '') {
	$funcionario = $_REQUEST ['id_funcionario'];
} else {
	$funcionario = '';
}



if (isset ( $_REQUEST ['id_sede'] ) && $_REQUEST ['id_sede'] != '') {
	$sede = $_REQUEST ['id_sede'];
} else {
	$sede = '';
}


if (isset ( $_REQUEST ['id_dependencia'] ) && $_REQUEST ['id_dependencia'] != '') {
	$dependencia = $_REQUEST ['id_dependencia'];
} else {
	$dependencia = '';
}









$arreglo = array (
		"fecha_inicio" => $fechaInicio,
		"fecha_final" => $fechaFinal,
		"placa" => $placa,
		"serie" => $serie,
		"entrada"=>$entrada,
		"funcionario"=>$funcionario,
		"sede"=>$sede,
		"dependencia"=>$dependencia
);



$arreglo = serialize ( $arreglo );

$cadenaACodificar .= "&arreglo=" . $arreglo;

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar, $enlace );

// URL definitiva
$urlFinal = $url . $cadena;
// echo $urlFinal;

// Variables
$cadenaACodificar1 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar1 .= "&procesarAjax=true";
$cadenaACodificar1 .= "&action=index.php";
$cadenaACodificar1 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar1 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar1 .= "&funcion=consultaPlacas";
$cadenaACodificar1 .= "&tiempo=" . $_REQUEST ['tiempo'];



// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar1, $enlace );

// URL definitiva
$urlFinal1 = $url . $cadena;





// Variables
$cadenaACodificar2 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar2 .= "&procesarAjax=true";
$cadenaACodificar2 .= "&action=index.php";
$cadenaACodificar2 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar2 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar2 .= "&funcion=consultaSerie";
$cadenaACodificar2 .= "&tiempo=" . $_REQUEST ['tiempo'];



// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar2, $enlace );

// URL definitiva
$urlFinal2 = $url . $cadena;



// Variables
$cadenaACodificar3 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar3 .= "&procesarAjax=true";
$cadenaACodificar3 .= "&action=index.php";
$cadenaACodificar3 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar3 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar3 .= "&funcion=consultaEntrada";
$cadenaACodificar3 .= "&tiempo=" . $_REQUEST ['tiempo'];



// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar3, $enlace );

// URL definitiva
$urlFinal3 = $url . $cadena;



// Variables
$cadenaACodificar4 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar4 .= "&procesarAjax=true";
$cadenaACodificar4 .= "&action=index.php";
$cadenaACodificar4 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar4 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar4 .= "&funcion=consultaFuncionario";
$cadenaACodificar4 .= "&tiempo=" . $_REQUEST ['tiempo'];



// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar4, $enlace );

// URL definitiva
$urlFinal4 = $url . $cadena;




// Variables
$cadenaACodificar5 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar5 .= "&procesarAjax=true";
$cadenaACodificar5 .= "&action=index.php";
$cadenaACodificar5 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar5 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar5 .= "&funcion=consultaSede";
$cadenaACodificar5 .= "&tiempo=" . $_REQUEST ['tiempo'];



// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar5, $enlace );

// URL definitiva
$urlFinal5 = $url . $cadena;





// Variables
$cadenaACodificar6 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar6 .= "&procesarAjax=true";
$cadenaACodificar6 .= "&action=index.php";
$cadenaACodificar6 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar6 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar6 .= "&funcion=consultaDependencia";
$cadenaACodificar6 .= "&tiempo=" . $_REQUEST ['tiempo'];



// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar6, $enlace );

// URL definitiva
$urlFinal6 = $url . $cadena;

 





?>
<script type='text/javascript'>


$(document).ready(function () {


	var sede='listo';
	
    $("#<?php echo $this->campoSeguro('placa') ?>").autocomplete({
    	minChars: 4,
    	serviceUrl: '<?php echo $urlFinal1; ?>',
                
    });

    $("#<?php echo $this->campoSeguro('serie1') ?>").autocomplete({
    	minChars: 4,
    	serviceUrl: '<?php echo $urlFinal2; ?>',
                
    });


    $("#<?php echo $this->campoSeguro('entrada') ?>").autocomplete({
    	minChars: 1,
    	serviceUrl: '<?php echo $urlFinal3; ?>',
    	onSelect: function (suggestion) {
    	        $("#<?php echo $this->campoSeguro('id_entrada') ?>").val(suggestion.data);
    	    }
                
    });

    

    $( "#<?php echo $this->campoSeguro('funcionario')?>" ).keyup(function() {

	$('#<?php echo $this->campoSeguro('funcionario') ?>').val($('#<?php echo $this->campoSeguro('funcionario') ?>').val().toUpperCase());
        });



    
    $("#<?php echo $this->campoSeguro('funcionario') ?>").autocomplete({
    	minChars: 4,
    	serviceUrl: '<?php echo $urlFinal4; ?>',
    	onSelect: function (suggestion) {
        	
    	        $("#<?php echo $this->campoSeguro('id_funcionario') ?>").val(suggestion.data);
    	    }
                
    });
    

    $( "#<?php echo $this->campoSeguro('sede')?>" ).keyup(function() {

	$('#<?php echo $this->campoSeguro('sede') ?>').val($('#<?php echo $this->campoSeguro('sede') ?>').val().toUpperCase());
        });

    
    

    $("#<?php echo $this->campoSeguro('sede') ?>").autocomplete({
    	minChars: 4,
    	serviceUrl: '<?php echo $urlFinal5; ?>',
    	onSelect: function (suggestion) {
    	        $("#<?php echo $this->campoSeguro('id_sede')?>").val(suggestion.data);
				
    	    }
                
    });



    $( "#<?php echo $this->campoSeguro('dependencia')?>" ).keyup(function() {

	$('#<?php echo $this->campoSeguro('dependencia') ?>').val($('#<?php echo $this->campoSeguro('dependencia') ?>').val().toUpperCase());
        });

    


    $("#<?php echo $this->campoSeguro('dependencia') ?>").autocomplete({
    	minChars: 1,
    	serviceUrl: '<?php echo $urlFinal6 ?>',
    	params:{ 
            'valor': function() {
                return $("#<?php echo $this->campoSeguro('id_sede')?>").val();
            	}
    	},
		onSelect: function (suggestion) {
    	        $("#<?php echo $this->campoSeguro('id_dependencia') ?>").val(suggestion.data);
    	    }
                
    });
    
    
    
    
});




$(function() {
	
         	$('#tablaTitulos').ready(function() {

             $('#tablaTitulos').dataTable( {
             	serverSide: true,
				language: {
                url: "<?php echo $urlDirectorio?>"
            			},
             	processing: true,
                ajax:"<?php echo $urlFinal?>",
                  
             });
                  
         		});

});

</script>
