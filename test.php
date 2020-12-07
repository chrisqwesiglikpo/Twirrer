$userdata=$this->userData($user_id);
        $stmt=$this->con->prepare("SELECT * FROM post p LEFT JOIN users u ON p.userId = u.user_id   WHERE  p.userId =:user_id
        UNION
        SELECT * FROM post p LEFT JOIN users u ON p.userId = u.user_id  WHERE  p.userId IN (SELECT follow.receiver FROM follow WHERE follow.sender = :user_id ) ORDER BY postedOn DESC LIMIT :num");

        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":num",$num,PDO::PARAM_INT);
        $stmt->execute();