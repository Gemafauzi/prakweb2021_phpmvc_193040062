<?php
class App{
    //Properti Default
    protected $controller = 'Home'; 
    protected $method = 'index';
    protected $params = [];
     
    //Construct
    public function __construct(){
        $url = $this->parseURL(); //Apapun url yang diinput
    
    //Controller
        if(@file_exists('../app/controllers/' . $url[0] . '.php')){ //Pengecekan
            $this->controller = $url[0];
            unset($url[0]); //menghapus string 0
        }
    require_once '../app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;
    
    //method
    if( isset($url[1])){
        if(method_exists($this->controller, $url[1])){
            $this->method = $url[1];
            unset($url[1]);
        }
    }

    // Parameter
    if( !empty($url)){
        $this->params = array_values($url);
        
    }

    // Jalankan controller & method, serta kirimkan params jika ada
    call_user_func_array([$this->controller, $this->method], $this->params);
}

    public function parseURL(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/'); //Menghapus url "/"
            $url = filter_var($url, FILTER_SANITIZE_URL); //Memfilter url yang aneh dari hacker
            $url = explode('/', $url);
            return $url;
        }
    }
}


?>