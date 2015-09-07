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
				$_REQUEST ['sede'],
				$_REQUEST ['observaciones'],
				$_REQUEST ['numero_salida'],
				$_REQUEST ['funcionarioP'],
				$_REQUEST ['vigencia'],
				$_REQUEST ['ubicacion'] 
		);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'actualizar_salida', $arreglo );
		$id_salida = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
		if ($id_salida == true) {
			
			$semaforo = true;
		} else {
			
			$semaforo = false;
		}
		
		if ($_REQUEST ['actualizar'] == '1') {
			
			// -- Verificar -- Items -- Cantidades
			
			for($i = 0; $i <= $_REQUEST ['cantidadItems']; $i ++) {
				
				if (isset ( $_REQUEST ['item' . $i] )) {
					
					$items [$i] = $_REQUEST ['item' . $i];
				}
			}
			
			if (! isset ( $items )) {
				
				redireccion::redireccionar ( "noitems" );
				exit ();
			}
			
			for($i = 0; $i <= $_REQUEST ['cantidadItems']; $i ++) {
				
				if (isset ( $items [$i] ) && isset ( $cantidad [$i] )) {
					
					($cantidad [$i] != '') ? '' : redireccion::redireccionar ( "noCantidad" );
				}
				
				if (isset ( $_REQUEST ['cantidadAsignar' . $i] )) {
					
					$cantidad [$i] = $_REQUEST ['cantidadAsignar' . $i];
				} else {
					
					$cantidad [$i] = '';
				}
			}
			
			$cadenaSql = $this->miSql->getCadenaSql ( 'elementosIndividuales', $_REQUEST ['numero_salida'] );
			
			$elementos_inds = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			
			
			foreach ( $elementos_inds as $claves ) {
				$cadenaSql = $this->miSql->getCadenaSql ( 'limpiarIndividuales', $claves [0] );
				
				$elementos_ind = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			}
			//
			
			for($i = 0; $i < count ( $items ); $i ++) {
				
				$arreglo = array (
						$_REQUEST ['numero_salida'],
						$elementos_inds [$i] [0],
						$_REQUEST ['ubicacion'] 
				);
				
				$cadenaSql = $this->miSql->getCadenaSql ( 'ajustar_elementos_salida', $arreglo );
				
				$ele_sali = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
				
			}
			
			if ($ele_sali = true) {
				
				$semaforo = true;
			} else {
				
				redireccion::redireccionar ( 'noInserto' );
				exit ();
			}
			$arreglo = array (
					"salida" => $_REQUEST ['numero_salida'],
					"entrada" => $_REQUEST ['numero_entrada'],
					"salidasAS" => 0 
			);
			
			
			
		} else if ($_REQUEST ['actualizar'] == '0') {
			
			$semaforo = true;
			
			$arreglo = array (
					"salida" => $_REQUEST ['numero_salida'],
					"entrada" => $_REQUEST ['numero_entrada'],
					"salidasAS" => 0 
			);
		}
		
		if ($semaforo) {
                    $this->miConfigurador->setVariableConfiguracion("cache",true);
			redireccion::redireccionar ( 'inserto', $arreglo );
			exit ();
		} else {
			
			redireccion::redireccionar ( 'noInserto' );
			exit ();
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