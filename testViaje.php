<?php
    include_once'Viaje.php';
    include_once'Pasajero.php';
    include_once'ResponsableV.php';
    include_once'funcionalidadComplementaria.php';
    include_once'funcionesMenu.php';


    function pedirDatoUsuario($dato) {
        echo "Ingrese " . $dato . ": ";
        echo " \n";
        return trim(fgets(STDIN));
    }    

    /**
     * Crea una nueva instancia de la clase Pasajero
     * @return OBJECT
     */
    function crearInstanciaPasajero() {
        //STRING $nombrePasajero, apellidoPasajero
        //INT $nroDocumentoPasajero, $nroTelefonoPasajero
        $nombrePasajero = pedirDatoUsuario("nombre");
        $apellidoPasajero = pedirDatoUsuario("apellido");
        $nroDocumentoPasajero = pedirDatoUsuario("número de documento");
        $nroTelefonoPasajero = pedirDatoUsuario("número de teléfono");

        return new Pasajero($nombrePasajero, $apellidoPasajero, $nroDocumentoPasajero, $nroTelefonoPasajero);
    }

    /**
     * Crea una nueva instancia de la clase Viaje
     * @param ResponsableV $objResponsableV
     * @param INT $nroViaje
     * @return OBJECT
     */
    function crearInstanciaViaje(ResponsableV $objResponsableV, int $nroViaje) {
        //STRING $origenViaje, $destinoViaje
        echo "***Por favor ingrese la información del viaje*** \n\n";
        $origenViaje = pedirDatoUsuario("origen del viaje");
        $destinoViaje = pedirDatoUsuario("destino del viaje");

        return new Viaje($objResponsableV, $origenViaje, $destinoViaje, $nroViaje);
    }

    /**
     * Crea una nueva instancia de la clase ResponsableV
     * @return OBJECT
     */
    function crearInstanciaResponsableV() {
        //INT $nroEmpleado, $nroLicencia
        //STRING $nombre, $apellido
        echo "***Por favor ingrese la información de la persona responsable del viaje*** \n\n";
        $nroEmpleado = pedirDatoUsuario("número de empleado");
        $nroLicencia = pedirDatoUsuario("número de licencia");
        $nombre = pedirDatoUsuario("nombre de la persona a cargo");
        $apellido = pedirDatoUsuario("apellido de la persona encargada");

        return new ResponsableV($nroEmpleado, $nroLicencia, $nombre, $apellido);
    }

    /**
     * Pregunta al usuario si desea agregar pasajeros al viaje
     * @param Viaje $objViaje
     */
    function agregarPasajerosAlViaje(Viaje $objViaje){
        //STING $rta, $pasajeroYaRegistrado
        //Pasajero $objNuevoPasajero
        $rta = null;
        do {
            echo "¿Desea ingresar pasajeros al viaje? \n";
            echo "1- Si \n";
            echo "2- No \n";
            echo "Ingrese la opción deseada: ";
            $rta = solicitarNumeroEntre(1,2);
            switch ($rta) {
                case '1':
                    $objNuevoPasajero = crearInstanciaPasajero();
                    $pasajeroYaRegistrado = $objViaje->verificarSiEstaPasajero($objNuevoPasajero);
                    if(!$pasajeroYaRegistrado) {
                        $objViaje->agregarNuevoPasajero($objNuevoPasajero);
                    } else {
                        echo "Error. El pasajero ya se encuentra registrado \n";
                    }
                    break;
                
                default:
                    echo "Se ha finalizado el ingreso de pasajeros al viaje \n";
                    break;
            }
        } while ($rta == 1);
    }

    /**PROGRAMA PRINCIPAL */

    //DECLARACIÓN DE VARIABLES
    //ARRAY $viajes
    //INT $nroDeViaje
    
    //INICIALIZACIÓN ESTRUCTURAS DE DATOS
    $viajes = [];  
    
    do {
        $opcion = seleccionarOpcion();
        switch ($opcion) {
            case '1':
                $nroDeViaje = count($viajes)+1;
                $objResponsableV = crearInstanciaResponsableV();
                $objNuevoViaje = crearInstanciaViaje($objResponsableV, $nroDeViaje);
                echo "Viaje creado exitosamente! \n\n";
                agregarPasajerosAlViaje($objNuevoViaje);
                $viajes[] = $objNuevoViaje;
                presionarEnterContinuar();
                break;
            case '2':
                if (count($viajes) >= 1) {
                    echo "***Seleccione el viaje que desea modificar*** \n\n";
                    echo "N°    Responsable     Origen      Destino     Ocupados    Cap. Máx \n";
                    foreach ($viajes as $objViaje) {
                        echo $objViaje . " \n";
                    }
                } else {
                    echo "No hay viajes registrados \n";
                }

                presionarEnterContinuar();
                break;
            case '3':
                echo "Opción 3 seleccionada \n";
                presionarEnterContinuar();
            break;    
            
            default:
                echo "Fin del programa";
                break;
        }

    } while ($opcion !=4);

?>