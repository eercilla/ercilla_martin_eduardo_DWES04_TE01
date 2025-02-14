<?php

    class CompaniaDTO implements JsonSerializable{

        private int $idcompania;
        private string $nombre;
        private string $fundacion;
        private string $pais;

        // Constructor con parámetros por defecto para poder utilizar constructores vacíos
        function __construct($idcompania = 0, $nombre = "Desconocida", $fundacion = 0, $pais = "Desconocido"){
            
            $this->idcompania = $idcompania;
            $this->nombre = $nombre;
            $this->fundacion = $fundacion;
            $this->pais = $pais;

        }

        
        function jsonSerialize(){
                return get_object_vars($this);
        }

        /**
         * Get the value of idcompania
         */
        public function getIdcompania(): int
        {
                return $this->idcompania;
        }


        /**
         * Get the value of nombre
         */
        public function getNombre(): string
        {
                return $this->nombre;
        }

        /**
         * Get the value of fundacion
         */
        public function getFundacion(): int
        {
                return $this->fundacion;
        }


        /**
         * Get the value of pais
         */
        public function getPais(): string
        {
                return $this->pais;
        }

    }
?>
