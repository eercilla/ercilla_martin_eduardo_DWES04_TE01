<?php

    class CompaniaDAO{

        private $db;

        // Constructor con parámetros por defecto para poder utilizar constructores vacíos
        function __construct(){
                //Instanciamos la clase de la base de datos singleton
                $this->db=DatabaseSingleton::getInstance();
        }

        public function getAllCompaniaDAO(){

                // Conectamos con la BD, creamos y añadimos la query y guardamos el resultado en un array
                $connection = $this->db->getConnection();
                $query = "SELECT * FROM videojuegos_bd.compania;";
                $statement = $connection->query($query);
                $cArray = $statement->fetchAll(PDO::FETCH_ASSOC);


                return $cArray;
        }
        public function getCompaniaByIdDAO($id){
                
                // Conectamos con la BD, creamos y añadimos la query y guardamos el resultado en un array
                $connection = $this->db->getConnection();
                $query =        "SELECT * FROM videojuegos_bd.compania
                                WHERE idcompania=".$id.";";
                $statement = $connection->query($query);
                $compania = $statement->fetchAll(PDO::FETCH_ASSOC);

                // Comprobamos si el $id existe
                if(!Helpers::idExisteCompania($id, $connection)){
                        http_response_code(404);
        
                        // Muestra el error
                        echo json_encode(["error" => "Compania no encontrada", "code" => 404], JSON_PRETTY_PRINT);
                        exit();
                }

                // Aunque pasándole el id solo va a obtener un título, al ser único, convertimos a una lista de DTOs por si hiciera falta en otro contexto
                $listaCompaniasDTO = [];

                // Añadimos los elementos a la lista creada
                for($i = 0; $i < count($compania); $i++){

                        $fila = $compania[$i];

                        $companiaDTO = new CompaniaDTO(
                                $fila["idcompania"],
                                $fila["nombre"],
                                $fila["fundacion"],
                                $fila["pais"]
                        );

                        $listaCompaniasDTO[] = $companiaDTO;
                }


                return $listaCompaniasDTO;
        }

        public function createCompaniaDAO($data){
                try{
                        $connection = $this->db->getConnection();

                        $query =        "INSERT INTO videojuegos_bd.compania (nombre, fundacion, pais) 
                        VALUES (:nombre, :fundacion, :pais)";

                        // Preparamos la declaración
                        $stmt = $connection->prepare($query);

                        // Asignamos valores de $data a los parámetros
                        $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
                        $stmt->bindParam(':fundacion', $data['fundacion'], PDO::PARAM_STR);
                        $stmt->bindParam(':pais', $data['pais'], PDO::PARAM_STR);


                        // Ejecutar la declaración
                        $stmt->execute();
                        
                        return true;
                }catch (PDOException $e) { // Si sucede algún error como que el nombre (único) se repite
                        http_response_code(400);
                        echo "Error " . $e->getMessage();
                        return false;
                }
        }

        public function updateCompaniaDAO($id, $data){
                try{
                        $connection = $this->db->getConnection();

                        // Comprobamos si el $id existe
                        if(!Helpers::idExisteCompania($id, $connection)){

                                http_response_code(404);

                                // Muestra el error
                                echo json_encode(["error" => "Compania no encontrado", "code" => 404], JSON_PRETTY_PRINT);
                                exit();
                        }

                        $query =        "UPDATE videojuegos_bd.compania 
                                        SET nombre = :nombre, fundacion = :fundacion, pais = :pais 
                                        WHERE idcompania = :idcompania";

                        // Preparamos la declaración
                        $stmt = $connection->prepare($query);

                        // Asignamos valores de $data a los parámetros
                        $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
                        $stmt->bindParam(':fundacion', $data['fundacion'], PDO::PARAM_STR);
                        $stmt->bindParam(':pais', $data['pais'], PDO::PARAM_STR);
                        $stmt->bindParam(':idcompania', $id, PDO::PARAM_INT);


                        // Ejecutamos la declaración
                        $stmt->execute();

                        return true;
                }catch (PDOException $e) { // Si sucede algún error como que el nombre (único) se repite
                        http_response_code(400);
                        echo "Error " . $e->getMessage();
                        return false;
                }
        }

        public function deleteCompaniaDAO($id){
        
                $connection = $this->db->getConnection();

                // Comprobamos si existe antes de la ejecución, porque sino siempre va a dar negativo
                if(!Helpers::idExisteCompania($id, $connection)){
                        // Hace que el cliente muestre por pantalla el error requerido en lugar de terminar con éxito
                        http_response_code(404);
        
                        // Muestra el error
                        echo json_encode(["error" => "Compania no encontrado", "code" => 404], JSON_PRETTY_PRINT);
                        exit();
                }

                // Preparamos la consulta SQL con parámetros de marcador de posición
                $query = "DELETE FROM videojuegos_bd.compania WHERE idcompania = :idcompania";
        
                // Preparamos la declaración
                $stmt = $connection->prepare($query);
        
                // Asignamos valor al parámetro
                $stmt->bindParam(':idcompania', $id, PDO::PARAM_INT);

        
                // Ejecutamos la declaración
                $stmt->execute();

     
                return true;
        }



}
?>
