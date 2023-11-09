<?php 
class dataBase
{
    private $host     = 'localhost';
    private $db_name  = 'garage';
    private $user     = 'root';
    private $password = 'usbw';
    
    public function __construct() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        

        if( !$this->connection ) {
            throw new Exception('error');
        }
    }
    
    
    function selectOne($table,$columm,$value){
        $result = $this->connection->query("SELECT * FROM `$table` where `$columm`= '$value' LIMIT 1")->fetch_all(MYSQLI_ASSOC);     
        return $result[0];
    }


    function selectAll($table){
        $result = $this->connection->query("SELECT * FROM `$table`");     
        return $result;
    }


    function INSERT($table,$column,$value){
        $textTable = '';
        $textValue = '';
        foreach ($column as $v){
            $textTable = $textTable . '`' . $v . '`,';
        }
        $textTable = mb_substr($textTable, 0, -1);
        foreach ($value as $v){
            if($v == "NULL" || $v == "current_timestamp()"){
                $textValue = $textValue  . $v . ",";
            }else{
                $textValue = $textValue . "'" . $v . "',";
            }
        }
        $textValue = mb_substr($textValue, 0, -1);
        //print_r("INSERT INTO `$table` ($textTable) VALUES ($textValue)");
        $this->connection->query("INSERT INTO `$table` ($textTable) VALUES ($textValue)");    
        return;
    }


    function queryDB($e){
        $this->connection->query($e);   
    }

    function queryReturnDB($e){
        $result = $this->connection->query($e)->fetch_all(MYSQLI_ASSOC);    
        return $result;   
    }
    function queryReturnDBAll($e){
        $result = $this->connection->query($e);    
        return $result;   
    }
}

