<?php
/**
 * Describe la clase pasajero, sus atributos y métodos. 
*/
    class Pasajero {
        private $nombre;
        private $apellido;
        private $nroDocumento;
        private $nroTelefono;

        public function __construct(string $nombre, string $apellido, int $nroDocumento, int $nroTelefono) {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->nroDocumento = $nroDocumento;
            $this->nroTelefono = $nroTelefono;
        }

        /**
         * Retorna el número de documento de un pasajero.
         * @return INT  
        */          
        public function getNroDocumento() {
            return $this->nroDocumento;
        }
        
        /**
         * Setea la información de un pasajero cuando se desea modificar la misma
         * @return VOID
        */
        public function setNuevaInfoPasajero(string $nuevoNombre, string $nuevoApellido, int $nuevoNroTelefono) {
            $this->nombre = $nuevoNombre;
            $this->apellido = $nuevoApellido;
            $this->nroTelefono = $nuevoNroTelefono;
        }
    }
?>                     