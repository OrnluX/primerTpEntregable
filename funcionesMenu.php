<?php
    /**
     *Muestra el menú principal en pantalla. Luego solicita al usuario que ingrese un número válido, correspondiente a la opción del menú que desea ejecutar.
     *@return INT 
    */
    function seleccionarOpcionNvlUno() {
        //INT $opcionSeleccionada
        echo " \n";
        echo "¿Qué desea hacer?";
        echo " \n";
        echo "1- Agregar un nuevo viaje \n";
        echo "2- Ver o modificar un viaje \n";
        echo "3- Salir del programa \n";
        echo "Ingrese la opción deseada: ";
        $opcionSeleccionada = solicitarNumeroEntre(1,3);
        return $opcionSeleccionada;
    }

    /**
     * Función que muestra el segundo nivel del menú, opción 2 del menú principal
     * @param INT
     * @return INT
    */
    function seleccionarOpcionNvlDosOpDos($viajeSeleccionado) {
        //INT $opcionSeleccionada
        echo " \n";
        echo "****MENÚ VIAJE N° " . $viajeSeleccionado . "***** \n\n";
        echo "1-Cargar pasajeros \n";
        echo "2-Modificar información de pasajeros \n";
        echo "3-Ver información de la persona a cargo del viaje \n";
        echo "Ingrese la opción deseada: ";
        $opcionSeleccionada = solicitarNumeroEntre(1,3);
        return $opcionSeleccionada;
    }

    /**
     * Función que muestra el tercer nivel del menú, opción 2
     * @return INT
    */
    function seleccionarOpcionNvlTresOpDos($pasajeroSeleccionado) {
        //INT $opcionSeleccionada
        echo " \n";
        echo "****MENÚ PASAJERO N° " . $pasajeroSeleccionado . "***** \n\n";
        echo "1-Modificar nombre \n";
        echo "2-Modificar apellido \n";
        echo "3-Modificar número de documento \n";
        echo "4-Modificar número de teléfono \n";
        echo "Ingrese la opción deseada: ";
        $opcionSeleccionada = solicitarNumeroEntre(1,4);
        return $opcionSeleccionada;

    }

    /** Función diseñada para el menú principal. Cualquiera sea la tecla que ingrese el usuario se mostrará de nuevo el menú.
     *@return VOID
    */
    function presionarEnterContinuar(){
        echo " \n";
        echo "Presione ENTRAR para continuar";
        trim(fgets(STDIN));
    }

   /**
    *Función que imprime la cuadricula de los viajes y su información en pantalla
    *@param ARRAY $viajes
    *@return VOID  
    */ 
    function imprimirCuadriculaViajes($viajes) {
        
        $identacion = "         ";
        echo "***Seleccione el viaje que desea ver modificar*** \n\n";
        echo "N°" . $identacion . "Responsable" . $identacion . "Origen" . $identacion .  "Destino" . $identacion . "Ocupados" . $identacion . "Disponibles \n";
        foreach ($viajes as $objViaje) {
            $nroViaje = $objViaje->getNroViaje();
            $responsableViaje = $objViaje->getResponsableV();
            $origen = $objViaje->getOrigenViaje();
            $destino = $objViaje->getDestinoViaje();
            $ocupados = $objViaje->getCantidadPasajeros();
            $disponibles = $objViaje->getAsientosDisponibles();
            
            echo $nroViaje . $identacion . $responsableViaje . $identacion . $origen . $identacion . $destino . $identacion . $ocupados . $identacion . $identacion . $disponibles . " \n\n";
        }
        echo "Ingrese el número de viaje y presione ENTRAR: ";
       
    }

    /**
     * Función que imprime la cuadricula de los pasajeros y su información en pantalla
     * @param ARRAY $pasajeros
     * @return VOID
    */
    function imprimirCuadriculaPasajeros($pasajeros) {
        if (count($pasajeros) > 0) {
            $nroPasajero = 1;
            $identacion = "         ";
            echo "N°" . $identacion . "Nombre" . $identacion . "Apellido" . $identacion . "Num. Documento" . $identacion .  "Número de teléfono \n" ;
            
            for ($i=0; $i < count($pasajeros) ; $i++) { 
                $pasajeroNro = $nroPasajero;
                $nombre = $pasajeros[$i]->getNombre();
                $apellido = $pasajeros[$i]->getApellido();
                $nroDoc = $pasajeros[$i]->getNroDocumento();
                $telefono = $pasajeros[$i]->getNroTelefono();
                echo $pasajeroNro . $identacion . $nombre . $identacion . $apellido . $identacion . $nroDoc . $identacion . $telefono . " \n\n";
                $nroPasajero++;
            }
            echo "Ingrese el número de pasajero y presione ENTRAR: ";
        } else {
            echo "No hay pasajeros registrados \n";
        }

    }

?>