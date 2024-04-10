<?php

/**
 * Importante: Deben enviar el link a la resolución en su repositorio en GitHub del ejercicio.

    La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes. De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.

    Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase (incluso los datos de los pasajeros). Utilice clases y arreglos  para   almacenar la información correspondiente a los pasajeros. Cada pasajero guarda  su “nombre”, “apellido” y “numero de documento”.

    Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita cargar la información del viaje, modificar y ver sus datos.

    Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre, apellido, numero de documento y teléfono. El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. También se desea guardar la información de la persona responsable de realizar el viaje, para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. La clase Viaje debe hacer referencia al responsable de realizar el viaje.

    Implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos. Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. De la misma forma cargue la información del responsable del viaje.

    Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub.
*/
    

    /**
     * Describe la clase viaje. Cada instancia sera un viaje, el cual tendrá un Responsable de viaje, una lista de Pasajeros y un identificador único.
    */

        class Viaje {
            private $nroViaje;
            private $origen;    
            private $destino;
            private $cantidadPasajeros = 0;
            private $capacidadMaxima = 20;
            private $objResponsableV;
            private $pasajeros = [];

            //CONSTRUCTOR
            public function __construct(ResponsableV $viajeResponsable, string $viajeOrigen, string $viajeDestino, int $nroViaje) {
                $this->objResponsableV = $viajeResponsable;
                $this->origen = $viajeOrigen;
                $this->destino = $viajeDestino;
                $this->nroViaje = $nroViaje;
            }

            //Número de viaje
            public function getNroViaje() {
                return $this-> nroViaje;
            }
            
            //Obtener persona responsable del viaje
            public function getResponsableV() {
                return $this->objResponsableV;
            }

            //Obtener origen del viaje
            public function getOrigenViaje() {
                return $this->origen;
            }

            //Obtener destino del viaje
            public function getDestinoViaje() {
                return $this->destino;
            }

            //Obtener cantidad de pasajeros actual del viaje
            public function getCantidadPasajeros() {
                return $this->cantidadPasajeros;
            }

            //Obtener cantidad de asientos disponibles
            public function getAsientosDisponibles(){
                $disponibles = $this->capacidadMaxima - $this->cantidadPasajeros;
                return $disponibles;
            }

            //Obtener lista de pasajeros
            public function getListaPasajeros()
            {
                return $this->pasajeros;
            }

            /**
             * Verifica si un pasajero está o no registrado en el viaje.
             * @param OBJECT $objNuevoPasajero
             * @return BOOLEAN
            */
            public function verificarSiEstaPasajero(Pasajero $objNuevoPasajero) {
                //BOOLEAN $encontrado
                //INT $count
                $encontrado = false;
                $count = 0;

                while (($encontrado == false) && ($count < $this->cantidadPasajeros)) {
                    if(($this->pasajeros[$count]->getNroDocumento()) == $objNuevoPasajero->getNroDocumento()) {
                        $encontrado = true;
                    }
                    $count++;
                }
                return $encontrado;
            }

            /**
             * Agrega un pasajero al viaje, luego de verificar si hay capacidad disponible. 
             * @param OBJECT $objPasajeroNuevo
             * @return STRING 
            */
            public function agregarNuevoPasajero(Pasajero $ObjPasajeroNuevo) {
                //STRING $mensaje
                $mensaje = null;

                if (($this->cantidadPasajeros) < ($this->capacidadMaxima)) {
                    $this->pasajeros[] = $ObjPasajeroNuevo;
                    $this->cantidadPasajeros +=1;
                    $mensaje = "Pasajero agregado correctamente!";
                } else {
                    $mensaje = "El viaje ha alcanzado su capacidad máxima!";
                }
                return $mensaje;
            }

            public function __toString() {
                return $this->nroViaje . "    " . $this->objResponsableV . "    " . $this->origen . "     " . $this->destino . "    " . $this->cantidadPasajeros . "         " . $this->capacidadMaxima;
            }

        }