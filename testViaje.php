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
     * Crea una nueva instancia de la clase Pasajero con datos pedidos al usuario
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
     * Crea una nueva instancia de la clase Viaje con datos pedidos al usuario
     * @param ResponsableV $objResponsableV
     * @param INT $nroViaje
     * @return OBJECT
     */
    function crearInstanciaViaje(ResponsableV $objResponsableV, int $nroViaje) {
        //STRING $origenViaje, $destinoViaje
        echo "***Por favor ingrese la información del viaje*** \n\n";
        $origenViaje = pedirDatoUsuario("origen del viaje");
        $destinoViaje = pedirDatoUsuario("destino del viaje");
        echo "Viaje creado exitosamente! \n\n";

        return new Viaje($objResponsableV, $origenViaje, $destinoViaje, $nroViaje);
    }

    /**
     * Crea una nueva instancia de la clase ResponsableV con datos pedidos al usuario
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
        //STRING $rta, $pasajeroYaRegistrado, $mensaje
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
                    $mensaje = null;
                    $objNuevoPasajero = crearInstanciaPasajero();
                    $pasajeroYaRegistrado = $objViaje->verificarSiEstaPasajero($objNuevoPasajero);
                    if(!$pasajeroYaRegistrado) {
                        $mensaje = $objViaje->agregarNuevoPasajero($objNuevoPasajero);
                        echo " \n " . $mensaje . " \n\n";
                    } else {
                        echo "Error. El pasajero ya se encuentra registrado \n";
                    }
                    break;
            }
        } while ($rta == 1);
    }

    /**PROGRAMA PRINCIPAL */
    
    //INICIALIZACIÓN ESTRUCTURAS DE DATOS
    $viajes = [];  
    
    do {
        $opcionNvlUno = seleccionarOpcionNvlUno();
        switch ($opcionNvlUno) {
            case '1':
                $nroDeViaje = count($viajes)+1;
                $objResponsableV = crearInstanciaResponsableV();
                $objNuevoViaje = crearInstanciaViaje($objResponsableV, $nroDeViaje);
                agregarPasajerosAlViaje($objNuevoViaje);
                $viajes[] = $objNuevoViaje;
                presionarEnterContinuar();
                break;
            case '2':      
                imprimirCuadriculaViajes($viajes);
                echo "Ingrese el número de viaje y presione ENTRAR: ";
                $viajeSeleccionado = solicitarNumeroEntre(1, count($viajes));

                $opcionNvlDos = seleccionarOpcionNvlDosOpDos($viajeSeleccionado);
                $indiceViaje = $viajeSeleccionado - 1;  
                switch ($opcionNvlDos) {
                    case '1':
                        agregarPasajerosAlViaje($viajes[$indiceViaje]);
                        break;
                    case '2':
                        $pasajeros = $viajes[$indiceViaje]->getListaPasajeros();
                        imprimirCuadriculaPasajeros($pasajeros);
                        echo "Ingrese el número de pasajero y presione ENTRAR: ";
                        $pasajeroSeleccionado = solicitarNumeroEntre(1,count($pasajeros));
                        $indicePasajero = $pasajeroSeleccionado - 1;
                        $opcionNvlTres = seleccionarOpcionNvlTresOpDos($pasajeroSeleccionado);
                        switch ($opcionNvlTres) {
                            case '1':
                                $nuevoNombre = pedirDatoUsuario("Nombre");
                                $pasajeros[$indicePasajero]->setNombre($nuevoNombre);
                                echo "El nombre ha sido modificado \n";
                                break;
                            case '2':
                                $nuevoApellido = pedirDatoUsuario("Apellido");
                                $pasajeros[$indicePasajero]->setApellido($nuevoApellido);
                                echo "El apellido ha sido modificado \n";
                                break;
                            case '3':
                                $nuevoNroDocumento = pedirDatoUsuario("número de documento");
                                $pasajeros[$indicePasajero]->setNroDocumento($nuevoNroDocumento);
                                echo "El nro de documento ha sido modificado \n";
                                break;    
                            case '4':
                                $nuevoNroTelefono = pedirDatoUsuario("número de teléfono");
                                $pasajeros[$indicePasajero]->setNroTelefono($nuevoNroTelefono);
                                echo "El nro de número de teléfono ha sido modificado \n";
                                break;
                            default:
                                # code...
                                break;
                        }
                        break;
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

    } while ($opcionNvlUno !=4);

?>