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
    public function search($search){
        $stmt=$this->con->prepare("SELECT * FROM `users` WHERE `username` LIKE ? OR `firstName` LIKE ? ");
        $stmt->bindValue(1,$search.'%',PDO::PARAM_STR);
        $stmt->bindValue(2,$search.'%',PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
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

    public function userIdByUsername($username){
        $stmt=$this->con->prepare("SELECT `user_id` FROM `users` WHERE `username`=:username");
        $stmt->bindParam(":username",$username,PDO::PARAM_STR);
        $stmt->execute();
        $user=$stmt->fetch(PDO::FETCH_OBJ);
        return $user->user_id;
    }

    public function timeAgo($datetime){
        $time = strtotime($datetime);
               $current = time();
               $seconds = $current-$time;
               $minutes = round($seconds/60);
               $hours = round($seconds/3600);
               $months = round($seconds/2600640);
       
               if($seconds <= 60){
                   if($seconds == 0){
                       return '0s';
       
                   }else{
                       return ''.$seconds.'s';
                   }
       
               }else if($minutes <= 60){
                   return ''.$minutes.'m';
               }else if($hours <= 24){
                   return ''.$hours.'h';
               }else if($months <= 24){
                   return ''.date('M j', $time);
               }else{
                   return ''.date('j M Y', $time);
               }
           }

    
}

?>