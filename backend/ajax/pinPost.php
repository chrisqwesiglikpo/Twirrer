<?php
 require_once('../init.php');
 if(isset($_POST['showPinPost']) && !empty($_POST['showPinPost'])){
    
    echo '<div class="pin-post-wrapper">
    <div class="pin-post-content">
        <h2 class="pin-post-content-header">Pin Tweet to profile?</h2>
        <p>This will appear at the top of your profile and replace any previously pinned Tweet</p>
        <div class="pin-btn-wrapper">
            <button class="pin-btn" id="cancel" type="button">Cancel</button>
            <button class="pin-btn" id="pin-post-btn" type="button">Pin</button>
        </div>
    </div>
  </div>';
    
    
  }