<?php
{
	$url = $this->miConfigurador->getVariableConfiguracion ( "host" );
	$url .= $this->miConfigurador->getVariableConfiguracion ( "site" );
	
	$url .= "/index.php?";
	
	// WEB Services
	$cadenaACodificar16 = "pagina=webServices";
	$cadenaACodificar16 .= "&procesarAjax=true";
	$cadenaACodificar16 .= "&action=index.php";
	$cadenaACodificar16 .= "&bloqueNombre=webServices";
	$cadenaACodificar16 .= "&bloqueGrupo=/";
	$cadenaACodificar16 .= "&funcion=actualizarParametros";
	$cadenaACodificar16 .= "&tipo_parametro=proveedores";
	$cadenaACodificar16 .= "&webServices=true";
	
	// Codificar las variables
	$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
	$cadena16 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar16, $enlace );
	
	// URL definitiva
	$urlWS = $url . $cadena16;
	

	
	

}

?>
<script type='text/javascript'>


function ServiciosWeb(elem, request, response){
	  $.ajax({
	    url: "<?php echo $urlWS?>",
	    dataType: "json",
	    success: function(data){ 

	    	console.log( JSON.stringify(data, null, 2) );
	            	            
	            
		        }
	    			

	    
		                    
	   });
	};



$(function() {


     $("#cbp-hrmenu").ready(function() {
    	 ServiciosWeb();
    	 ServiciosWeb();
    	  });


    
});

</script>

