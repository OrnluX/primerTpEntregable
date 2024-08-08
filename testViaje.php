<?php

    /**
        *Importante: Deben enviar el link a la resolución en su repositorio en GitHub del ejercicio.

        La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes. De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.

        Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase (incluso los datos de los pasajeros). Utilice clases y arreglos  para   almacenar la información correspondiente a los pasajeros. Cada pasajero guarda  su “nombre”, “apellido” y “numero de documento”.

        Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita cargar la información del viaje, modificar y ver sus datos.

        Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre, apellido, numero de documento y teléfono. El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. También se desea guardar la información de la persona responsable de realizar el viaje, para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. La clase Viaje debe hacer referencia al responsable de realizar el viaje.

        Implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos. Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. De la misma forma cargue la información del responsable del viaje.

        Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub.
    */
   
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
     * Crea una nueva instancia de la clase Viaje con datos pedidos al usuario y con un número de viaje, previamente asignado según la cantidad de viajes ya existentes en una colección. Además crea una instancia de la clase ResponsableV, solicitando los datos al usuario.
     * @param INT $nroViaje
     * @return OBJECT
     */
    function crearInstanciaViaje(int $nroViaje) {
        //STRING $origenViaje, $destinoViaje, $nombreResp, $apellidoResp
        //INT $capacidadMax, $nroEmpleado, $nroLicencia
        echo "***Por favor ingrese la información de la persona responsable del viaje*** \n\n";
        $nroEmpleado = pedirDatoUsuario("número de empleado");
        $nroLicencia = pedirDatoUsuario("número de licencia");
        $nombreResp = pedirDatoUsuario("nombre de la persona a cargo");
        $apellidoResp = pedirDatoUsuario("apellido de la persona encargada");
        $objResponsableV = new ResponsableV($nroEmpleado, $nroLicencia, $nombreResp, $apellidoResp);
        
        echo "***Por favor ingrese la información del viaje*** \n\n";
        $origenViaje = pedirDatoUsuario("origen del viaje");
        $destinoViaje = pedirDatoUsuario("destino del viaje");
        $capacidadMax = pedirDatoUsuario("capacidad máxima");
        echo "Viaje creado exitosamente! \n\n";

        return new Viaje($objResponsableV, $origenViaje, $destinoViaje, $nroViaje, $capacidadMax);
    }

    /**
     * Pregunta al usuario si desea agregar pasajeros al viaje. En caso afirmativo, le solicita los datos. Caso contrario, el programa continúa. 
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
                    $mensaje = $objViaje->agregarNuevoPasajero($objNuevoPasajero);
                    echo " \n " . $mensaje . " \n\n";
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
                $objNuevoViaje = crearInstanciaViaje($nroDeViaje);
                agregarPasajerosAlViaje($objNuevoViaje);
                $viajes[] = $objNuevoViaje;
                presionarEnterContinuar();
                break;
            case '2':      
                if (count($viajes) > 0) {
                    imprimirCuadriculaViajes($viajes);
                    $viajeSeleccionado = solicitarNumeroEntre(1, count($viajes));
                    $opcionNvlDos = seleccionarOpcionNvlDosOpDos($viajeSeleccionado);
                    $indiceViaje = $viajeSeleccionado - 1;  
                    switch ($opcionNvlDos) {
                        case '1':
                            agregarPasajerosAlViaje($viajes[$indiceViaje]);
                            break;
                        case '2':
                            $pasajeros = $viajes[$indiceViaje]->getListaPasajeros();
                            if(count($pasajeros) > 0) {
                                imprimirCuadriculaPasajeros($pasajeros);
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
                                        break;
                                } 
                            } else {
                                echo "No hay pasajeros registrados en este viaje \n";
                            }
                            break;
                        case '3':
                            $responsableActual = $viajes[$indiceViaje]->getResponsableV();
                            echo "Nro Empleado: " .$responsableActual->getNroEmpleado() . "\n";
                            echo "Nro Licencia: " . $responsableActual->getNroLicencia() . "\n";
                            echo "Nombre: " . $responsableActual->getNombre() . "\n"; 
                            echo "Apellido: " . $responsableActual->getApellido() . "\n"; 

                            break;
                    }
                } else {
                    echo "No hay viajes registrados \n";
                }
                presionarEnterContinuar();
                break;   
            default:
                echo "Fin del programa";
                break;
        }

    } while ($opcionNvlUno !=3);

?>