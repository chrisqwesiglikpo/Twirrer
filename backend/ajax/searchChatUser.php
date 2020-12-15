<?php
include '../init.php';

if(is_get_request()){
    if(isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])){
      echo $searchTerm=$_GET['searchTerm'];
    }
}