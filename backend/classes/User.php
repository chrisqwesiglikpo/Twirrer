<?php
class User{
    protected $con;

    public function __construct(){
      $this->con = Database::instance();
    }
    
    public function userData($user_id){
        $stmt=$this->con->prepare("SELECT * FROM users WHERE user_id=:userid");
        $stmt->bindParam(":userid",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        // echo '<pre>';
        // $stmt->debugDumpParams();
        // echo '</pre>';
        $user=$stmt->fetch(PDO::FETCH_OBJ);
        $count=$stmt->rowCount();
        if($count !=0){
            return $user;
        }else{
            return false;
        }
    }
    public function create($tableName,$fields=array()){
        $columns=implode(',',array_keys($fields));
        $values=':'.implode(', :',array_keys($fields));
        $sql="INSERT INTO `{$tableName}` ({$columns}) VALUES ({$values})";
        if($stmt=$this->con->prepare($sql)){
            foreach($fields as $key => $data){
                $stmt->bindValue(':'.$key,$data);
            }
            $stmt->execute();
            return $this->con->lastInsertId();
        }
    }

    public function delete($table, $array){
        $sql = "DELETE FROM `{$table}`";
        $where = " WHERE ";
        foreach($array as $name=>$value){
            $sql .= "{$where} `{$name}` = :{$name}";
            $where = " AND ";
        }
        if($stmt = $this->con->prepare($sql)){
            foreach($array as $name=>$value){
                $stmt->bindValue(':'.$name, $value);
            }
             $stmt->execute();
        }

    }

    
}

?>