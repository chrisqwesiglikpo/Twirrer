<?php
include '../init.php';

if(isset($_POST['search']) && !empty($_POST['search'])){
    $search=h($_POST['search']);

    $result=$loadFromUser->search($search);
    echo '<ul id="suggestion">';
    if(!empty($result)){
    foreach($result as $user){
        echo '<li>
        <a href="'.url_for($user->username).'">
            <div id="image-wrapper-suggest">
                <img src="'. url_for($user->profilePic) .'" alt="User Profile Pic">
            </div>
            <div class="suggest-name">
                <h2>'.$user->firstName." ".$user->lastName.'</h2>
                <h4>@'.$user->username.'</h4>
            </div>
        </a>
      </li>';
    }
}else{
    echo '<div class="no-result">No Results Found</div>';
}
    echo '</ul>';
}


?>