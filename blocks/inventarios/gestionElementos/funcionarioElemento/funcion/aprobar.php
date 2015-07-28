<?php

namespace inventarios\gestionElementos\funcionarioElemento\funcion;

use inventarios\gestionElementos\funcionarioElemento\funcion\redireccion;

include_once ('redireccionar.php');
if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}

class RegistradorOrden {
	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;
	var $miFuncion;
	var $miSql;
	var $conexion;
	function __construct($lenguaje, $sql, $funcion) {
		$this->miConfigurador = \Configurador::singleton ();
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		$this->lenguaje = $lenguaje;
		$this->miSql = $sql;
		$this->miFuncion = $funcion;
	}
	function procesarFormulario() {
		var_dump($_REQUEST);
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		

		
		for($i = 0; $i <= 10000; $i ++) {
			if (isset ( $_REQUEST ['item_' . $i] )) {
				$elementos [] = $_REQUEST ['item_' . $i];
			}
		}
	
		foreach ($elementos as $valor){
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'Elemento_Existencia', $valor );
		
		$estado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		
		}
		
	
	
	
	
	
// 		var_dump($elementos);
		
		exit;
			

		$arreglo=array(
			$_REQUEST['id_elemento'],
				$_REQUEST['observaciones']		
				
		);
		

		

		
    
		$cadenaSql = $this->miSql->getCadenaSql ( 'anular_elemento', $arreglo );
		 
		$anular = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		
		
				
		if ($anular) {
				
			redireccion::redireccionar ( 'anulado');
			exit();
		} else {
				
			redireccion::redireccionar ( 'noAnulado' );
			exit();
			
		}
		
	}
	function resetForm() {
		foreach ( $_REQUEST as $clave => $valor ) {
			
			if ($clave != 'pagina' && $clave != 'development' && $clave != 'jquery' && $clave != 'tiempo') {
				unset ( $_REQUEST [$clave] );
			}
		}
	}
}

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$resultado = $miRegistrador->procesarFormulario ();

?>