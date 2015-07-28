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
// 		echo "REGISTRANDO OBSERVACIONES";
		
// 		var_dump ( $_REQUEST );
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$arreglo = array (
				"funcionario" => $_REQUEST ['funcionario'],
				"id_elemento_individual" => $_REQUEST ['elemento_individual'],
				'observacion' => $_REQUEST ['descripcion'] 
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'Registrar_Observaciones_Elemento', $arreglo );
		
		$observacion = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$arreglo = array (
				$observacion [0] [0],
				$_REQUEST ['elemento_individual'] 
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'Registrar_Levantamiento_Elemento', $arreglo );
		
		$Elemento_Levantamiento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		
		$arreglo = array (
				
				$_REQUEST ['placa'],
				$_REQUEST ['funcionario'],
				$_REQUEST ['elemento_individual'] 
		)
		;
// 		var_dump($Elemento_Levantamiento);exit;
		if ($Elemento_Levantamiento) {
			
			redireccion::redireccionar('insertoObservacion',$arreglo);
			exit ();
		} else {
			
			redireccion::redireccionar('noInsertoObservacion',$_REQUEST['funcionario']);
			
			exit ();
		}
	}
}

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$resultado = $miRegistrador->procesarFormulario ();

?>