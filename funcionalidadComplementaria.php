<?php
    /**
     * Función que lee un número ingresado por el usuario en un rango determinado y verfica: primero que el número sea un caracter numérico entero y luego que se encuentre en el rango. Si no cumple con TODAS las condiciones se le pedirá un número al usuario hasta que este sea válido. Cuando las condiciones se cumplan, se retornará el número validado.
     * @param INT $min
     * @param INT $max
     * @return INT
    */
    function solicitarNumeroEntre ($min, $max) {
        //INT $numero
        $numero = trim(fgets(STDIN));

        if (is_numeric($numero)) { //determina si un string es un número. puede ser float como entero.
            $numero  = $numero * 1; //con esta operación convierto el string en número.
        }
        while (!(is_numeric($numero) && (($numero == (int)$numero) && ($numero >= $min && $numero <= $max)))) {
            echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
            $numero = trim(fgets(STDIN));
            if (is_numeric($numero)) {
                $numero  = $numero * 1;
            }
        }
        return $numero;
    }
?>