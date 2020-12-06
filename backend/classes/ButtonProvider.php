<?php
class ButtonProvider{
    public static function createLikePostButton($text,$imageSrc,$action,$class,$postId,$postedBy){
        return '<button class="'.$class.'" onclick="'.$action.'" data-post="'.$postId.'" data-user="'.$postedBy.'">
        '.$imageSrc.'
        <span class="likesCounter">'.$text.'</span>
        </button>';
    }

    public static function createPostButton($text,$imageSrc,$class,$countClassName,$postId,$postedBy,$user_id){
        return '<button class="'.$class.'" data-post="'.$postId.'" data-postedby="'.$postedBy.'" data-user="'.$user_id.'">
        '.$imageSrc.'
        <span class="'.$countClassName.'">'.$text.'</span>
        </button>';
    }
}

?>