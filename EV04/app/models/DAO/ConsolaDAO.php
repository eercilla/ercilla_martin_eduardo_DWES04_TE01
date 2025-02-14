<?php


    class ConsolaDAO{

        private $db;
    
        function __construct(){

                //Instanciamos la clase de la base de datos singleton
                $this->db=DatabaseSingleton::getInstance();
                
        }

        public function getAllConsolaDAO(){

                // Conectamos con la BD, creamos y añadimos la query y guardamos el resultado en un array
                $connection = $this->db->getConnection();
                $query = "SELECT * FROM videojuegos_bd.consola;";
                $statement = $connection->query($query);
                $cArray = $statement->fetchAll(PDO::FETCH_ASSOC);

                return $cArray;


        }
        public function getConsolaByIdDAO($id){
                
                $connection = $this->db->getConnection();
                $query =        "SELECT * FROM videojuegos_bd.consola
                                 WHERE idconsola=".$id.";";
                $statement = $connection->query($query);
                $consola = $statement->fetchAll(PDO::FETCH_ASSOC);

                // Comprobamos si el $id existe
                if(!Helpers::idExisteConsola($id, $connection)){
                        http_response_code(404);
        
                        // Muestra el error
                        echo json_encode(["error" => "Consola no encontrada", "code" => 404], JSON_PRETTY_PRINT);
                        exit();
                }

                // Aunque pasándole el id solo va a obtener un título, al ser único, convertimos a una lista de DTOs por si hiciera falta en otro contexto
                $listaConsolasDTO = [];

                // Añadimos los elementos a la lista creada
                for($i = 0; $i < count($consola); $i++){

                        $fila = $consola[$i];

                        $consolaDTO = new ConsolaDTO(
                                $fila["idconsola"],
                                $fila["nombre"],
                                $fila["lanzamiento"],
                                $fila["idcompania"]
                        );

                        $listaConsolasDTO[] = $consolaDTO;
                }

                return $listaConsolasDTO;

        }

        public function createConsolaDAO($data){
                try{
                        $connection = $this->db->getConnection();

                        $query =        "INSERT INTO videojuegos_bd.consola (nombre, lanzamiento, idcompania) 
                        VALUES (:nombre, :lanzamiento, :idcompania)";

                        // Preparamos la declaración
                        $stmt = $connection->prepare($query);

                        // Asignamos valores de $data a los parámetros
                        $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
                        $stmt->bindParam(':lanzamiento', $data['lanzamiento'], PDO::PARAM_STR);
                        $stmt->bindParam(':idcompania', $data['idcompania'], PDO::PARAM_STR);

                        // Ejecutar la declaración
                        $stmt->execute();
                        
                        return true;
                }catch (PDOException $e) { // Si sucede algún error como que el nombre (único) se repite
                        http_response_code(400);
                        echo "Error " . $e->getMessage();
                        return false;
                }
        }

        public function updateConsolaDAO($id, $data){
                try{
                        $connection = $this->db->getConnection();

                        // Comprobamos si el $id existe
                        if(!Helpers::idExisteConsola($id, $connection)){

                                http_response_code(404);

                                // Muestra el error
                                echo json_encode(["error" => "Consola no encontrada", "code" => 404], JSON_PRETTY_PRINT);
                                exit();
                        }

                        $query =        "UPDATE videojuegos_bd.consola 
                                        SET nombre = :nombre, lanzamiento = :lanzamiento, idcompania = :idcompania 
                                        WHERE idconsola = :idconsola";

                        // Preparamos la declaración
                        $stmt = $connection->prepare($query);

                        // Asignamos valores de $data a los parámetros
                        $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
                        $stmt->bindParam(':lanzamiento', $data['lanzamiento'], PDO::PARAM_STR);
                        $stmt->bindParam(':idcompania', $data['idcompania'], PDO::PARAM_STR);
                        $stmt->bindParam(':idconsola', $id, PDO::PARAM_INT);


                        // Ejecutamos la declaración
                        $stmt->execute();

                        return true;
                }catch (PDOException $e) { // Si sucede algún error como que el nombre (único) se repite
                        http_response_code(400);
                        echo "Error " . $e->getMessage();
                        return false;
                }

        }

        public function deleteConsolaDAO($id){
        
                $connection = $this->db->getConnection();

                // Comprobamos si existe antes de la ejecución, porque sino siempre va a dar negativo
                if(!Helpers::idExisteConsola($id, $connection)){
                        // Hace que el cliente muestre por pantalla el error requerido en lugar de terminar con éxito
                        http_response_code(404);
        
                        // Muestra el error
                        echo json_encode(["error" => "Consola no encontrada", "code" => 404], JSON_PRETTY_PRINT);
                        exit();
                }

                // Preparamos la consulta SQL con parámetros de marcador de posición
                $query = "DELETE FROM videojuegos_bd.consola WHERE idconsola = :idconsola";
        
                // Preparamos la declaración
                $stmt = $connection->prepare($query);
        
                // Asignamos valor al parámetro
                $stmt->bindParam(':idconsola', $id, PDO::PARAM_INT);

        
                // Ejecutamos la declaración
                $stmt->execute();

                return true;
        }

}

?>