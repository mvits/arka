<?php

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class registrarForm {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miSql;

    function __construct($lenguaje, $formulario, $sql) {
        $this->miConfigurador = \Configurador::singleton();

        $this->miConfigurador->fabricaConexiones->setRecursoDB('principal');

        $this->lenguaje = $lenguaje;

        $this->miFormulario = $formulario;

        $this->miSql = $sql;
    }

    function miForm() {

        // Rescatar los datos de este bloque
        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");
        $miPaginaActual = $this->miConfigurador->getVariableConfiguracion('pagina');


        $directorio = $this->miConfigurador->getVariableConfiguracion("host");
        $directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
        $directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");


        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("host");
        $rutaBloque .= $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/";
        $rutaBloque .= $esteBloque ['grupo'] . "/" . $esteBloque ['nombre'];

        $atributosGlobales ['campoSeguro'] = 'true';

        $_REQUEST ['tiempo'] = time();
        $tiempo = $_REQUEST ['tiempo'];

        // -------------------------------------------------------------------------------------------------
        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $conexion = "sicapital";
        $esteRecursoDBO = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $tab = 1;

        $total_valorhistorico = 0;
        $total_ajusteinflacion = 0;
        $total_valorajustado = 0;
        $total_depreciacion = 0;
        $total_api = 0;
        $total_dep56 = 0;
        $total_libros = 0;

        if (isset($_REQUEST['grupo_contable']) && $_REQUEST['grupo_contable'] != '') {
            $grupo = $_REQUEST['grupo_contable'];
        } else {
            $grupo = '';
        }

        if (isset($_REQUEST['fechaCorte']) && $_REQUEST['fechaCorte'] != '') {
            $fechaCorte = $_REQUEST['fechaCorte'];
        } else {
            $fechaCorte = date('Y-m-d');
        }

        if (isset($_REQUEST['cuenta_salida']) && $_REQUEST['cuenta_salida'] != '') {
            $cuenta_contable = $_REQUEST['cuenta_salida'];
        } else {
            $cuenta_contable = '';
        }

        $datos = array(
            'grupo_contable' => $grupo,
            'fecha_corte' => $fechaCorte,
            'cuenta_salida' => $cuenta_contable,
        );


        $cadenaSql = $this->miSql->getCadenaSql('mostrarInfoDepreciar_elemento', $datos);
        $elementoG = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        if ($elementoG) {
            $arr = array();
            foreach ($elementoG as $key => $item) {
                $arr[$item['grupo_cuentasalida']][$key] = $item;
            }


            $a = 0;
            $cuota_inflacion = 0;
// Calculando la depreciacion
            foreach ($arr as $llave => $items) {

                $count = 0;
                foreach ($items as $key => $values) {

                    $cadenaSql = $this->miSql->getCadenaSql('mostrarInfoDepreciar_elementoindividual', $items[$key][0]);
                    $elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

                    $cantidad = 1;
                    $meses = $elemento[0]['grupo_vidautil'];
                    $precio = $elemento[0]['valor'];
                    $inflacion = doubleval($elemento[0]['ajuste_inflacionario']);

                    $fecha_salida = new \DateTime($elemento[0]['fecha_registro']);
                    $fecha_corte = new \DateTime($_REQUEST['fechaCorte']);
                    $fecha_limite = new \DateTime('1999-12-31');

                    $periodos = $fecha_corte->diff($fecha_salida);
                    $meses_periodo = $periodos->format("%m");
                    $años_periodo = $periodos->format("%y") * 12;

                    $periodos_fecha1 = $meses_periodo + $años_periodo + 1;

                    $valor_historico = $precio * $cantidad;

                    if ($fecha_salida <= $fecha_limite) {
                        $inflacion = $inflacion;
                    } else {
                        $inflacion = 0;
                    }

                    $valor_ajustado = $valor_historico + $inflacion;

//Valor de la Cuota
                    if ($meses == 0) {
                        $cuota = 0;
                        $periodos_fecha = 0;
                    } else {
                        $cuota = $valor_historico / $meses;
                        $periodos_fecha = $periodos_fecha1;
                    }


//DEPRECIACION AUMULADA
                    if ($meses !== 0) {
                        if ($periodos_fecha >= $meses) {

                            $dep_acumulada = $valor_historico;
                        } else {
                            $dep_acumulada = $cuota * $periodos_fecha;
                        }
                    } else {
                        $dep_acumulada = 0;
                    }

//CIRCULAR 56
                    $circular56 = $valor_historico + $inflacion;

//CUOTAS AJUSTES POR INFLACION 
                    if ($meses == 0) {
                        $cuota_inflacion = 0;
                    } else {
                        if ($inflacion > 0) {
                            $cuota_inflacion = $inflacion / $meses;
                        } else {
                            $cuota_inflacion = 0;
                        }
                    }

//AJUSTE POR INFLACION A LA DEPRECIACION ACUMULADA
                    if ($meses !== 0) {
                        if ($periodos_fecha >= $meses) {
                            $api_acumulada = $inflacion;
                        } else {
                            $api_acumulada = $cuota_inflacion * $periodos_fecha;
                        }
                    } else {
                        $api_acumulada = 0;
                    }


//CIRCULAR 56 - DEPRECIACIÓN
                    $circular_depreciacion = $api_acumulada + $dep_acumulada;

//VALOR A LOS LIBROS
                    $valor_libros = $valor_ajustado-$circular_depreciacion;



                    //totalizar los valores de los elementos
                    $total_valorhistorico = $total_valorhistorico + $valor_historico;
                    $total_ajusteinflacion = $total_ajusteinflacion + $inflacion;
                    $total_valorajustado = $total_valorajustado + $valor_ajustado;
                    $total_depreciacion = $total_depreciacion + $dep_acumulada;
                    $total_api = $total_api + $api_acumulada;
                    $total_dep56 = $total_dep56 + $circular_depreciacion;
                    $total_libros = $total_libros + $valor_libros;
                    $nombre_cuenta = $elemento[0]['elemento_nombre'];
                    $count ++;
                }


                $depreciacion_calculada[$a] = array(
                    0 => $llave,
                    'cuenta' => $llave,
                    1 => $nombre_cuenta,
                    'grupo' => $nombre_cuenta,
                    2 => $count,
                    'total_elementos' => $count,
                    3 => number_format($total_valorhistorico, 2, ',', '.'),
                    'total_valor_historico' => number_format($total_valorhistorico, 2, ',', '.'),
                    4 => number_format($total_ajusteinflacion, 2, ',', '.'),
                    'total_ajuste_inflacion' => number_format($total_ajusteinflacion, 2, ',', '.'),
                    5 => number_format($total_valorajustado, 2, ',', '.'),
                    'total_valor_ajustado' => number_format($total_valorajustado, 2, ',', '.'),
                    6 => number_format($total_depreciacion, 2, ',', '.'),
                    'total_depreciacion' => number_format($total_depreciacion, 2, ',', '.'),
                    7 => number_format($total_api, 2, ',', '.'),
                    'total_ajuste_inflacionario' => number_format($total_api, 2, ',', '.'),
                    8 => number_format($total_dep56, 2, ',', '.'),
                    'total_depreciacion_circular56' => number_format($total_dep56, 2, ',', '.'),
                    9 => number_format($total_libros, 2, ',', '.'),
                    'total_libros' => number_format($total_libros, 2, ',', '.'),
                );

                $a++;
            }
        }
        // ---------------- SECCION: Parámetros Globales del Formulario ----------------------------------
        /**
         * Atributos que deben ser aplicados a todos los controles de este formulario.
         * Se utiliza un arreglo
         * independiente debido a que los atributos individuales se reinician cada vez que se declara un campo.
         *
         * Si se utiliza esta técnica es necesario realizar un mezcla entre este arreglo y el específico en cada control:
         * $atributos= array_merge($atributos,$atributosGlobales);
         */
        // ---------------- SECCION: Parámetros Generales del Formulario ----------------------------------
        $esteCampo = $esteBloque ['nombre'];
        $atributos ['id'] = $esteCampo;
        $atributos ['nombre'] = $esteCampo;
        // Si no se coloca, entonces toma el valor predeterminado 'application/x-www-form-urlencoded'
        $atributos ['tipoFormulario'] = 'multipart/form-data';
        // Si no se coloca, entonces toma el valor predeterminado 'POST'
        $atributos ['metodo'] = 'POST';
        // Si no se coloca, entonces toma el valor predeterminado 'index.php' (Recomendado)
        $atributos ['action'] = 'index.php';
        // $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo );
        // Si no se coloca, entonces toma el valor predeterminado.
        $atributos ['estilo'] = '';
        $atributos ['marco'] = true;

        // ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------
        // ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
        $atributos ['tipoEtiqueta'] = 'inicio';
        echo $this->miFormulario->formulario($atributos);
        // ---------------- SECCION: Controles del Formulario -----------------------------------------------
	
			
		$variable = "pagina=" . $miPaginaActual;
		$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable, $directorio );
		
		// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
		$esteCampo = 'botonRegresar';
		$atributos ['id'] = $esteCampo;
		$atributos ['enlace'] = $variable;
		$atributos ['tabIndex'] = 1;
		$atributos ['estilo'] = 'textoSubtitulo';
		$atributos ['enlaceTexto'] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['ancho'] = '10%';
		$atributos ['alto'] = '10%';
		$atributos ['redirLugar'] = true;
		echo $this->miFormulario->enlace ( $atributos );

        unset($atributos);

        // ---------------- SECCION: Controles del Formulario -----------------------------------------------

        $esteCampo = "marcoDatosBasicos";
        $atributos ['id'] = $esteCampo;
        $atributos ["estilo"] = "jqueryui";
        $atributos ['tipoEtiqueta'] = 'inicio';
        $atributos ["leyenda"] = "Depreciación General Realizada a Fecha de Corte " . $_REQUEST['fechaCorte'];
        echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);

        if ($elementoG) {
            //Aquí genera la tabla !!!! :D

            echo $this->miFormulario->tablaReporte($depreciacion_calculada,$estilo=true);

            //Aquí termina la tabla

            echo $this->miFormulario->marcoAgrupacion('fin');

            // ------------------Division para los botones-------------------------
            $atributos ["id"] = "botones";
            $atributos ["estilo"] = "marcoBotones";
            echo $this->miFormulario->division("inicio", $atributos);

            // -----------------CONTROL: Botón ----------------------------------------------------------------
            $esteCampo = 'botonContinuar';
            $atributos ["id"] = $esteCampo;
            $atributos ["tabIndex"] = $tab;
            $atributos ["tipo"] = '';
            // submit: no se coloca si se desea un tipo button genérico
            $atributos ['submit'] = 'true';
            $atributos ["estiloMarco"] = '';
            $atributos ["estiloBoton"] = 'jqueryui';
            // verificar: true para verificar el formulario antes de pasarlo al servidor.
            $atributos ["verificar"] = '';
            $atributos ["tipoSubmit"] = 'jquery'; // Dejar vacio para un submit normal, en este caso se ejecuta la función submit declarada en ready.js
            $atributos ["valor"] = $this->lenguaje->getCadena($esteCampo);
            $atributos ['nombreFormulario'] = $esteBloque ['nombre'];
            $tab ++;

            // Aplica atributos globales al control
            $atributos = array_merge($atributos, $atributosGlobales);
            echo $this->miFormulario->campoBoton($atributos);
//            // -----------------FIN CONTROL: Botón -----------------------------------------------------------

            echo $this->miFormulario->division('fin');

            echo $this->miFormulario->marcoAgrupacion('fin');

            // ---------------- FIN SECCION: Controles del Formulario -------------------------------------------
            // ----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
            // Se debe declarar el mismo atributo de marco con que se inició el formulario.
            // -----------------FIN CONTROL: Botón -----------------------------------------------------------
            // ------------------Fin Division para los botones-------------------------
            // ------------------- SECCION: Paso de variables ------------------------------------------------

            /**
             * En algunas ocasiones es útil pasar variables entre las diferentes páginas.
             * SARA permite realizar esto a través de tres
             * mecanismos:
             * (a). Registrando las variables como variables de sesión. Estarán disponibles durante toda la sesión de usuario. Requiere acceso a
             * la base de datos.
             * (b). Incluirlas de manera codificada como campos de los formularios. Para ello se utiliza un campo especial denominado
             * formsara, cuyo valor será una cadena codificada que contiene las variables.
             * (c) a través de campos ocultos en los formularios. (deprecated)
             */
            // En este formulario se utiliza el mecanismo (b) para pasar las siguientes variables:
            // Paso 1: crear el listado de variables
            $valorCodificado = "action=" . $esteBloque ["nombre"];
            $valorCodificado.= "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
            $valorCodificado.= "&bloque=" . $esteBloque ['nombre'];
            $valorCodificado.= "&bloqueGrupo=" . $esteBloque ["grupo"];
            $valorCodificado.= "&opcion=generarPDF";
            $valorCodificado.="&depreciacion=" . base64_encode(serialize($depreciacion_calculada));

            /*
             * SARA permite que los nombres de los campos sean dinámicos.
             * Para ello utiliza la hora en que es creado el formulario para
             * codificar el nombre de cada campo. Si se utiliza esta técnica es necesario pasar dicho tiempo como una variable:
             * (a) invocando a la variable $_REQUEST ['tiempo'] que se ha declarado en ready.php o
             * (b) asociando el tiempo en que se está creando el formulario
             */
            $valorCodificado .= "&campoSeguro=" . $_REQUEST ['tiempo'];
            $valorCodificado .= "&tiempo=" . time();
            // Paso 2: codificar la cadena resultante
            $valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar($valorCodificado);

            $atributos ["id"] = "formSaraData"; // No cambiar este nombre
            $atributos ["tipo"] = "hidden";
            $atributos ['estilo'] = '';
            $atributos ["obligatorio"] = false;
            $atributos ['marco'] = true;
            $atributos ["etiqueta"] = "";
            $atributos ["valor"] = $valorCodificado;
            echo $this->miFormulario->campoCuadroTexto($atributos);
            unset($atributos);

            $atributos ['marco'] = true;
            $atributos ['tipoEtiqueta'] = 'fin';
            echo $this->miFormulario->formulario($atributos);
        } else {

            $mensaje = "No Se Encontraron<br>Elementos asociados a ese nivel de Inventario";

            // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
            $esteCampo = 'mensajeRegistro';
            $atributos ['id'] = $esteCampo;
            $atributos ['tipo'] = 'error';
            $atributos ['estilo'] = 'textoCentrar';
            $atributos ['mensaje'] = $mensaje;

            $tab ++;

            // Aplica atributos globales al control
            $atributos = array_merge($atributos, $atributosGlobales);
            echo $this->miFormulario->cuadroMensaje($atributos);
            // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
        }
    }

}

$miSeleccionador = new registrarForm($this->lenguaje, $this->miFormulario, $this->sql);

$miSeleccionador->miForm();
?>

