<?php
// used to get mysql database connection
class Database{
 
    // specify your own database credentials
    private $host = "jfrpocyduwfg38kq.chr7pe7iynqr.eu-west-1.rds.amazonaws.com	";
    private $db_name = "f47vjrc8rc7igrlt";
    private $username = "qwycn4m9tlxxfq1f";
    private $password = "dr2zfq5w9lybhusq";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>
