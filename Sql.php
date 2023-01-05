<?php
/*
class Sql extends PDO { //extend de uma classe nativa, assim tudo que PDO faz publico e protect, Sql faz tambem
    private $conn;

    public function __construct(){
        $this ->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
    }

    private function setParams($statment, $parameters = array()){
        foreach ($parameters as $key => $value) {
            $this->setParams($key, $value);
            
        }
    }
    private function setParam($statment, $key, $value){
        $statment->bindParam($key, $value);
    }
    
    public function execQuery($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();
        return $stmt;
      
    }

    public function select($rawQuery,$params = array()):array{
       $stmt= $this->execQuery($rawQuery, $params);
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        
    

}


?>

*/



class Sql extends PDO {

    private $conn;

    public function __construct() {

        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");

    }


    //
    private function setParams($statment, $parameters = array()) {
            //para cada parametro como chave, passe valor
        foreach ($parameters as $key => $value) {
                           //chama setParam, passa o prepare pelo $statment, passa a chave e o valor
            $this->setParam($statment,$key, $value);

        }

    }
    
    
    private function setParam($statment, $key, $value){
        // no prepare vai juntar a chave com o valor
        $statment->bindParam($key, $value);

    }
    

    //                        $rawQuery é a query bruta, e params os parametros
    public function exequery($rawQuery, $params = array()) {


        //$stmt recebe  o  prepare da $rawquery na conexão
        $stmt = $this->conn->prepare($rawQuery);
        
        //chama e executa o SetParams linha 56
        //passa o prepare no $stmt, e os parametros (os quais são arrays)
        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;

    }

    public function select($rawQuery, $params = array()):array
    {

        $stmt = $this->exequery($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}

?>