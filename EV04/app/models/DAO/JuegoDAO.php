<?php


    class JuegoDAO{

        private $db;
    
        function __construct(){
                //Instanciamos la clase de la base de datos singleton
                $this->db=DatabaseSingleton::getInstance();
                
        }

        public function getAllJuegoDAO(){
                // Conectamos con la BD, creamos y añadimos la query y guardamos el resultado en un array
                $connection = $this->db->getConnection();
                $query = "SELECT * FROM videojuegos_bd.videojuego;";
                $statement = $connection->query($query);
                $jArray = $statement->fetchAll(PDO::FETCH_ASSOC);

                return $jArray;


        }
        public function getJuegoByIdDAO($id){
                
                $connection = $this->db->getConnection();
                $query =        "SELECT * FROM videojuegos_bd.videojuego v
                                JOIN videojuegos_bd.compania c ON v.idcompania = c.idcompania
                                WHERE idjuego=".$id.";";
                $statement = $connection->query($query);
                $juego = $statement->fetchAll(PDO::FETCH_ASSOC);

                // Comprobamos si el $id existe
                if(!Helpers::idExisteJuego($id, $connection)){
                        http_response_code(404);
        
                        // Muestra el error
                        echo json_encode(["error" => "Juego no encontrado", "code" => 404], JSON_PRETTY_PRINT);
                        exit();
                }

                // Aunque pasándole el id solo va a obtener un título, al ser único, convertimos a una lista de DTOs por si hiciera falta en otro contexto
                $listaJuegosDTO = [];

                // Añadimos los elementos a la lista creada
                for($i = 0; $i < count($juego); $i++){

                        $fila = $juego[$i];

                        $juegoDTO = new JuegoDTO(
                                $fila["idjuego"],
                                $fila["titulo"],
                                $fila["nombre"],
                                $fila["sistema"],
                                $fila["genero"]
                        );

                        $listaJuegosDTO[] = $juegoDTO;
                }

                return $listaJuegosDTO;

        }

        public function createJuegoDAO($data){
                try{
                        $connection = $this->db->getConnection();

                        $query =        "INSERT INTO videojuegos_bd.videojuego (titulo, idcompania, sistema, genero) 
                        VALUES (:titulo, :idcompania, :sistema, :genero)";

                        // Preparamos la declaración
                        $stmt = $connection->prepare($query);

                        // Asignamos valores de $data a los parámetros
                        $stmt->bindParam(':titulo', $data['titulo'], PDO::PARAM_STR);
                        $stmt->bindParam(':idcompania', $data['idcompania'], PDO::PARAM_INT);
                        $stmt->bindParam(':sistema', $data['sistema'], PDO::PARAM_STR);
                        $stmt->bindParam(':genero', $data['genero'], PDO::PARAM_STR);

                        // Ejecutar la declaración
                        $stmt->execute();
                        
                        return true;
                }catch (PDOException $e) { // Si sucede algún error como que el nombre (único) se repite
                        http_response_code(400);
                        echo "Error " . $e->getMessage();
                        return false;
                }
        }

        public function updateJuegoDAO($id, $data){
                try{
                        $connection = $this->db->getConnection();

                        // Comprobamos si el $id existe
                        if(!Helpers::idExisteJuego($id, $connection)){

                                http_response_code(404);

                                // Muestra el error
                                echo json_encode(["error" => "Juego no encontrado", "code" => 404], JSON_PRETTY_PRINT);
                                exit();
                        }

                        $query =        "UPDATE videojuegos_bd.videojuego 
                                        SET titulo = :titulo, idcompania = :idcompania, sistema = :sistema, genero = :genero 
                                        WHERE idjuego = :idjuego";

                        // Preparamos la declaración
                        $stmt = $connection->prepare($query);

                        // Asignamos valores de $data a los parámetros
                        $stmt->bindParam(':titulo', $data['titulo'], PDO::PARAM_STR);
                        $stmt->bindParam(':idcompania', $data['idcompania'], PDO::PARAM_INT);
                        $stmt->bindParam(':sistema', $data['sistema'], PDO::PARAM_STR);
                        $stmt->bindParam(':genero', $data['genero'], PDO::PARAM_STR);
                        $stmt->bindParam(':idjuego', $id, PDO::PARAM_INT);


                        // Ejecutamos la declaración
                        $stmt->execute();

                        return true;
                }catch (PDOException $e) { // Si sucede algún error como que el nombre (único) se repite
                        http_response_code(400);
                        echo "Error " . $e->getMessage();
                        return false;
                }

        }

        public function deleteJuegoDAO($id){
        
                $connection = $this->db->getConnection();

                // Comprobamos si existe antes de la ejecución, porque sino siempre va a dar negativo
                if(!Helpers::idExisteJuego($id, $connection)){
                        // Hace que el cliente muestre por pantalla el error requerido en lugar de terminar con éxito
                        http_response_code(404);
        
                        // Muestra el error
                        echo json_encode(["error" => "Juego no encontrado", "code" => 404], JSON_PRETTY_PRINT);
                        exit();
                }

                // Preparamos la consulta SQL con parámetros de marcador de posición
                $query = "DELETE FROM videojuegos_bd.videojuego WHERE idjuego = :idjuego";
        
                // Preparamos la declaración
                $stmt = $connection->prepare($query);
        
                // Asignamos valor al parámetro
                $stmt->bindParam(':idjuego', $id, PDO::PARAM_INT);

        
                // Ejecutamos la declaración
                $stmt->execute();

                return true;
        }

}

?>