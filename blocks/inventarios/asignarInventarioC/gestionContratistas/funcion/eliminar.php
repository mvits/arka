<?php
use inventarios\asignarInventarioC\gestionContratista\funcion\redireccion;

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
		var_dump ( $_REQUEST );
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		/*
		 * Datos Contrato
		 */
		$datosContratista = unserialize ( $_REQUEST ['datos'] );
		var_dump($datosContratista);exit;
		
		/*
		 * Registrar Contratista.
		 */
		if ($anio_inicio != $anio_actual) {
			$registrar = false;
		} else {
			$registrar = true;
		}
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'modificarContrato', $datos );
		if ($registrar == true) {
			$Actualizacion = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso", $datos, 'modificarContrato' );
		} else {
			$Actualizacion = false;
		}
		
		if ($Actualizacion != false) {
			$this->miConfigurador->setVariableConfiguracion ( "cache", true );
			
			redireccion::redireccionar ( "Actualizo" );
			exit ();
		} else {
			
			redireccion::redireccionar ( "NoActualizo" );
			exit ();
		}
	}
}

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$resultado = $miRegistrador->procesarFormulario ();

?>