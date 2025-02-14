<?php

    class Juego{

        private $juegoDAO;

        // Contruímos una instancia de juegoDAO para acceder a la BD
        function __construct(){
            $this->juegoDAO = new juegoDAO();
        }


        function getAllJuego(){

            $data = $this->juegoDAO->getAllJuegoDAO();


            if (!$data) {
                    http_response_code(400);
                    echo json_encode(["error" => "BD vacía", "code" => 400], JSON_PRETTY_PRINT);
                    exit();
            }

            http_response_code(200);
            echo json_encode(["status" => "Success", "message" => "Recurso obtenido con exito", "code" => 200, "data" => $data], JSON_PRETTY_PRINT)."\n";
        }


        function getJuegoById($id){

            $data = $this->juegoDAO->getJuegoByIdDAO($id);

            if (!$data) {

                http_response_code(400);
                echo json_encode(["error" => "BD vacía", "code" => 400], JSON_PRETTY_PRINT);
                exit();
            }

            echo json_encode(["status" => "Success", "message" => "Juego encontrado con exito", "code" => 200, "data" => $data], JSON_PRETTY_PRINT)."\n";

            
        }



        function createJuego($data){
            $resultado = $this->juegoDAO->createJuegoDAO($data);

            if($resultado){
                http_response_code(200);
                echo json_encode(["status" => "Success", "message" =>  "Juego creado con exito", "code" => 200, "data" => $data], JSON_PRETTY_PRINT)."\n";
            }
            exit();

        }

        function updateJuego($id, $data){

            $resultado = $this->juegoDAO->updateJuegoDAO($id, $data);

            if($resultado){

                http_response_code(200);
                echo json_encode(["status" => "Success", "message" => "Juego con ID: ".$id." actualizado con exito", "code" => 204], JSON_PRETTY_PRINT)."\n";
    
            }


        }

        function deleteJuego($id){

            $resultado = $this->juegoDAO->deleteJuegoDAO($id);

            if($resultado){
                http_response_code(200);

                echo json_encode(["status" => "Success", "message" =>  "Juego con ID: ".$id." borrado con exito", "code" => 204], JSON_PRETTY_PRINT);
            }
        }
    }

?>