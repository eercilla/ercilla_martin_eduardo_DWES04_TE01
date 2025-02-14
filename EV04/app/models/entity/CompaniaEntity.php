<?php

    class CompaniaEntity{

        private int $idcompania;
        private string $nombre;
        private int $fundacion;
        private string $pais;

        // Constructor con parámetros por defecto para poder utilizar constructores vacíos
        function __construct($idcompania = 0, $nombre = "Desconocida", $fundacion = 0, $pais = "Desconocido"){
            
            $this->idcompania = $idcompania;
            $this->nombre = $nombre;
            $this->fundacion = $fundacion;
            $this->pais = $pais;

        }

        /**
         * Get the value of idcompania
         */
        public function getIdcompania(): int
        {
                return $this->idcompania;
        }

        /**
         * Set the value of idcompania
         */
        public function setIdcompania(int $idcompania): self
        {
                $this->idcompania = $idcompania;

                return $this;
        }

        /**
         * Get the value of nombre
         */
        public function getNombre(): string
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         */
        public function setNombre(string $nombre): self
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of fundacion
         */
        public function getFundacion(): int
        {
                return $this->fundacion;
        }

        /**
         * Set the value of fundacion
         */
        public function setFundacion(int $fundacion): self
        {
                $this->fundacion = $fundacion;

                return $this;
        }

        /**
         * Get the value of pais
         */
        public function getPais(): string
        {
                return $this->pais;
        }

        /**
         * Set the value of pais
         */
        public function setPais(string $pais): self
        {
                $this->pais = $pais;

                return $this;
        }
    }
?>
