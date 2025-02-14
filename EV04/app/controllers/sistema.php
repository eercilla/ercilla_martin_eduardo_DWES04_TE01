<?php

    class Sistema{

        private $consolaDAO;

        // Contruímos una instancia de consolaDAO para acceder a la BD
        function __construct(){
            $this->consolaDAO = new consolaDAO();
        }


        function getAllSistema(){

            $data = $this->consolaDAO->getAllConsolaDAO();


            if (!$data) {
                    http_response_code(400);
                    echo json_encode(["error" => "BD vacía", "code" => 400], JSON_PRETTY_PRINT);
                    exit();
            }

            http_response_code(200);
            echo json_encode(["status" => "Success", "message" => "Recurso obtenido con exito", "code" => 200, "data" => $data], JSON_PRETTY_PRINT)."\n";
        }


        function getSistemaById($id){

            $data = $this->consolaDAO->getConsolaByIdDAO($id);

            if (!$data) {

                http_response_code(400);
                echo json_encode(["error" => "BD vacía", "code" => 400], JSON_PRETTY_PRINT);
                exit();
            }

            echo json_encode(["status" => "Success", "message" => "Consola encontrada con exito", "code" => 200, "data" => $data], JSON_PRETTY_PRINT)."\n";

            
        }



        function createSistema($data){
            $resultado = $this->consolaDAO->createConsolaDAO($data);

            if($resultado){
                http_response_code(200);
                echo json_encode(["status" => "Success", "message" =>  "Consola creada con exito", "code" => 200, "data" => $data], JSON_PRETTY_PRINT)."\n";
            }
            exit();

        }

        function updateSistema($id, $data){

            $resultado = $this->consolaDAO->updateConsolaDAO($id, $data);

            if($resultado){

                http_response_code(200);
                echo json_encode(["status" => "Success", "message" => "Consola con ID: ".$id." actualizada con exito", "code" => 204], JSON_PRETTY_PRINT)."\n";
    
            }


        }

        function deleteSistema($id){

            $resultado = $this->consolaDAO->deleteConsolaDAO($id);

            if($resultado){
                http_response_code(200);

                echo json_encode(["status" => "Success", "message" =>  "Consola con ID: ".$id." borrado con exito", "code" => 204], JSON_PRETTY_PRINT);
            }
        }
    }

?>