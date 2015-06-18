<?php

namespace inventarios\gestionElementos\aprobarBajas\funcion;

use inventarios\gestionElementos\aprobarBajas\funcion\redireccion;

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

        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/inventarios/gestionElementos/";
        $rutaBloque .= $esteBloque ['nombre'];

        $host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/inventarios/gestionElementos/" . $esteBloque ['nombre'];

        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $fechaActual = date('Y-m-d');

        $i = 0;
        foreach ($_FILES as $key => $values) {

            $archivo [$i] = $_FILES [$key];
            $i ++;
        }

        $archivo = $archivo[0];


        if (isset($archivo)) {
// obtenemos los datos del archivo
            $tamano = $archivo ['size'];
            $tipo = $archivo ['type'];
            $archivo1 = $archivo ['name'];
            $prefijo = substr(md5(uniqid(rand())), 0, 6);

            if ($archivo1 != "") {
// guardamos el archivo a la carpeta files
                $destino1 = $rutaBloque . "/documento_radicacion/" . $prefijo . "_" . $archivo1;
                if (copy($archivo ['tmp_name'], $destino1)) {
                    $status = "Archivo subido: <b>" . $archivo1 . "</b>";
                    $destino1 = $host . "/documento_radicacion/" . $prefijo . "_" . $archivo1;

                    $arreglo = array(
                        'fecha' => $fechaActual,
                        'destino' => $destino1,
                        'nombre' => $archivo1,
                        'estado' => 1
                    );

                    $cadenaSql = $this->miSql->getCadenaSql("registroDocumento_Aprobacion", $arreglo);
                    $idAprobacion = $esteRecursoDB->ejecutarAcceso($cadenaSql, 'busqueda');
                } else {
                    $status = "Error al subir el archivo";
                    echo $status;
                }
            } else {
                $status = "Error al subir archivo";
                echo $status . "2";
            }
        }

// Ahora a actualizar el estado de los items seleccionados


        $items [] = unserialize($_REQUEST['items']);

        foreach ($items as $nodo => $fila) {
            foreach ($fila as $columna => $valor) {

                $datosAprobar = array(
                    'id_aprobacion' => $idAprobacion[0][0],
                    'id_elemento' => $valor,
                    'estado' => 1
                );
                $cadenaSql = $this->miSql->getCadenaSql('actualizarAprobar', $datosAprobar);
                $asignar = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso");
            }
        }

        if ($asignar) {
            redireccion::redireccionar('inserto', $idAprobacion[0][0]);
        } else {

            redireccion::redireccionar('noInserto');
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