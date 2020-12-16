<?php
include '../init.php';

if(is_get_request()){
    if(isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])){
       $searchTerm=h($_GET['searchTerm']);
       $userid=h($_GET['userid']);
       $results=$loadFromUser->search($searchTerm);
    echo '<div class="resultsContainer__selected-wrapper" role="option" aria-selected="false">
         <ul role="checkbox" data-focusable="true" class="resultsContainer__item-wrapper">';
         if(!empty($results)){
                foreach($results as $result){
                  if($result->user_id !=$userid){
                      echo  '<li role="listitem" class="resultsContainer__listitem" data-profileId="'.$result->user_id.'">
                              <div class="resultsContainer__wrapper-select">
                                <img src="'.url_for($result->profilePic).'"/>
                              </div>
                              <div class="resultsContainer__listitem-name">
                                  <h3>'.$result->firstName." ".$result->lastName.'</h3>
                                  <span>@'.$result->username.'</span>
                              </div>
                          </li>';
                }
            }
        }else{
          echo '<li class="resultsContainer__listitem" style="font-size:15px; color:red;font-weight:bold;">No results Found!!</li>';
        }
            
     echo '</ul>
          </div>';
    }
}