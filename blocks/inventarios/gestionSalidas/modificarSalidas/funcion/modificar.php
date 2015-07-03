<?php

namespace inventarios\gestionSalidas\modificarSalidas;

use inventarios\gestionSalidas\modificarSalidas\funcion;

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
		
		
		
		
		
		// ----
		
		for($i = 0; $i <= 200; $i ++) {
			
			if (isset ( $_REQUEST ['item' . $i] )) {
				
				$items [] = $_REQUEST ['item' . $i];
			}
		}
		
		$arreglo = array (
				
				$_REQUEST ['dependencia'],
				$_REQUEST ['sede'] ,
				$_REQUEST ['observaciones'],
				$_REQUEST ['numero_salida'],
				$_REQUEST ['funcionarioP'] ,
				$_REQUEST ['vigencia'] ,
				$_REQUEST ['ubicacion'] 
		);

		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_salida', $arreglo );
		$id_salida = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		
		if ($_REQUEST ['actualizar'] == '1') {

			
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'elementosIndividuales', $_REQUEST['numero_salida'] );
			$elementos_ind = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			
			
			var_dump($elementos_ind);exit;
			
			// -- Verificar -- Items -- Cantidades
			
			for($i = 0; $i <= $_REQUEST ['cantidadItems']; $i ++) {
				
				if (isset ( $_REQUEST ['item' . $i] )) {
					
					$items [$i] = $_REQUEST ['item' . $i];
				}
			}
			
			for($i = 0; $i <= $_REQUEST ['cantidadItems']; $i ++) {
				

				if (isset ( $items [$i] ) && isset ( $cantidad [$i] )) {
						
					($cantidad [$i] != '') ? '' : redireccion::redireccionar ( "noCantidad" );
				}
				
				if (isset ( $_REQUEST ['cantidadAsignar' . $i] )) {
					
					$cantidad [$i] = $_REQUEST ['cantidadAsignar' . $i];
				} else {
					
// 					$cantidad [$i] ='';
				}
			
			}
			exit;
			if (! isset ( $items )) {
				
				redireccion::redireccionar ( "noitems" );
			}
			
			
			
			// -------
			
			// $cadenaSql = $this->miSql->getCadenaSql ( 'consultarEntradaParticular', $_REQUEST ['numero_entrada'] );
			
			// $entrada = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'consulta_elementos_informacion', $_REQUEST ['numero_entrada'] );
			
			$elementos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			// var_dump($elementos);
			// var_dump($cantidad);
			// var_dump($items);
			
			// Restarurar elementos
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'id_items', $_REQUEST ['numero_entrada'] );
			
			$id_items = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			
			for($i = 0; $i < count ( $id_items ); $i ++) {
				$cadenaSql = $this->miSql->getCadenaSql ( 'restaurar_elementos', $id_items [$i] [0] );
				
				$restaurar = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
			}
			
			foreach ( $items as $i ) {
				$cadenaSql = $this->miSql->getCadenaSql ( 'busqueda_elementos_individuales', $i );
				
				$id_elem_ind [$i] = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			}
			
// 			var_dump($cantidad);
// 			var_dump($items);
			
			foreach ( $cantidad as $i ) {
				
				if ($i != '') {
					$contador_ele_ind = $i;
				}
			}
			
			
			
			
			foreach ( $id_elem_ind as $i => $e ) {
				
			
				
				if (count ( $e ) > 1) {
					
					for($i = 0; $i < $contador_ele_ind[0]; $i ++) {
						
						$arreglo = array (
								$e [$i] [0],
								$_REQUEST ['numero_salida'] 
						);
						
						$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_elementos_individuales', $arreglo );
						
						$actualizo_elem = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
					}
				}
				
				
				if (count ( $e ) == 1) {
					$arreglo = array (
							$e [0] [0],
							$_REQUEST ['numero_salida']
					);
				
					$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_elementos_individuales', $arreglo );
				
					$actualizo_elem = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
				}
				
			}

// 			var_dump($elementos);
			
// 			exit ();
// 			foreach ( $elementos as $d ) {
				
// 				if ($_REQUEST ['numero_salida'] != $d [4]) {
					
// 					$salidasSA [] = $d [4];
// 				}
// 			}
			
// 			$salidasSA = serialize ( $salidasSA );
			

// 			for($i = 0; $i <= 200; $i ++) {
				
// 				if (isset ( $_REQUEST ['item' . $i] )) {
					
// 					$items [] = $_REQUEST ['item' . $i];
// 				}
// 			}
			
// 			foreach ( $items as $i ) {
				
// 				$arreglo = array (
// 						$i,
// 						$_REQUEST ['numero_salida'] 
// 				);
				
// 				$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_salida_item', $arreglo );
// 				$semaforo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
// 			}
			
			$arreglo = array (
					"salida" => $_REQUEST ['numero_salida'],
					"entrada" => $_REQUEST ['numero_entrada'],
					"salidasAS" => 0 
			);
			$semaforo = 'true';
		} else if (isset ( $_REQUEST ['Re_Actualizacion'] )) {
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'consultarEntradaParticular', $_REQUEST ['numero_entrada'] );
			
			$entrada = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'consulta_elementos_totales', $entrada [0] [12] );
			
			$elementos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			
			foreach ( $elementos as $d ) {
				
				if ($_REQUEST ['numero_salida'] != $d [4]) {
					
					$salidasSA [] = $d [4];
				} else {
					
					$salidasSA = 'true';
				}
			}
			
			$salidasSA = serialize ( $salidasSA );
			
			foreach ( $items as $i ) {
				
				$arreglo = array (
						$i,
						$_REQUEST ['numero_salida'] 
				);
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'insertar_salida_item', $arreglo );
				$semaforo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
			}
			
			$arreglo = array (
					"salida" => $_REQUEST ['numero_salida'],
					"entrada" => $_REQUEST ['numero_entrada'],
					"salidasAS" => $salidasSA 
			);
		} else if ($_REQUEST ['actualizar'] == '0') {
			
			$semaforo = 'true';
			
			$arreglo = array (
					"salida" => $_REQUEST ['numero_salida'],
					"entrada" => $_REQUEST ['numero_entrada'],
					"salidasAS" => 0 
			);
		}
		
		
		if ($semaforo=='true') {
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