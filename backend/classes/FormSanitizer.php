<?php
class FormSanitizer{

  public static function sanitizeFormString($data){
        $data=strip_tags($data);
        $data=str_replace(" ","",$data);
        $data=strtolower($data);
        $data=ucfirst($data);
        return $data;
  }

  public static function sanitizeFormUsername($data){
        $data=strip_tags($data);
        $data=str_replace(" ","",$data);
        return $data;
  } 
  public static function sanitizeFormPassword($data){
        $data=strip_tags($data);
        return $data;
  }
  public static function sanitizeFormEmail($data){
        $data=strip_tags($data);
        $data=str_replace(" ","",$data);
        return $data;
  }
}



?>