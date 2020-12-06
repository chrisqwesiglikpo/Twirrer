<?php
class ButtonProvider{
    public static function createPostButton($text,$imageSrc,$action,$class,$postId,$postedBy){
        return '<button class="'.$class.'" onclick="'.$action.'" data-post="'.$postId.'" data-user="'.$postedBy.'">
        '.$imageSrc.'
        <span class="likesCounter">'.$text.'</span>
        </button>';
    }
}

?>