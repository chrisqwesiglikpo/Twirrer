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

    public function preventAccess($request,$currentFile,$currently){
        if($request=='GET' && $currentFile==$currently){
            header('Location:'.url_for('index.php'));
          }
    }
    public function search($search){
        $stmt=$this->con->prepare("SELECT * FROM `users` WHERE `username` LIKE ? OR `firstName` LIKE ?  LIMIT 4");
        $stmt->bindValue(1,$search.'%',PDO::PARAM_STR);
        $stmt->bindValue(2,$search.'%',PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
     }
     public function searchUser($search){
        $stmt=$this->con->prepare("SELECT * FROM `users` WHERE `username` =:search");
        $stmt->bindParam(":search",$search,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
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
    public function update($table, $user_id, $fields = array()){
        $columns = '';
        $i = 1;

        foreach($fields as $name => $value){
            $columns .= "{$name} = :{$name}";
//            coverPic = :coverPic, profilePic = :profilePic,
            if($i < count($fields)){
                $columns .= ', ';
            }
            $i++;


        }
         $sql = "UPDATE {$table} SET {$columns} WHERE user_id = {$user_id}";
//        UPDATE profile SET coverPic = :coverPic, profilePic = :profilePic WHERE userId = 10;
        if($stmt = $this->con->prepare($sql)){
            foreach($fields as $key => $value){
                $stmt->bindValue(':'.$key, $value);
            }
        }
        $stmt->execute();

    }

    public function updatePost($table, $user_id,$post_id, $fields = array()){
        $columns = '';
        $i = 1;

        foreach($fields as $name => $value){
            $columns .= "{$name} = :{$name}";
//            coverPic = :coverPic, profilePic = :profilePic,
            if($i < count($fields)){
                $columns .= ', ';
            }
            $i++;


        }
         $sql = "UPDATE {$table} SET {$columns} WHERE userId = {$user_id} AND post_id={$post_id}";
//        UPDATE profile SET coverPic = :coverPic, profilePic = :profilePic WHERE userId = 10;
        if($stmt = $this->con->prepare($sql)){
            foreach($fields as $key => $value){
                $stmt->bindValue(':'.$key, $value);
            }
        }
        $stmt->execute();

    }
    public function userIdByUsername($username){
        $stmt=$this->con->prepare("SELECT `user_id` FROM `users` WHERE `username`=:username");
        $stmt->bindParam(":username",$username,PDO::PARAM_STR);
        $stmt->execute();
        $user=$stmt->fetch(PDO::FETCH_OBJ);
        return $user->user_id;
    }

    public function getUsernameById($userid){
        $stmt=$this->con->prepare("SELECT `username` FROM `users` WHERE `user_id`=:user_id");
        $stmt->bindParam(":user_id",$userid,PDO::PARAM_INT);
        $stmt->execute();
        $user=$stmt->fetch(PDO::FETCH_OBJ);
        return $user->username;
    }
    public function cropProfileImageUpload($file,$userid){
        $fileInfo     = getimagesize($file['tmp_name']);
        $fileTmp      = $file['tmp_name'];
        $fileName     = $file['name'];
        $fileSize     = $file['size'];
        $fileType     = $file['type'];
        $errors       = $file['error'];

        //get extenion
        $ext   = explode('/', $fileType);
        $ext   = strtolower(end($ext));

        //extenions types 
        $allowed  = array('image/png', 'image/jpeg', 'image/jpg');

        if(in_array($fileInfo['mime'], $allowed)){
            $path_directory = $_SERVER['DOCUMENT_ROOT']."/Twirrer/frontend/profileImage/".$userid.'/';
  
            if(!file_exists($path_directory) && !is_dir($path_directory)){
                mkdir($path_directory, 0777, true);
            
            }

            $folder   = "frontend/profileImage/".$userid.'/'.substr(md5(time().mt_rand()), 2,25).'.'.$ext;
            $path_file=$_SERVER['DOCUMENT_ROOT']."/Twirrer/".$folder;


            if($errors===0){
                move_uploaded_file($fileTmp,$path_file);
                return $folder;
            }
        }
        
    }

    public function cropCoverImageUpload($file,$userid){
        $fileInfo     = getimagesize($file['tmp_name']);
        $fileTmp      = $file['tmp_name'];
        $fileName     = $file['name'];
        $fileSize     = $file['size'];
        $fileType     = $file['type'];
        $errors       = $file['error'];

        //get extenion
        $ext   = explode('/', $fileType);
        $ext   = strtolower(end($ext));

        //extenions types 
        $allowed  = array('image/png', 'image/jpeg', 'image/jpg');

        if(in_array($fileInfo['mime'], $allowed)){
            $path_directory = $_SERVER['DOCUMENT_ROOT']."/Twirrer/frontend/profileCover/".$userid.'/';
  
            if(!file_exists($path_directory) && !is_dir($path_directory)){
                mkdir($path_directory, 0777, true);
            
            }

            $folder   = "frontend/profileCover/".$userid.'/'.substr(md5(time().mt_rand()), 2,25).'.'.$ext;
            $path_file=$_SERVER['DOCUMENT_ROOT']."/Twirrer/".$folder;


            if($errors===0){
                move_uploaded_file($fileTmp,$path_file);
                return $folder;
            }
        }
        
    }
    public function uploadImage($file,$user_id){
        $fileInfo     = getimagesize($file['tmp_name']);
        $fileTmp      = $file['tmp_name'];
        $fileName     = $file['name'];
        $fileSize     = $file['size'];
        $errors       = $file['error'];

        //get extenion
        $ext   = explode('.', $fileName);
        $ext   = strtolower(end($ext));

        //extenions types 
        $allowed  = array('image/png', 'image/jpeg', 'image/jpg');

        if(in_array($fileInfo['mime'], $allowed)){
            // $folder = 'frontend/content/'.$user_id.'/profilePic/';
           
            $path_directory = $_SERVER['DOCUMENT_ROOT']."/Twirrer/frontend/profileImage/".$user_id.'/';

            if(!file_exists($path_directory) && !is_dir($path_directory)){
                mkdir($path_directory, 0777, true);
            
            }
         
            // $file   = $path_directory.substr(md5(time().mt_rand()), 2,25).'.'.$ext;
           $file=$path_directory.$fileName;
            if($errors === 0){
            
                    move_uploaded_file($fileTmp,$file);
                    return "frontend/profileImage/".$user_id.'/'.$fileName;
                
            }
        }
    }
   
    public function uploadPostImage($file,$user_id){
        $fileInfo     = getimagesize($file['tmp_name']);
        $fileTmp      = $file['tmp_name'];
        $fileName     = $file['name'];
        $fileSize     = $file['size'];
        $errors       = $file['error'];

        //get extenion
        $ext   = explode('.', $fileName);
        $ext   = strtolower(end($ext));

        //extenions types 
        $allowed  = array('image/png', 'image/jpeg', 'image/jpg');

        if(in_array($fileInfo['mime'], $allowed)){
            // $folder = 'frontend/content/'.$user_id.'/profilePic/';
           
            $path_directory = $_SERVER['DOCUMENT_ROOT']."/Twirrer/frontend/media/";

            if(!file_exists($path_directory) && !is_dir($path_directory)){
                mkdir($path_directory, 0777, true);
            
            }
         
            $folder   ="frontend/media/".substr(md5(time().mt_rand()), 2,25).'.'.$ext;
            $file=$_SERVER['DOCUMENT_ROOT']."/Twirrer/".$folder;
            if($errors === 0){
            
                move_uploaded_file($fileTmp,$file);
                return $folder;
                
            }
        }
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
                       return 'Just now';
       
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