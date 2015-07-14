<?php

?>

// Asociar el widget de validación al formulario
              $("#consultarActa").validationEngine({
            promptPosition : "centerRight", 
            scroll: false,
            autoHidePrompt: true,
            autoHideDelay: 2000
	         });
	
        
        $(function() {
            $("#consultarActa").submit(function() {
                $resultado=$("#consultarActa").validationEngine("validate");
           
                if ($resultado) {
                
                    return true;
                }
                return false;
            });
        });

                     $('#tablaTitulos').dataTable( {
                "sPaginationType": "full_numbers"
                 } );

  	   
	   
        $('#<?php echo $this->campoSeguro('fecha_recibido')?>').datepicker({
	        dateFormat: 'yy-mm-dd',
	        maxDate: 0,
	        changeYear: true,
	        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
				'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
				dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
				dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
				dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa']
        });
        
        
        
        $("#<?php echo $this->campoSeguro('sede') ?>").select2();
       
		$("#<?php echo $this->campoSeguro('tipoBien') ?>").select2(); 
		
		$('#<?php echo $this->campoSeguro('dependencia')?>').width(815);          
        $("#<?php echo $this->campoSeguro('dependencia') ?>").select2();
        $("#<?php echo $this->campoSeguro('numero_acta') ?>").select2();
        $("#<?php echo $this->campoSeguro('numeroContrato') ?>").select2();
        $("#<?php echo $this->campoSeguro('tipocomprador') ?>").select2();
        $("#<?php echo $this->campoSeguro('asignacionOrdenador') ?>").select2();
          
        
      
        
        
          






