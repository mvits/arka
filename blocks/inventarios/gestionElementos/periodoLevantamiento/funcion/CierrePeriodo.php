<?php

/*
 * To change this license header, choose License Headers in Project Properties. To change this template file, choose Tools | Templates and open the template in the editor.
 */
$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );

$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" ) . "/blocks/inventarios/";
$rutaBloque .= $esteBloque ['nombre'];
$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/inventarios/" . $esteBloque ['nombre'];

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

$resultado = '';

// var_sdump($_REQUEST);exit;

// $arreglo = array (
// $_REQUEST ['fecha_inicio_cierre'],
// $_REQUEST ['fecha_fin_cierre'],
// );

$cadenaSql = $this->sql->cadena_sql ( "Verificar_Periodo" );

$periodo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, 'busqueda' );

$periodo = $periodo [0];
var_dump ( $periodo );

// ------ Historial Placas levatamiento Existencia ---------------
$cadenaSql = $this->sql->cadena_sql ( "Inhabilitar_periodos_anteriores" );

$inhabilitar = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, 'acceso' );

$cadenaSql = $this->sql->cadena_sql ( "Rescatar_Verificacion_Placas" );

$verificacion_placas = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, 'busqueda' );



foreach ( $verificacion_placas as $valor ) {
	
	$arreglo = array (
			$periodo ['id_periodolevantamiento'],
			$valor ['funcionario'],
			$valor ['placa'],
			$valor ['confirmada_existencia'],
			date ( 'Y-m-d' ) 
	);
	
	
	
	
	$cadenaSql = $this->sql->cadena_sql ( "Registrar_Historial_Placas",  $arreglo);
	
	$registro_historial_placas = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, 'acceso' );
	

	
}


$cadenaSql = $this->sql->cadena_sql ( "Rescatar_Datos_Levantamiento" );


$Verrificacion_datos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, 'busqueda' );









//
// $verificacion_placas=$verificacion_placas[0];

exit ();

$cadenaSql = $this->sql->cadena_sql ( "Actualizar_Periodos", $arreglo );

$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, 'acceso' );

// Crear Variables necesarias en los métodos

if ($resultado) {
	$this->funcion->Redireccionador ( 'actualizoPeriodo' );
	exit ();
} else {
	$this->funcion->Redireccionador ( 'noactualizoPeriodo' );
	exit ();
}