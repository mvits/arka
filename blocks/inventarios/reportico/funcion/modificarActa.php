<?php

namespace inventarios\gestionActa\consultarActa\funcion;

use inventarios\gestionActa\consultarActa\funcion\redireccion;

include_once ('redireccionar.php');
if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorOrden {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miFuncion;
    var $miSql;
    var $conexion;

    function __construct($lenguaje, $sql, $funcion) {
        $this->miConfigurador = \Configurador::singleton();
        $this->miConfigurador->fabricaConexiones->setRecursoDB('principal');
        $this->lenguaje = $lenguaje;
        $this->miSql = $sql;
        $this->miFuncion = $funcion;
    }

    function procesarFormulario() {

        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/inventarios/gestionActa/";
        $rutaBloque .=$esteBloque ['nombre'];
        $host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/inventarios/gestionActa/consultarActa/";

        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $cadenaSql = $this->miSql->getCadenaSql('items', $_REQUEST ['seccion']);
        $items = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        if ($items == 0) {
            redireccion::redireccionar('noItems');
        }

        $fechaActual = date('Y-m-d');
        //Actualizar Acta de Recibido

        $datosActa = array(
            $_REQUEST ['dependencia'],
            $fechaActual,
            $_REQUEST ['tipo_bien'],
            $_REQUEST ['nitproveedor'],
            $_REQUEST ['proveedor'],
            $_REQUEST ['numfactura'],
            $_REQUEST ['fecha_factura'],
            $_REQUEST ['tipocomprador'],
            $_REQUEST ['tipoaccion'],
            $_REQUEST ['fecha_revision'],
            $_REQUEST ['revisor'],
            $_REQUEST ['observacionesacta'],
            1,
            $_REQUEST ['id_acta'],
        );

        $cadenaSql = $this->miSql->getCadenaSql('actualizarActa', $datosActa);
        $id_acta = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        $cadenaSql = $this->miSql->getCadenaSql('limpiarItems', $_REQUEST ['id_acta']);
        $limpiar = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

         
        foreach ($items as $contenido) {

            $datosItems = array(
                $_REQUEST ['id_acta'],
                $contenido ['item'],
                $contenido ['cantidad'],
                $contenido ['descripcion'],
                $contenido ['valor_unitario'],
                $contenido ['valor_total'],
                $fechaActual
                    )
            ;

            $cadenaSql = $this->miSql->getCadenaSql('insertarItems', $datosItems);
            $items = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
        }
    
   
        $cadenaSql = $this->miSql->getCadenaSql('limpiar_tabla_items', $_REQUEST ['seccion']);
        $resultado_secuencia = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");

        $datos = array(
            $_REQUEST['id_acta'],
            $fechaActual,
        );
        if ($items == 1) {

            redireccion::redireccionar('inserto', $datos);
        } else {

            redireccion::redireccionar('noInserto', $datos);
        }
    }

    function resetForm() {
        foreach ($_REQUEST as $clave => $valor) {

            if ($clave != 'pagina' && $clave != 'development' && $clave != 'jquery' && $clave != 'tiempo') {
                unset($_REQUEST [$clave]);
            }
        }
    }

}

$miRegistrador = new RegistradorOrden($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>