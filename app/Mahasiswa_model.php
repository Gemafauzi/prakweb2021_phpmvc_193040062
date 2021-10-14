<?php 

class Mahasiswa_model{

    private $dbh;   //Database Handler
    private $stmt;

    public function __construct()
    {
        //Data Source Name
        $dsn = 'mysql:host=localhost;dbname=prakweb2021_phpmvc_193040056';
try{
            $this->dbh = new PDO($dsn, 'root', '');
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    public function getAllMahasiswa(){
        $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        
    }


?> 