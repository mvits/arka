<?php

namespace inventarios\gestionElementos\modificarElemento\funcion;

use inventarios\gestionElementos\modificarElemento\funcion\redireccion;

include_once ('redireccionar.php');
if (! isset ( $GLOBALS ["autorizado"]funcionarioElemento/index.php");
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
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$_REQUEST ['total_iva_con'] = round ( $_REQUEST ['total_iva_con'] );
		
		
		if ($_REQUEST ['id_tipo_bien'] == 1) {
			
			$arreglo = array (
					$_REQUEST ['id_tipo_bien'],
					$_REQUEST ['descripcion'],
					$_REQUEST ['cantidad'],
					$_REQUEST ['unidad'],
					$_REQUEST ['valor'],
					$_REQUEST ['iva'],
					$_REQUEST ['ajuste'] = 0,
					0,
					$_REQUEST ['subtotal_sin_iva'],
					$_REQUEST ['total_iva'],
					$_REQUEST ['total_iva_con'],
					($_REQUEST ['marca'] != '') ? $_REQUEST ['marca'] : 'null',
					($_REQUEST ['serie'] != '') ? $_REQUEST ['serie'] : 'null',
					$_REQUEST ['id_elemento'],
					$_REQUEST ['nivel'] 
			);
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_elemento_tipo_1', $arreglo );
			
			$elemento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		} else if ($_REQUEST ['id_tipo_bien'] == 2) {
			
			$arreglo = array (
					
					$_REQUEST ['id_tipo_bien'],
					$_REQUEST ['descripcion'],
					$_REQUEST ['cantidad'] = 1,
					$_REQUEST ['unidad'],
					$_REQUEST ['valor'],
					$_REQUEST ['iva'],
					$_REQUEST ['ajuste'] = 0,
					0,
					$_REQUEST ['subtotal_sin_iva'],
					$_REQUEST ['total_iva'],
					$_REQUEST ['total_iva_con'],
					($_REQUEST ['marca'] != '') ? $_REQUEST ['marca'] : 'null',
					($_REQUEST ['serie'] != '') ? $_REQUEST ['serie'] : 'null',
					$_REQUEST ['id_elemento'],
					$_REQUEST ['nivel'] 
			);
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_elemento_tipo_1', $arreglo );
			
			$elemento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		} else if ($_REQUEST ['id_tipo_bien'] == 3) {
			
			if ($_REQUEST ['tipo_poliza'] == 0) {
				$arreglo = array (
						$_REQUEST ['id_tipo_bien'],
						$_REQUEST ['descripcion'],
						$_REQUEST ['cantidad'] = 1,
						$_REQUEST ['unidad'],
						$_REQUEST ['valor'],
						$_REQUEST ['iva'],
						$_REQUEST ['ajuste'] = 0,
						0,
						$_REQUEST ['subtotal_sin_iva'],
						$_REQUEST ['total_iva'],
						$_REQUEST ['total_iva_con'],
						$_REQUEST ['tipo_poliza'],
						'0001-01-01',
						'0001-01-01',
						($_REQUEST ['marca'] != '') ? $_REQUEST ['marca'] : 'null',
						($_REQUEST ['serie'] != '') ? $_REQUEST ['serie'] : 'null',
						$_REQUEST ['id_elemento'],
						$_REQUEST ['nivel'] 
				);
			} else if ($_REQUEST ['tipo_poliza'] == 1) {
				$arreglo = array (
						$_REQUEST ['id_tipo_bien'],
						$_REQUEST ['descripcion'],
						$_REQUEST ['cantidad'] = 1,
						$_REQUEST ['unidad'],
						$_REQUEST ['valor'],
						$_REQUEST ['iva'],
						$_REQUEST ['ajuste'] = 0,
						0,
						$_REQUEST ['subtotal_sin_iva'],
						$_REQUEST ['total_iva'],
						$_REQUEST ['total_iva_con'],
						$_REQUEST ['tipo_poliza'],
						$_REQUEST ['fecha_inicio'],
						$_REQUEST ['fecha_final'],
						($_REQUEST ['marca'] != '') ? $_REQUEST ['marca'] : 'null',
						($_REQUEST ['serie'] != '') ? $_REQUEST ['serie'] : 'null',
						$_REQUEST ['id_elemento'],
						$_REQUEST ['nivel'] 
				);
			}
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_elemento_tipo_2', $arreglo );
			
			$elemento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		}
		
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultar_placa_actulizada', $_REQUEST ['id_elemento'] );
		$placa = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		if ($elemento) {
			
			redireccion::redireccionar ( 'inserto', $_REQUEST ['id_elemento'] );
			exit();
		} else {
			
			redireccion::redireccionar ( 'noInserto' );
			exit();
		}
	}
	
}

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$resultado = $miRegistrador->procesarFormulario ();

?>