<?php
    /**
     *Muestra el menú principal en pantalla. Luego solicita al usuario que ingrese un número válido, correspondiente a la opción del menú que desea ejecutar.
     *@return INT 
    */
    function seleccionarOpcion() {
        //INT $opcionSeleccionada
        echo "1- Agregar un nuevo viaje \n";
        echo "2- Modificar un viaje \n";
        echo "3- Consultar información sobre viajes \n"; 
        echo "4- Salir del programa \n";
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
?>