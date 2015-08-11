<?php

namespace inventarios\gestionElementos\modificarElemento\funcion;

use inventarios\gestionElementos\modificarElemento\funcion\redireccion;

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
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		var_dump ( $_REQUEST );
		// --------------------- Cambio de tipo de Elemento
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'Informacion_Elemento', $_REQUEST ['id_elemento'] );
		
		$info_elemento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$info_elemento = $info_elemento [0];
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
			
			// $elemento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
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
			
			// $elemento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
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
			
// 			$elemento = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		}
		
		if ($info_elemento ['tipo_bien'] != $_REQUEST ['id_tipo_bien']) {
			
			if (($info_elemento ['tipo_bien']==2 || $info_elemento ['tipo_bien']==3 )&&$_REQUEST ['id_tipo_bien'] == 1) {
				$cadenaSql = $this->miSql->getCadenaSql ( 'consultar_elementos_individuales', $_REQUEST ['id_elemento'] );
				$elementos_Individuales = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				foreach ( $elementos_Individuales as $valor ) {
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'inhabilitar_elementos_individuales', $valor ['id_elemento_ind'] );
					$elementos_Individuales = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
				}
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'idElementoMaxIndividual' );
				$elemento_id_max_indiv = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				$elemento_id_max_indiv = $elemento_id_max_indiv [0] [0] + 1;
				
				for($i = 0; $i < $_REQUEST ['cantidad']; $i ++) {
					$arregloElementosInv = array (
							date ( 'Y-m-d' ),
							NULL,
							($_REQUEST ['serie'] != '') ? $_REQUEST ['serie'] : null,
							$_REQUEST ['id_elemento'],
							$elemento_id_max_indiv 
					);
					
					$cadenaSql = $this->miSql->getCadenaSql ( 'ingresar_elemento_individual', $arregloElementosInv );
					
					$elemento_id [$i] = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
					
					$elemento_id_max_indiv = $elemento_id [$i] [0] [0] + 1;
				}
			}else if ($info_elemento ['tipo_bien']==1 &&($_REQUEST ['id_tipo_bien'] == 2 ||$_REQUEST ['id_tipo_bien'] == 3)  ) {
				echo "stiv  entro de nuevo";
				
				
				
				
				
			}
		}
		exit;
		// -----------------
		
		if ($elemento) {
			
			redireccion::redireccionar ( 'inserto', $_REQUEST ['id_elemento'] );
			exit ();
		} else {
			
			redireccion::redireccionar ( 'noInserto' );
			exit ();
		}
	}
}

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$resultado = $miRegistrador->procesarFormulario ();

?>