<?php

    class ConsolaEntity{

        private int $idconsola;
        private string $nombre;
        private int $lanzamiento;
        private int $idcompania;

        // Constructor con parámetros por defecto para poder utilizar constructores vacíos
        function __construct($idconsola = 0, $nombre = "Desconocido", $lanzamiento = 0, $idcompania = 0){
            
            $this->id = $id;
            $this->nombre = $nombre;
            $this->lanzamiento = $lanzamiento;
            $this->$idcompania = $idcompania;

        }

        /**
         * Get the value of idconsola
         */
        public function getIdconsola(): int
        {
                return $this->idconsola;
        }

        /**
         * Set the value of idconsola
         */
        public function setIdconsola(int $idconsola): self
        {
                $this->idconsola = $idconsola;

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
         * Get the value of lanzamiento
         */
        public function getLanzamiento(): int
        {
                return $this->lanzamiento;
        }

        /**
         * Set the value of lanzamiento
         */
        public function setLanzamiento(int $lanzamiento): self
        {
                $this->lanzamiento = $lanzamiento;

                return $this;
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
    }

?>