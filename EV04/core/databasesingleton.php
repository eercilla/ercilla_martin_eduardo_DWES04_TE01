<?php



class DatabaseSingleton{
    private static $instance;
    private $connection;

    private $config = [];

    public function __construct(){
        $this->loadConfig();

        // Conexión PDO con los parámetros almacenados en el json de la carpeta config
        $this->connection = new PDO(
            "mysql:host={$this->config['host']};dbname={$this->config['dbname']}",
            $this->config['user'],
            $this->config['password']
        
        );
    }

    
    private function loadConfig(){

        // Obtenemos los datos del fichero json de la carpeta config
        $json_file = file_get_contents(__DIR__ .'/../config/db-conf.json', true);
        $this->config = json_decode($json_file, true);

    }

    public static function getInstance(){

        // Instanciamos una única instancia
        if(!self::$instance){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }
}

?>