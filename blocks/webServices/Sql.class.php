<?php

namespace webServices;

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}

include_once ("core/manager/Configurador.class.php");
include_once ("core/connection/Sql.class.php");

// Para evitar redefiniciones de clases el nombre de la clase del archivo sqle debe corresponder al nombre del bloque
// en camel case precedida por la palabra sql
class Sql extends \Sql {
	var $miConfigurador;
	function __construct() {
		$this->miConfigurador = \Configurador::singleton ();
	}
	function getCadenaSql($tipo, $variable = "") {
		
		/**
		 * 1.
		 * Revisar las variables para evitar SQL Injection
		 */
		$prefijo = $this->miConfigurador->getVariableConfiguracion ( "prefijo" );
		$idSesion = $this->miConfigurador->getVariableConfiguracion ( "id_sesion" );
		
		switch ($tipo) {
			
			/**
			 * Clausulas específicas
			 */
			
			case 'Consulta_Proveedores_Sicapital' :
				
				$cadenaSql = 'SELECT * FROM "PROVEEDORES" ';
				$cadenaSql .= 'ORDER BY "PRO_IDENTIFICADOR" ASC ';
				
				break;
			
			case 'Consulta_Proveedores_Arka' :
				
				$cadenaSql = 'SELECT * FROM arka_parametros.arka_proveedor ';
				$cadenaSql .= 'ORDER BY "PRO_IDENTIFICADOR" ;';
				
				break;
			
			case 'validacion_proveedores' :
				$cadenaSql = 'SELECT "PRO_IDENTIFICADOR" ';
				$cadenaSql .= 'FROM arka_parametros.arka_proveedor ';
				$cadenaSql .= 'WHERE "PRO_IDENTIFICADOR"=\'' . $variable . '\' ';
				$cadenaSql .= 'ORDER BY "PRO_IDENTIFICADOR" ;';
				
				break;
			
			case 'registro_proveedores' :
				
				$cadenaSql = 'INSERT INTO arka_parametros.arka_proveedor( ';
				$cadenaSql .= '"PRO_IDENTIFICADOR", "PRO_RAZON_SOCIAL", "PRO_NIT", "PRO_DIRECCION", "PRO_TELEFONO") ';
				$cadenaSql .= ' VALUES ( \'' . $variable ['PRO_IDENTIFICADOR'] . '\', ';
				$cadenaSql .= ' \'' . str_replace ( "'", "''", $variable ['PRO_RAZON_SOCIAL'] ) . '\', ';
				$cadenaSql .= ' \'' . str_replace ( "'", "''", $variable ['PRO_NIT'] ) . '\', ';
				$cadenaSql .= ($variable ['PRO_DIRECCION'] != '') ? ' \'' . str_replace ( "'", "''", $variable ['PRO_DIRECCION'] ) . '\', ' : ' NULL,';
				$cadenaSql .= ($variable ['PRO_TELEFONO'] != '') ? '\'' . str_replace ( "'", "''", $variable ['PRO_TELEFONO'] ) . '\');' : ' NULL);';
				
				break;
			
			case 'registro_proveedor_historico' :
				
				$cadenaSql = 'INSERT INTO arka_parametros.arka_proveedor_historico( ';
				$cadenaSql .= '"PRO_IDENTIFICADOR", "PRO_RAZON_SOCIAL", "PRO_NIT", "PRO_DIRECCION", "PRO_TELEFONO") ';
				$cadenaSql .= ' VALUES ( \'' . $variable ['PRO_IDENTIFICADOR'] . '\', ';
				$cadenaSql .= ' \'' . str_replace ( "'", "''", $variable ['PRO_RAZON_SOCIAL'] ) . '\', ';
				$cadenaSql .= ' \'' . str_replace ( "'", "''", $variable ['PRO_NIT'] ) . '\', ';
				$cadenaSql .= ($variable ['PRO_DIRECCION'] != '') ? ' \'' . str_replace ( "'", "''", $variable ['PRO_DIRECCION'] ) . '\', ' : ' NULL,';
				$cadenaSql .= ($variable ['PRO_TELEFONO'] != '') ? '\'' . str_replace ( "'", "''", $variable ['PRO_TELEFONO'] ) . '\');' : ' NULL);';
				
				break;
			
			case 'actualizar_proveedor' :
				
				$cadenaSql = 'UPDATE arka_parametros.arka_proveedor ';
				$cadenaSql .= "SET \"PRO_RAZON_SOCIAL\"='" . str_replace ( "'", "''", $variable ['PRO_RAZON_SOCIAL'] ) . "',";
				$cadenaSql .= " \"PRO_NIT\"='" . str_replace ( "'", "''", $variable ['PRO_NIT'] ) . "',";
				$cadenaSql .= '"PRO_DIRECCION"= '.(($variable ['PRO_DIRECCION'] != '')? "'" . str_replace ( "'", "''", $variable ['PRO_DIRECCION'] ) . "'," : "NULL,");
				$cadenaSql .= ' "PRO_TELEFONO"= '.(($variable ['PRO_TELEFONO'] != '')? "'" . str_replace ( "'", "''", $variable ['PRO_TELEFONO'] ) . "' " : "NULL ");
				$cadenaSql .= " WHERE \"PRO_IDENTIFICADOR\"='" . $variable ['PRO_IDENTIFICADOR'] . "';";
				
				break;
		}
		return $cadenaSql;
	}
}

?>
