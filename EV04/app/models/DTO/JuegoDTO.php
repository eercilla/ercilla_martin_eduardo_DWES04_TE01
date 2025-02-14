<?php

    class JuegoDTO implements JsonSerializable{

        private int $idJuego;
        private string $titulo;
        private string $NombreCompania;
        private string $sistema;
        private string $genero;
    
        function __construct($idJuego = 0, $titulo = "Desconocido", $NombreCompania = "", $sistema = "Desconocido", $genero ="Desconocido"){
            
            $this->idJuego = $idJuego;
            $this->titulo = $titulo;
            $this->NombreCompania = $NombreCompania;
            $this->sistema = $sistema;
            $this->genero = $genero;

        }


        public function jsonSerialize(){
                return get_object_vars($this);
        }

        /**
         * Get the value of idJuego
         */
        public function getIdJuego(): int
        {
                return $this->idJuego;
        }


        /**
         * Get the value of t
         */
        public function getTitulo(): string
        {
                return $this->titulo;
        }


        /**
         * Get the value of idCompania
         */
        public function getIdCompania(): string
        {
                return $this->idCompania;
        }


        /**
         * Get the value of sistema
         */
        public function getSistema(): string
        {
                return $this->sistema;
        }


        /**
         * Get the value of genero
         */
        public function getGenero(): string
        {
                return $this->genero;
        }

}

?>