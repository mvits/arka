<?php
/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */

// URL base
$url = $this->miConfigurador->getVariableConfiguracion ( "host" );
$url .= $this->miConfigurador->getVariableConfiguracion ( "site" );

$urlDirectorio=$url;

$urlDirectorio =$urlDirectorio."/plugin/scripts/javascript/dataTable/Spanish.json";

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

if (isset ( $_REQUEST ['sede'] ) && $_REQUEST ['sede'] != '') {
	$sede = $_REQUEST ['sede'];
} else {
	$sede = '';
}

if (isset ( $_REQUEST ['dependencia'] ) && $_REQUEST ['dependencia'] != '') {
	$dependencia = $_REQUEST ['dependencia'];
} else {
	$dependencia = '';
}



if (isset ( $_REQUEST ['funcionario'] ) && $_REQUEST ['funcionario'] != '') {
	$funcionario = $_REQUEST ['funcionario'];
} else {
	$funcionario = '';
}



if (isset ( $_REQUEST ['numero_entrada'] ) && $_REQUEST ['numero_entrada'] != '') {
	$entrada = $_REQUEST ['numero_entrada'];
} else {
	$entrada = '';
}




$arreglo = array (
		$fechaInicio,
		$fechaFinal,
		$placa,
		$serie,
		$sede,
		$dependencia,
		$funcionario,
		$entrada 
);

$arreglo = serialize ( $arreglo );

$cadenaACodificar .= "&arreglo=" .$arreglo;


// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar, $enlace );


// URL definitiva
$urlFinal = $url . $cadena;




// Variables
$cadenaACodificar16 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar16 .= "&procesarAjax=true";
$cadenaACodificar16 .= "&action=index.php";
$cadenaACodificar16 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar16 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar16 .= $cadenaACodificar16 . "&funcion=consultarDependencia";
$cadenaACodificar16 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena16 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar16, $enlace );

// URL definitiva
$urlFinal16 = $url . $cadena16;
// echo $urlFinal;
?>
<script type='text/javascript'>
$(function() {
         	$('#tablaTitulos').ready(function() {

             $('#tablaTitulos').dataTable( {
//              	 serverSide: true,
				language: {
                url: "<?php echo $urlDirectorio?>"
            			},
             	 processing: true,
//                   ordering: true,
                  searching: true,
//                   deferRender: true,
                  sScrollY: 200	,
         //          bScrollCollapse: true,
                  info:true,
//                   lengthChange:true,
                  paging: true,
//                   stateSave: true,
         //          renderer: "bootstrap",
         //          retrieve: true,
                  ajax:{
                      url:"<?php echo $urlFinal?>",
                      dataSrc:"data"                                                                  
                  },
                  columns: [
                  { data :"fecharegistro" },
                  { data :"entrada" },
                  { data :"descripcion" },
                  { data :"placa" },
                  { data :"funcionario" },
                  { data :"dependencia" },
                  { data :"modificar" },
                  { data :"anular" }
                            ]
             });
                  
         		});

});


function consultarDependencia(elem, request, response){
	  $.ajax({
	    url: "<?php echo $urlFinal16?>",
	    dataType: "json",
	    data: { valor:$("#<?php echo $this->campoSeguro('sede')?>").val()},
	    success: function(data){ 



	        if(data[0]!=" "){

	            $("#<?php echo $this->campoSeguro('dependencia')?>").html('');
	            $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('dependencia')?>");
	            $.each(data , function(indice,valor){

	            	$("<option value='"+data[ indice ].ESF_ID_ESPACIO+"'>"+data[ indice ].ESF_NOMBRE_ESPACIO+"</option>").appendTo("#<?php echo $this->campoSeguro('dependencia')?>");
	            	
	            });
	            
	            $("#<?php echo $this->campoSeguro('dependencia')?>").removeAttr('disabled');
	            
	            $('#<?php echo $this->campoSeguro('dependencia')?>').width(300);
	            $("#<?php echo $this->campoSeguro('dependencia')?>").select2();
	            
	          
	            
		        }
	    			

	    }
		                    
	   });
	};

	  $(function () {



	        $("#<?php echo $this->campoSeguro('sede')?>").change(function(){
	        	if($("#<?php echo $this->campoSeguro('sede')?>").val()!=''){
	            	consultarDependencia();
	    		}else{
	    			$("#<?php echo $this->campoSeguro('dependencia')?>").attr('disabled','');
	    			}

	    	      });
	        

		
	    });
	


</script>
