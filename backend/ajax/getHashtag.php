<?php
 include '../init.php';

 if(isset($_POST['hashtag'])){
     $hashtag=$account->formSanitizer($_POST['hashtag']);
     $mention=$account->formSanitizer($_POST['hashtag']);

     if(substr($hashtag,0,1)==='#'){
        $trend=str_replace('#','',$hashtag);
        $trends=$loadFromPost->getTrendByhash($trend);

        foreach ($trends as $hashtag) {
        echo '<li><span class="getValue">#'.$hashtag->hashtag.'</span></li>';
        }
     }
     if(substr($mention,0,1)==='@'){
        $mention=str_replace('@','',$mention);
        $mentions=$loadFromPost->getMention($mention);

        foreach ($mentions as $mention) {
        echo '<li><div class="nav-right-down-inner">
                   <div class="nav-right-down-left">
                       <span><img src="'.url_for($mention->profilePic).'"></span>
                   </div>
                   <div class="nav-right-down-right">
                       <div class="nav-right-down-right-headline">
                           <h4>'.$mention->screenName.'</h4><span class="getValue">@'.$mention->username.'</span>
                       </div>
                   </div>
               </div><!--nav-right-down-inner end-here-->
           </li>';
        }
     }
}
?> 