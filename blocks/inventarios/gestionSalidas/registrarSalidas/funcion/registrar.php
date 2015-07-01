<?php

namespace inventarios\gestionSalidas\registrarSalidas\funcion;

use inventarios\gestionSalidas\registrarSalidas\funcion\redireccion;

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
		// var_dump($_REQUEST);exit;
		$fechaActual = date ( 'Y-m-d' );
		
		$fechaReinicio = date ( "Y-m-d", mktime ( 0, 0, 0, 1, 1, date ( 'Y' ) ) );
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		if ($fechaActual == $fechaReinicio) {
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'consultaConsecutivo', $fechaReinicio );
			$consecutivo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			
			if (isset ( $consecutivo ) && $consecutivo == false) {
				$cadenaSql = $this->miSql->getCadenaSql ( 'reiniciarConsecutivo' );
				$consecutivo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
			}
		}
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'id_salida_maximo' );
		
		$max_id_salida = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$max_id_salida = $max_id_salida [0] [0] + 1;
		
		$arreglo = array (
				$fechaActual,
				$_REQUEST ['dependencia'],
				$_REQUEST ['funcionario'],
				$_REQUEST ['observaciones'],
				$_REQUEST ['numero_entrada'],
				$_REQUEST ['sede'],
				$_REQUEST ['ubicacion'],
				$_REQUEST ['vigencia'],
				$max_id_salida 
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_salida', $arreglo );
		
		$id_salida = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$items = unserialize ( $_REQUEST ['items'] );
		$cantidad = unserialize ( $_REQUEST ['cantidad'] );
		
		foreach ( $items as $i ) {
			$cadenaSql = $this->miSql->getCadenaSql ( 'busqueda_elementos_individuales', $i );
			
			$id_elem_ind [$i] = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		}
		
		foreach ( $cantidad as $i ) {
			
			if ($i != '') {
				$contador_ele_ind = $i;
			}
		}
		
		foreach ( $id_elem_ind as $i => $e ) {
			
			if (count ( $e ) > 1) {
				
				for($i = 0; $i < $contador_ele_ind; $i ++) {
					
					$arreglo = array (
							$e [$i] [0],
							$id_salida [0] [0],
							$_REQUEST ['funcionario'] 
					);
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_elementos_individuales', $arreglo );
					
					$actualizo_elem = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
				}
			}
			if (count ( $e ) == 1) {
				$arreglo = array (
						$e [0] [0],
						$id_salida [0] [0],
						$_REQUEST ['funcionario'] 
				);
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_elementos_individuales', $arreglo );
				
				$actualizo_elem = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
			}
		}
		
		// ----- Salidas Contables ----------
		
// 		$cadenaSql = $this->miSql->getCadenaSql ( 'busqueda_elementos_bienes', '1809' );
		$cadenaSql = $this->miSql->getCadenaSql ( 'busqueda_elementos_bienes', $id_salida[0][0] );
		
		$elementos_tipo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		

		foreach ( $elementos_tipo as $elemento ) {
			
			switch ($elemento ['tipo_bien']) {
				case '1' :
					$arreglo = array (
							$_REQUEST ['vigencia'],
							$elemento ['tipo_bien'] 
					);
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'SalidaConstableVigencia', $arreglo );

					$max_consecutivo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
					

					if (is_null ( $max_consecutivo [0] [0] )) {
					
						$salidaConsecutiva = 1;
					} else {
					
						$salidaConsecutiva = $max_consecutivo [0] [0] + 1;
					}
						
					$arreglo_salida_contable = array (
							$fechaActual,
							$id_salida [0] [0],
							$elemento ['tipo_bien'],
							$_REQUEST ['vigencia'],
							$salidaConsecutiva
					);
						
					$cadenaSql = $this->miSql->getCadenaSql ( 'InsertarSalidaContable', $arreglo_salida_contable );
						
					$id_salida_contable = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
						
					
					break;
				
				case '2' :
					
					$arreglo = array (
							$_REQUEST ['vigencia'],
							$elemento ['tipo_bien'] 
					);
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'SalidaContableVigencia', $arreglo );

					$max_consecutivo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
					
					if (is_null ( $max_consecutivo [0] [0] )) {
						
						$salidaConsecutiva = 1;
					} else {
						
						$salidaConsecutiva = $max_consecutivo [0] [0] + 1;
					}
					
					$arreglo_salida_contable = array (
							$fechaActual,
							$id_salida [0] [0],
							$elemento ['tipo_bien'],
							$_REQUEST ['vigencia'],
							$salidaConsecutiva 
					);
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'InsertarSalidaContable', $arreglo_salida_contable );
					
					$id_salida_contable = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
					
					break;
				
				case '3' :
					
					$arreglo = array (
							$_REQUEST ['vigencia'],
							$elemento ['tipo_bien'] 
					);
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'SalidaConstableVigencia', $arreglo );

					$max_consecutivo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );

					if (is_null ( $max_consecutivo [0] [0] )) {
					
						$salidaConsecutiva = 1;
					} else {
					
						$salidaConsecutiva = $max_consecutivo [0] [0] + 1;
					}
						
					$arreglo_salida_contable = array (
							$fechaActual,
							$id_salida [0] [0],
							$elemento ['tipo_bien'],
							$_REQUEST ['vigencia'],
							$salidaConsecutiva
					);
						
					$cadenaSql = $this->miSql->getCadenaSql ( 'InsertarSalidaContable', $arreglo_salida_contable );
						
					$id_salida_contable = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
						
					
					
					break;
			}
		}
		
		
		
		$arreglo = array (
				"salida" => $id_salida [0] [0],
				"entrada" => $_REQUEST ['numero_entrada'],
				"fecha" => $fechaActual 
		);
		
		if ($actualizo_elem = true) {
			
			redireccion::redireccionar ( 'inserto', $arreglo );
		} else {
			
			redireccion::redireccionar ( 'noInserto' );
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