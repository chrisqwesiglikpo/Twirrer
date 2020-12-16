<?php
include 'backend/init.php';

if(Login::isLoggedIn()){
    $user_id=Login::isLoggedIn();

}else if(isset($_SESSION['userLoggedIn'])){
    $user_id=$_SESSION['userLoggedIn'];
}else{
    redirect_to(url_for("index.php"));
}
if(isset($_GET['username']) == true && empty($_GET['username']) === false){
        $username =h($_GET['username']);
        $profileId = $loadFromUser->userIdByUsername($username);
}
else{
    $profileId =$user_id;
}

$profileData = $loadFromUser->userData($profileId);
$user = $loadFromUser->userData($user_id);
$followCount=$loadFromFollow->displayFollowerCount($profileId);
$page_title="Messages / Twitter";

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user_id; ?>"  data-pid="<?php echo $profileId ?>"></div>
<?php require_once 'backend/shared/mainNav.php'; ?>
<section class="mainSectionContainer">
    <div class="header-top">
            <h4>New message</h4>
           
    </div>
    <div class="chatPageContainer">
        <div class="chatTitleBar">
           <label for="userSearchTextbox">To:</label>
           <div id="selectedUsers">
                <input type="text" id="userSearchTextbox" placeholder="Type the name of the person" autofocus>
           </div>
        </div>
        <div class="resultsContainer" aria-label="Timeline:Inbox">
               
        </div>
        <button id="createChatButton" type="button" disabled="true">Create Chat</button>
    </div>
    
</section>
</main>

<?php require_once 'backend/shared/mainFooter.php'; ?>