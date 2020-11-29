<?php
class User{
    protected $con;

    public function __construct(){
      $this->con = Database::instance();
    }
    
    public function userData($user_id){
        $stmt=$this->con->prepare("SELECT * FROM users WHERE id=:userid");
        $stmt->bindParam(":userid",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        $user=$stmt->fetch(PDO::FETCH_OBJ);
        $count=$stmt->rowCount();
        if($count !=0){
            return $user;
        }else{
            return false;
        }
    }

    
}

?>