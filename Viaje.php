<?php
    /**
     * Describe la clase viaje. Cada instancia sera un viaje, el cual tendrá un Responsable de viaje, una lista de Pasajeros y un identificador único.
    */

        class Viaje {
            private $nroViaje;
            private $origen;    
            private $destino;
            private $capacidadMaxima;
            private $objResponsableV;
            private $arrayPasajeros;

            //CONSTRUCTOR
            public function __construct(ResponsableV $viajeResponsable, string $viajeOrigen, string $viajeDestino, int $nroViaje, int $capacidadMaxima) {
                $this->nroViaje = $nroViaje;
                $this->objResponsableV = $viajeResponsable;
                $this->origen = $viajeOrigen;
                $this->destino = $viajeDestino;
                $this->capacidadMaxima = $capacidadMaxima;
                $this->arrayPasajeros = [];
            }

            //GETTERS
            public function getNroViaje() {
                return $this-> nroViaje;
            }
            
            public function getResponsableV() {
                return $this->objResponsableV;
            }

            public function getOrigenViaje() {
                return $this->origen;
            }

            public function getDestinoViaje() {
                return $this->destino;
            }

            public function getCapacidadMax(){
                return $this->capacidadMaxima;
                
            }

            public function getArrayPasajeros() {
                return $this->arrayPasajeros;
            }

            //SETTERS

            public function setNroViaje($nroViaje){
                $this->nroViaje = $nroViaje;
            }

            public function setResponsableV($objResponsableV){
                $this->objResponsableV = $objResponsableV;
            }

            public function setOrigenViaje($origen) {
                $this->origen = $origen;
            }

            public function setDestinoViaje($destino){
                $this->destino = $destino;
            }

            public function setCapacidadMax($capacidadMaxima) {
                $this->capacidadMaxima = $capacidadMaxima;
            }

            public function setPasajeros($pasajeros){
                $this->arrayPasajeros = $pasajeros;
            }


            /**
             * Obtiene y devuelve la cantidad de pasajeros que hay en el viaje.
             * @return INT
             */
            public function getCantidadPasajeros() {
                return count($this->arrayPasajeros);
            }

            /**
             * Calcula y devuelve la cantidad de asientos disponibles
             * @return INT
             */
            public function obtenerAsientosDisponibles() {
                return  $this->getCapacidadMax() - $this->getCantidadPasajeros();
            }

            /**
             * Verifica si un pasajero está o no registrado en el viaje.
             * @param OBJECT $objNuevoPasajero
             * @return BOOLEAN
            */
            public function verificarSiEstaPasajero(Pasajero $objNuevoPasajero) {
                //BOOLEAN $encontrado
                //INT $indice
                $encontrado = false;
                $indice = 0;

                while (($encontrado == false) && ($indice < $this->getCantidadPasajeros())) {
                    if(($this->arrayPasajeros[$indice]->getNroDocumento()) == $objNuevoPasajero->getNroDocumento()) {
                        $encontrado = true;
                    }
                    $indice++;
                }
                return $encontrado;
            }

            /**
             * Agrega un pasajero al viaje, luego de verificar si hay capacidad disponible. 
             * @param OBJECT $objPasajeroNuevo
             * @return STRING 
            */
            public function agregarNuevoPasajero(Pasajero $objPasajeroNuevo) {
                //STRING $mensaje
                //ANTES QUE NADA, VERIFICAR SI EL PASAJERO ESTÁ, PARA SABER SI SE PUEDE AGREGAR, O NO
                $pasajeroEsta = $this->verificarSiEstaPasajero($objPasajeroNuevo);
                $mensaje = null;

                if ($pasajeroEsta) {
                    $mensaje = "Error! El pasajero ya se encuentra cargado";
                } else {
                    if (($this->getCantidadPasajeros()) < ($this->getCapacidadMax())) {
                        $nuevoArrayDePasajeros = $this->getArrayPasajeros();
                        $nuevoArrayDePasajeros[] = $objPasajeroNuevo;
                        $this->setPasajeros($nuevoArrayDePasajeros);
                        $mensaje = "Pasajero agregado correctamente!";
                    } else {
                        $mensaje = "El viaje ha alcanzado su capacidad máxima!";
                    } 
                }
                return $mensaje;
            }

            public function __toString() {
                return $this->getNroViaje() . " " . $this->getResponsableV() . " " . $this->getOrigenViaje() . " " . $this->getDestinoViaje() . " " . $this->getCantidadPasajeros() . " " . $this->getCapacidadMax();
            }

        }
