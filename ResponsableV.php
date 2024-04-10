<?php
    class ResponsableV {
        private $nroEmpleado;
        private $nroLicencia;
        private $nombre;
        private $apellido;

        public function __construct(int $nroEmpleado, int $nroLicencia, string $nombre, string $apellido) {
            $this->nroEmpleado = $nroEmpleado;
            $this->nroLicencia = $nroLicencia;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
        }

        public function __toString() {
            return $this->nombre . " "  . $this->apellido;
        }
    }
?>