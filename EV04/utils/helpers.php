<?php

    class Helpers{

        function __construct(){

        }

        
        // Funcion para obtener un elemento del array con el id enviado
        public static function obtenerElementoPorId($id, $array) {
            foreach ($array as $elemento) {
                if ($elemento['id'] == $id) {
                return $elemento; }
            }
            return null;
        }

    
        public static function inicializarRouter($router){

            $router->add('/public', array(
                'controller' => 'Home',
                'action' => 'index'
            ));
            
            // Rutas para entidad juego
            
            
            $router->add('/public/juego/get', array(
                'controller' => 'Juego',
                'action' => 'getAllJuego'
            ));
            
            $router->add('/public/juego/get/{id}', array(
                'controller' => 'Juego',
                'action' => 'getJuegoById'
            ));
            
            $router->add('/public/juego/create', array(
                'controller' => 'Juego',
                'action' => 'createJuego'
            ));
            
            $router->add('/public/juego/update/{id}', array(
                'controller' => 'Juego',
                'action' => 'updateJuego'
            ));
            
            $router->add('/public/juego/delete/{id}', array(
                'controller' => 'Juego',
                'action' => 'deleteJuego'
            ));

            // Rutas para entidad compania

            $router->add('/public/compania/get', array(
                'controller' => 'Compania',
                'action' => 'getAllCompania'
            ));
            
            $router->add('/public/compania/get/{id}', array(
                'controller' => 'Compania',
                'action' => 'getCompaniaById'
            ));
            
            $router->add('/public/compania/create', array(
                'controller' => 'Compania',
                'action' => 'createCompania'
            ));
            
            $router->add('/public/compania/update/{id}', array(
                'controller' => 'Compania',
                'action' => 'updateCompania'
            ));
            
            $router->add('/public/compania/delete/{id}', array(
                'controller' => 'Compania',
                'action' => 'deleteCompania'
            ));


            // Rutas para entidad sistema

            
            $router->add('/public/sistema/get', array(
                'controller' => 'Sistema',
                'action' => 'getAllSistema'
            ));
            
            $router->add('/public/sistema/get/{id}', array(
                'controller' => 'Sistema',
                'action' => 'getSistemaById'
            ));
            
            $router->add('/public/sistema/create', array(
                'controller' => 'Sistema',
                'action' => 'createSistema'
            ));
            
            $router->add('/public/sistema/update/{id}', array(
                'controller' => 'Sistema',
                'action' => 'updateSistema'
            ));
            
            $router->add('/public/sistema/delete/{id}', array(
                'controller' => 'Sistema',
                'action' => 'deleteSistema'
            ));
        }

        public static function idExisteJuego($id, $connection) {

        
                // Preparamos la consulta para comprobar si el ID existe
                $query = "SELECT COUNT(*) FROM videojuegos_bd.videojuego WHERE idjuego = :idjuego";
        
                // Preparamos la declaración
                $stmt = $connection->prepare($query);
        
                // Asignamos valor al parámetro
                $stmt->bindParam(':idjuego', $id, PDO::PARAM_INT);
        
                // Ejecutamos la declaración
                $stmt->execute();
        
                // Obtenemos el resultado
                $count = $stmt->fetchColumn();
        
                // Verificamos si el ID existe
                return $count > 0;
            }

            public static function idExisteCompania($id, $connection) {

        
                // Preparamos la consulta para comprobar si el ID existe
                $query = "SELECT COUNT(*) FROM videojuegos_bd.compania WHERE idcompania = :idcompania";
        
                // Preparamos la declaración
                $stmt = $connection->prepare($query);
        
                // Asignamos valor al parámetro
                $stmt->bindParam(':idcompania', $id, PDO::PARAM_INT);
        
                // Ejecutamos la declaración
                $stmt->execute();
        
                // Obtenemos el resultado
                $count = $stmt->fetchColumn();
        
                // Verificamos si el ID existe
                return $count > 0;
            }

            public static function idExisteConsola($id, $connection) {

        
                // Preparamos la consulta para comprobar si el ID existe
                $query = "SELECT COUNT(*) FROM videojuegos_bd.consola WHERE idconsola = :idconsola";
        
                // Preparamos la declaración
                $stmt = $connection->prepare($query);
        
                // Asignamos valor al parámetro
                $stmt->bindParam(':idconsola', $id, PDO::PARAM_INT);
        
                // Ejecutamos la declaración
                $stmt->execute();
        
                // Obtenemos el resultado
                $count = $stmt->fetchColumn();
        
                // Verificamos si el ID existe
                return $count > 0;
            }


    
    }

    

?>