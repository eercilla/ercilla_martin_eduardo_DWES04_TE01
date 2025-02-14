<?php

    class Compania{

        private $companiaDAO;

        // Contruímos una instancia de companiaDAO para acceder a la BD
        function __construct(){
            $this->companiaDAO = new companiaDAO();
        }


        function getAllCompania(){

            $data = $this->companiaDAO->getAllCompaniaDAO();


            if (!$data) {
                    http_response_code(400);
                    echo json_encode(["error" => "BD vacía", "code" => 400], JSON_PRETTY_PRINT);
                    exit();
            }

            http_response_code(200);
            echo json_encode(["status" => "Success", "message" => "Recurso obtenido con exito", "code" => 200, "data" => $data], JSON_PRETTY_PRINT)."\n";
        }


        function getCompaniaById($id){

            $data = $this->companiaDAO->getCompaniaByIdDAO($id);

            if (!$data) {

                http_response_code(400);
                echo json_encode(["error" => "BD vacía", "code" => 400], JSON_PRETTY_PRINT);
                exit();
            }

            echo json_encode(["status" => "Success", "message" => "Compania encontrado con exito", "code" => 200, "data" => $data], JSON_PRETTY_PRINT)."\n";

            
        }



        function createCompania($data){
            $resultado = $this->companiaDAO->createCompaniaDAO($data);

            if($resultado){
                http_response_code(200);
                echo json_encode(["status" => "Success", "message" =>  "Compania creado con exito", "code" => 200, "data" => $data], JSON_PRETTY_PRINT)."\n";
            }
            exit();

        }

        function updateCompania($id, $data){

            $resultado = $this->companiaDAO->updateCompaniaDAO($id, $data);

            if($resultado){

                http_response_code(200);
                echo json_encode(["status" => "Success", "message" => "Compania con ID: ".$id." actualizada con exito", "code" => 204], JSON_PRETTY_PRINT)."\n";
    
            }


        }

        function deleteCompania($id){

            $resultado = $this->companiaDAO->deleteCompaniaDAO($id);

            if($resultado){
                http_response_code(200);

                echo json_encode(["status" => "Success", "message" =>  "Compania con ID: ".$id." borrada con exito", "code" => 204], JSON_PRETTY_PRINT);
            }
        }
    }

?>