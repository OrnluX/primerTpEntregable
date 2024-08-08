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

        //GETTERS
        public function getNombre() {
            return $this->nombre;
        }

        public function getApellido() {
            return $this->apellido;
        }

        public function getNroDocumento() {
            return $this->nroDocumento;
        }
        
        public function getNroTelefono() {
            return $this->nroTelefono;
        }


        //SETTERS
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
        
        public function setApellido($apellido) {
            $this->apellido = $apellido;
        }

        public function setNroDocumento($nroDocumento) {
            $this->nroDocumento = $nroDocumento;
        }

        public function setNroTelefono($nroTelefono) {
            $this->nroTelefono = $nroTelefono;
        }
        
        public function __toString()
        {
            return $this->nombre . " " . $this->apellido . " " . $this->nroDocumento . " " . $this->nroTelefono;  
        }
    }
?>                     