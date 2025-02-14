<?php

    class JuegoEntity{

        private int $idJuego;
        private string $título;
        private string $idCompania;
        private string $sistema;
        private string $genero;
    
        function __construct($idJuego = 0, $título = "Desconocido", $idCompania = 0, $sistema = "Desconocido", $genero ="Desconocido"){
            
            $this->id = $id;
            $this->título = $título;
            $this->compania = $compania;
            $this->sistema = $sistema;
            $this->genero = $genero;

        }


        /**
         * Get the value of idJuego
         */
        public function getIdJuego(): int
        {
                return $this->idJuego;
        }

        /**
         * Set the value of idJuego
         */
        public function setIdJuego(int $idJuego): self
        {
                $this->idJuego = $idJuego;

                return $this;
        }

        /**
         * Get the value of t
         */
        public function getT(): string
        {
                return $this->t;
        }

        /**
         * Set the value of t
         */
        public function setT(string $t): self
        {
                $this->t = $t;

                return $this;
        }

        /**
         * Get the value of idCompania
         */
        public function getIdCompania(): string
        {
                return $this->idCompania;
        }

        /**
         * Set the value of idCompania
         */
        public function setIdCompania(string $idCompania): self
        {
                $this->idCompania = $idCompania;

                return $this;
        }

        /**
         * Get the value of sistema
         */
        public function getSistema(): string
        {
                return $this->sistema;
        }

        /**
         * Set the value of sistema
         */
        public function setSistema(string $sistema): self
        {
                $this->sistema = $sistema;

                return $this;
        }

        /**
         * Get the value of genero
         */
        public function getGenero(): string
        {
                return $this->genero;
        }

        /**
         * Set the value of genero
         */
        public function setGenero(string $genero): self
        {
                $this->genero = $genero;

                return $this;
        }
    }

?>