<?php

namespace inventarios\gestionActa\consultarActa;

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
			case "buscarUsuario" :
				$cadenaSql = "SELECT ";
				$cadenaSql .= "FECHA_CREACION, ";
				$cadenaSql .= "PRIMER_NOMBRE ";
				$cadenaSql .= "FROM ";
				$cadenaSql .= "USUARIOS ";
				$cadenaSql .= "WHERE ";
				$cadenaSql .= "`PRIMER_NOMBRE` ='" . $variable . "' ";
				break;
			
			case "insertarRegistro" :
				$cadenaSql = "INSERT INTO ";
				$cadenaSql .= $prefijo . "registradoConferencia ";
				$cadenaSql .= "( ";
				$cadenaSql .= "`idRegistrado`, ";
				$cadenaSql .= "`nombre`, ";
				$cadenaSql .= "`apellido`, ";
				$cadenaSql .= "`identificacion`, ";
				$cadenaSql .= "`codigo`, ";
				$cadenaSql .= "`correo`, ";
				$cadenaSql .= "`tipo`, ";
				$cadenaSql .= "`fecha` ";
				$cadenaSql .= ") ";
				$cadenaSql .= "VALUES ";
				$cadenaSql .= "( ";
				$cadenaSql .= "NULL, ";
				$cadenaSql .= "'" . $variable ['nombre'] . "', ";
				$cadenaSql .= "'" . $variable ['apellido'] . "', ";
				$cadenaSql .= "'" . $variable ['identificacion'] . "', ";
				$cadenaSql .= "'" . $variable ['codigo'] . "', ";
				$cadenaSql .= "'" . $variable ['correo'] . "', ";
				$cadenaSql .= "'0', ";
				$cadenaSql .= "'" . time () . "' ";
				$cadenaSql .= ")";
				break;
			
			case "actualizarRegistro" :
				$cadenaSql = "UPDATE ";
				$cadenaSql .= $prefijo . "conductor ";
				$cadenaSql .= "SET ";
				$cadenaSql .= "`nombre` = '" . $variable ["nombre"] . "', ";
				$cadenaSql .= "`apellido` = '" . $variable ["apellido"] . "', ";
				$cadenaSql .= "`identificacion` = '" . $variable ["identificacion"] . "', ";
				$cadenaSql .= "`telefono` = '" . $variable ["telefono"] . "' ";
				$cadenaSql .= "WHERE ";
				$cadenaSql .= "`idConductor` =" . $_REQUEST ["registro"] . " ";
				break;
			
			/**
			 * Clausulas genéricas.
			 * se espera que estén en todos los formularios
			 * que utilicen esta plantilla
			 */
			case "iniciarTransaccion" :
				$cadenaSql = "START TRANSACTION";
				break;
			
			case "finalizarTransaccion" :
				$cadenaSql = "COMMIT";
				break;
			
			case "cancelarTransaccion" :
				$cadenaSql = "ROLLBACK";
				break;
			
			case "eliminarTemp" :
				
				$cadenaSql = "DELETE ";
				$cadenaSql .= "FROM ";
				$cadenaSql .= $prefijo . "tempFormulario ";
				$cadenaSql .= "WHERE ";
				$cadenaSql .= "id_sesion = '" . $variable . "' ";
				break;
			
			case "insertarTemp" :
				$cadenaSql = "INSERT INTO ";
				$cadenaSql .= $prefijo . "tempFormulario ";
				$cadenaSql .= "( ";
				$cadenaSql .= "id_sesion, ";
				$cadenaSql .= "formulario, ";
				$cadenaSql .= "campo, ";
				$cadenaSql .= "valor, ";
				$cadenaSql .= "fecha ";
				$cadenaSql .= ") ";
				$cadenaSql .= "VALUES ";
				
				foreach ( $_REQUEST as $clave => $valor ) {
					$cadenaSql .= "( ";
					$cadenaSql .= "'" . $idSesion . "', ";
					$cadenaSql .= "'" . $variable ['formulario'] . "', ";
					$cadenaSql .= "'" . $clave . "', ";
					$cadenaSql .= "'" . $valor . "', ";
					$cadenaSql .= "'" . $variable ['fecha'] . "' ";
					$cadenaSql .= "),";
				}
				
				$cadenaSql = substr ( $cadenaSql, 0, (strlen ( $cadenaSql ) - 1) );
				break;
			
			case "rescatarTemp" :
				$cadenaSql = "SELECT ";
				$cadenaSql .= "id_sesion, ";
				$cadenaSql .= "formulario, ";
				$cadenaSql .= "campo, ";
				$cadenaSql .= "valor, ";
				$cadenaSql .= "fecha ";
				$cadenaSql .= "FROM ";
				$cadenaSql .= $prefijo . "tempFormulario ";
				$cadenaSql .= "WHERE ";
				$cadenaSql .= "id_sesion='" . $idSesion . "'";
				break;
			
			/**
			 * Clausulas Del Caso Uso.
			 */
			case "actualizarItems" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " arka_inventarios.items_actarecibido(";
				$cadenaSql .= " id_acta, item,  descripcion,cantidad, ";
				$cadenaSql .= " valor_unitario, valor_total, estado_registro, fecha_registro)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "',";
				$cadenaSql .= "'" . $variable [5] . "',";
				$cadenaSql .= "'1',";
				$cadenaSql .= "'" . date ( 'Y-m-d' ) . "');";
				break;
			
			case "consultarItems" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_items,";
				$cadenaSql .= " item, ";
				$cadenaSql .= " cantidad, ";
				$cadenaSql .= " descripcion, ";
				$cadenaSql .= " valor_unitario, ";
				$cadenaSql .= " valor_total";
				$cadenaSql .= " FROM ";
				$cadenaSql .= " arka_inventarios.items_actarecibido ";
				$cadenaSql .= " WHERE id_acta='" . $variable . "';";
				break;
			
			case "id_items_temporal" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " max(id_items)";
				$cadenaSql .= " FROM arka_inventarios.items_actarecibido_temp;";
				break;
			
			case "items2" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_items,";
				$cadenaSql .= " item, ";
				$cadenaSql .= " cantidad, ";
				$cadenaSql .= " descripcion, ";
				$cadenaSql .= " valor_unitario, ";
				$cadenaSql .= " valor_total";
				$cadenaSql .= " FROM ";
				$cadenaSql .= " arka_inventarios.items_actarecibido ";
				$cadenaSql .= " WHERE id_acta='" . $variable ['tiempo'] . "';";
				break;
			
			case "items" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " id_items,";
				$cadenaSql .= " item, ";
				$cadenaSql .= " cantidad, ";
				$cadenaSql .= " descripcion, ";
				$cadenaSql .= " valor_unitario, ";
				$cadenaSql .= " valor_total";
				$cadenaSql .= " FROM ";
				$cadenaSql .= " arka_inventarios.items_actarecibido_temp ";
				$cadenaSql .= " WHERE seccion='" . $variable . "';";
				break;
			
			case "insertarItem" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " arka_inventarios.items_actarecibido_temp(";
				$cadenaSql .= " id_items,item,cantidad,descripcion, ";
				$cadenaSql .= " valor_unitario,valor_total,seccion)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "',";
				$cadenaSql .= "'" . $variable [5] . "',";
				$cadenaSql .= "'" . $variable [6] . "');";
				break;
			
			case "insertarItems" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " arka_inventarios.items_actarecibido(";
				$cadenaSql .= " id_acta, item, descripcion,cantidad, ";
				$cadenaSql .= " valor_unitario, valor_total, estado_registro, fecha_registro)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [0] . "',";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "',";
				$cadenaSql .= "'" . $variable [5] . "',";
				$cadenaSql .= "'1',";
				$cadenaSql .= "'" . date ( 'Y-m-d' ) . "');";
				break;
			
			case "inactivarItems" :
				$cadenaSql = " UPDATE ";
				$cadenaSql .= " arka_inventarios.items_actarecibido ";
				$cadenaSql .= " SET ";
				$cadenaSql .= " estado_registro='0',";
				$cadenaSql .= " fecha_registro='" . date ( 'Y-m-d' ) . "'";
				$cadenaSql .= " WHERE id_acta='" . $variable . "'";
				break;
			
			case "insertarItemTemporal" :
				$cadenaSql = " INSERT INTO ";
				$cadenaSql .= " arka_inventarios.items_actarecibido_temp(";
				$cadenaSql .= " item,cantidad,descripcion, ";
				$cadenaSql .= " valor_unitario,valor_total,seccion)";
				$cadenaSql .= " VALUES (";
				$cadenaSql .= "'" . $variable [1] . "',";
				$cadenaSql .= "'" . $variable [2] . "',";
				$cadenaSql .= "'" . $variable [3] . "',";
				$cadenaSql .= "'" . $variable [4] . "',";
				$cadenaSql .= "'" . $variable [5] . "',";
				$cadenaSql .= "'" . $variable ['tiempo'] . "');";
				break;
			
			case "eliminarItem" :
				$cadenaSql = " DELETE FROM ";
				$cadenaSql .= " arka_inventarios.items_actarecibido_temp";
				$cadenaSql .= " WHERE id_items ='" . $variable . "';";
				break;
			
			case "limpiarItems" :
				$cadenaSql = " DELETE FROM ";
				$cadenaSql .= " arka_inventarios.items_actarecibido";
				$cadenaSql .= " WHERE id_acta ='" . $variable . "';";
				break;
			
			case "limpiar_tabla_items" :
				$cadenaSql = " DELETE FROM ";
				$cadenaSql .= " arka_inventarios.items_actarecibido_temp";
				$cadenaSql .= " WHERE seccion ='" . $variable . "';";
				break;
			
			// _________________________________________________update___________________________________________
			
			// UPDATE registro_actarecibido
			// SET id_actarecibido=?, sede=?, dependencia=?, fecha_recibido=?, tipo_bien=?,
			// proveedor=?, ordenador_gasto=?, tipo_orden=?, fecha_revision=?,
			// revisor=?, observacionesacta=?, enlace_soporte=?, nombre_soporte=?,
			// numero_orden=?, estado_registro=?, fecha_registro=?
			// WHERE <condition>;
			
			case "actualizarActa_soporte" :
				$cadenaSql = " UPDATE ";
				$cadenaSql .= " registro_actarecibido ";
				$cadenaSql .= " SET ";
				$cadenaSql .= "sede='" . $variable ['sede'] . "',";
				$cadenaSql .= "dependencia='" . $variable ['dependencia'] . "',";
				$cadenaSql .= "fecha_recibido='" . $variable ['fecha_registro'] . "',";
				$cadenaSql .= "tipo_bien='" . $variable ['tipo_bien'] . "',";
				$cadenaSql .= "proveedor='" . $variable ['nit_proveedor'] . "',";
				$cadenaSql .= "ordenador_gasto='" . $variable ['ordenador'] . "',";
				$cadenaSql .= "fecha_revision='" . $variable ['fecha_revision'] . "',";
				$cadenaSql .= "revisor='" . $variable ['revisor'] . "',";
				$cadenaSql .= "observacionesacta='" . $variable ['observaciones'] . "',";
				$cadenaSql .= "enlace_soporte='" . $variable ['enlace_soporte'] . "',";
				$cadenaSql .= "nombre_soporte='" . $variable ['nombre_soporte'] . "',";
				$cadenaSql .= "estado_registro='" . $variable ['estado'] . "',";
				$cadenaSql .= "fecha_registro='" . $variable ['fecha_registro'] . "', ";
				$cadenaSql .= "id_contrato='" . $variable ['identificador_contrato'] . "' ";
				$cadenaSql .= " WHERE id_actarecibido = '" . $variable ['id_acta'] . "' ";
				$cadenaSql .= "RETURNING id_actarecibido";
				
				break;
			
			case "actualizarActa" :
				$cadenaSql = " UPDATE ";
				$cadenaSql .= " registro_actarecibido ";
				$cadenaSql .= " SET ";
				$cadenaSql .= "sede='" . $variable ['sede'] . "',";
				$cadenaSql .= "dependencia='" . $variable ['dependencia'] . "',";
				$cadenaSql .= "fecha_recibido='" . $variable ['fecha_registro'] . "',";
				$cadenaSql .= "tipo_bien='" . $variable ['tipo_bien'] . "',";
				$cadenaSql .= "proveedor='" . $variable ['nit_proveedor'] . "',";
				$cadenaSql .= "ordenador_gasto='" . $variable ['ordenador'] . "',";
				$cadenaSql .= "fecha_revision='" . $variable ['fecha_revision'] . "',";
				$cadenaSql .= "revisor='" . $variable ['revisor'] . "',";
				$cadenaSql .= "observacionesacta='" . $variable ['observaciones'] . "',";
				$cadenaSql .= "estado_registro='" . $variable ['estado'] . "',";
				$cadenaSql .= "fecha_registro='" . $variable ['fecha_registro'] . "', ";
				$cadenaSql .= "id_contrato='" . $variable ['identificador_contrato'] . "' ";
				$cadenaSql .= " WHERE id_actarecibido = '" . $variable ['id_acta'] . "' ";
				$cadenaSql .= "RETURNING id_actarecibido";
				
				break;
			
			case "consultarActa" :
				$cadenaSql = "SELECT DISTINCT ";
				$cadenaSql .= "id_actarecibido, dependencia, fecha_recibido, ";
				$cadenaSql .= " tb_descripcion , proveedor,";
				$cadenaSql .= "fecha_revision,revisor,observacionesacta ";
				$cadenaSql .= "FROM registro_actarecibido ";
				$cadenaSql .= "JOIN tipo_bien ON tb_idbien = tipo_bien ";
				$cadenaSql .= "WHERE 1 = 1 ";
				$cadenaSql .= "AND estado_registro = 1 ";
				if ($variable ['numero_acta'] != '') {
					$cadenaSql .= " AND id_actarecibido = '" . $variable ['numero_acta'] . "' ";
				}
				if ($variable ['fecha'] != '') {
					$cadenaSql .= " AND fecha_recibido = '" . $variable ['fecha'] . "' ";
				}
				if ($variable ['nit'] != '') {
					$cadenaSql .= " AND proveedor = '" . $variable ['nit'] . "' ";
				}
				
				$cadenaSql .= " ; ";
				
				break;
			
			case "consultarProveedor" :
				$cadenaSql = "SELECT PRO_NIT ||' - '|| PRO_RAZON_SOCIAL  ";
				$cadenaSql .= "FROM PROVEEDORES ";
				$cadenaSql .= "WHERE PRO_NIT='" . $variable . "' ";
				
				break;
			
			case "consultarActaM" :
				
				$cadenaSql = "SELECT DISTINCT * ";
				$cadenaSql .= " FROM registro_actarecibido ";
				$cadenaSql .= " WHERE 1 = 1 ";
				$cadenaSql .= " AND estado_registro = 1 ";
				$cadenaSql .= " AND id_actarecibido = '" . $variable . "' ";
				
				// $cadenaSql = "SELECT DISTINCT ";
				// $cadenaSql .= " id_actarecibido, dependencia, fecha_recibido, tipo_bien as tipoBien, nitproveedor, ";
				// $cadenaSql .= " proveedor, tipocomprador as tipoComprador, ";
				// $cadenaSql .= " fecha_revision, revisor, observacionesacta, estado_registro ";
				// $cadenaSql .= " FROM registro_actarecibido ";
				// $cadenaSql .= " JOIN tipo_bien ON tipo_bien.tb_idbien = registro_actarecibido.tipo_bien ";
				// $cadenaSql .= " JOIN tipo_comprador ON tipo_comprador.tc_idcomprador = registro_actarecibido.tipocomprador ";
				// $cadenaSql .= " WHERE 1 = 1 ";
				// $cadenaSql .= " AND estado_registro = 1 ";
				// $cadenaSql .= " AND id_actarecibido = '" . $variable . "' ";
				
				// echo $cadenaSql;exit;
				break;
			
			case "consultar_id_acta" :
				$cadenaSql = " SELECT id_actarecibido, id_actarecibido as acta_serial";
				$cadenaSql .= " FROM registro_actarecibido; ";
				break;
			
			case "inactivarActa" :
				$cadenaSql = " UPDATE ";
				$cadenaSql .= " registro_actarecibido ";
				$cadenaSql .= " SET ";
				$cadenaSql .= "estado_registro='0',";
				$cadenaSql .= "fecha_registro='" . date ( 'Y-m-d' ) . "' ";
				$cadenaSql .= " WHERE id_actarecibido = '" . $variable . "' ";
				$cadenaSql .= "RETURNING id_actarecibido";
				break;
			
			case "tipoOrden" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " to_id, ";
				$cadenaSql .= " to_nombre ";
				$cadenaSql .= " FROM ";
				$cadenaSql .= " arka_inventarios.tipo_orden ";
				$cadenaSql .= " WHERE to_estado = '1';
            ";
				break;
			
			case "tipoAccion" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " ta_idaccion, ";
				$cadenaSql .= " ta_descripcion ";
				$cadenaSql .= " FROM ";
				$cadenaSql .= " arka_inventarios.tipo_accion ";
				$cadenaSql .= " WHERE ta_estado = '1';
            ";
				break;
			
			case "tipoBien" :
				$cadenaSql = " SELECT ";
				$cadenaSql .= " tb_idbien, ";
				$cadenaSql .= " tb_descripcion ";
				$cadenaSql .= " FROM ";
				$cadenaSql .= " arka_inventarios.tipo_bien ";
				$cadenaSql .= " WHERE tb_estado = '1';                      ";
				break;
			
			// Consultas de Oracle para rescate de información de Sicapital
			/*
			 * case "dependencias":
			 * $cadenaSql = "SELECT DEP_IDENTIFICADOR, ";
			 * $cadenaSql.= " DEP_IDENTIFICADOR ||' '|| DEP_DEPENDENCIA ";
			 * //$cadenaSql .= " DEP_DIRECCION,DEP_TELEFONO ";F
			 * $cadenaSql.= " FROM DEPENDENCIAS ";
			 * break;
			 */
			
			case "select_proveedor" :
				$cadenaSql = "SELECT PRO_RAZON_SOCIAL";
				$cadenaSql .= " FROM PROVEEDORES ";
				$cadenaSql .= " WHERE PRO_NIT='" . $variable . "' ";
				break;
			
			case "contratistas" :
				$cadenaSql = "SELECT CON_IDENTIFICACION,CON_IDENTIFICACION ||' '|| CON_NOMBRE ";
				/*
				 * $cadenaSql .= " CON_CARGO, ";
				 * $cadenaSql .= " CON_DIRECCION, ";
				 * $cadenaSql .= " CON_TELEFONO ";
				 */
				$cadenaSql .= " FROM CONTRATISTAS ";
				break;
			
			// ---------------
			
			case "dependenciasConsultadas" :
				$cadenaSql = "SELECT DISTINCT  ESF_ID_ESPACIO, ESF_NOMBRE_ESPACIO ";
				$cadenaSql .= " FROM ESPACIOS_FISICOS ";
				$cadenaSql .= " WHERE ESF_ID_SEDE='" . $variable . "' ";
				$cadenaSql .= " AND  ESF_ESTADO='A'";
				
				break;
			
			case "sede" :
				$cadenaSql = "SELECT DISTINCT  ESF_ID_SEDE, ESF_SEDE ";
				$cadenaSql .= " FROM ESPACIOS_FISICOS ";
				$cadenaSql .= " WHERE   ESF_ESTADO='A'";
				
				break;
			case "dependencias" :
				$cadenaSql = "SELECT DISTINCT  ESF_ID_ESPACIO, ESF_NOMBRE_ESPACIO ";
				$cadenaSql .= " FROM ESPACIOS_FISICOS ";
				$cadenaSql .= " WHERE  ESF_ESTADO='A' ";
				break;
			
			case "consultaDependencia" :
				$cadenaSql = "SELECT DISTINCT  ESF_ID_ESPACIO, ESF_NOMBRE_ESPACIO ";
				$cadenaSql .= " FROM ESPACIOS_FISICOS ";
				$cadenaSql .= " WHERE  ESF_ESTADO='A' ";
				$cadenaSql .= " AND  ESF_ID_ESPACIO='".$variable."' ";
				break;
			
			case "proveedores" :
				
				$cadenaSql = " SELECT PRO_NIT,PRO_NIT||' - '||PRO_RAZON_SOCIAL AS proveedor ";
				$cadenaSql .= " FROM PROVEEDORES ";
				
				break;
			
			case "tipoComprador" :
				
				$cadenaSql = " 	SELECT ORG_IDENTIFICADOR, ORG_ORDENADOR_GASTO ";
				$cadenaSql .= " FROM ORDENADORES_GASTO ";
				$cadenaSql .= " WHERE ORG_ESTADO='A' ";
				
				break;
			
			case "informacion_ordenador" :
				$cadenaSql = " SELECT ORG_NOMBRE,ORG_IDENTIFICADOR  ";
				$cadenaSql .= " FROM ORDENADORES_GASTO ";
				$cadenaSql .= " WHERE  ORG_IDENTIFICADOR='" . $variable . "' ";
				$cadenaSql .= " AND ORG_ESTADO='A' ";
				break;
			
			case "consultarContratos" :
				$cadenaSql = "SELECT id_contrato,numero_contrato||' - ('||fecha_contrato||') ' contrato ";
				$cadenaSql .= "FROM contratos ";
				
				break;
			
			case "consultarInfoContrato" :
				$cadenaSql = "SELECT contratos.*,rd.documento_ruta  ";
				$cadenaSql .= " FROM contratos ";
				$cadenaSql .= "JOIN registro_documento  rd  ON rd.documento_id = contratos.id_documento_soporte ";
				$cadenaSql .= " WHERE id_contrato='" . $variable . "'; ";
				
				break;
			
			case "informacionContrato" :
				$cadenaSql = "SELECT contratos.*,rd.documento_ruta  ";
				$cadenaSql .= " FROM contratos ";
				$cadenaSql .= "JOIN registro_documento  rd  ON rd.documento_id = contratos.id_documento_soporte ";
				$cadenaSql .= " WHERE id_contrato='" . $variable . "'; ";
				break;
		}
		
		return $cadenaSql;
	}
}

?>
