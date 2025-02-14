<?php

    class ConsolaDTO implements JsonSerializable{

        private int $idconsola;
        private string $nombre;
        private string $lanzamiento;
        private int $idcompania;

        // Constructor con parámetros por defecto para poder utilizar constructores vacíos
        function __construct($idconsola = 0, $nombre = "Desconocido", $lanzamiento = 0, $idcompania = 0){
            
            $this->idconsola = $idconsola;
            $this->nombre = $nombre;
            $this->lanzamiento = $lanzamiento;
            $this->$idcompania = $idcompania;

        }

        
        function jsonSerialize(){
                return get_object_vars($this);
        }

        /**
         * Get the value of idconsola
         */
        public function getIdconsola(): int
        {
                return $this->idconsola;
        }


        /**
         * Get the value of nombre
         */
        public function getNombre(): string
        {
                return $this->nombre;
        }

        /**
         * Get the value of lanzamiento
         */
        public function getLanzamiento(): int
        {
                return $this->lanzamiento;
        }

        

        /**
         * Get the value of idcompania
         */
        public function getIdcompania(): int
        {
                return $this->idcompania;
        }

    }

?>