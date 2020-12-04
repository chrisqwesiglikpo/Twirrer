<?php $loadFromFollow->followBtn($profileId,$user_id); ?>
<?php if( $user_id != $profileId)://Not on User ?>
    <a href="<?php echo url_for('messages.php?id='.$profileData->user_id); ?>" class="profileButton">
      <i class="fa fa-envelope"></i>
    </a>
    <button class="followButton" data-user="<?php echo $user->user_id; ?>">Follow</button>
<?php endif; ?>
<?php if( $user_id == $profileId)://Not on User ?>
    <button class="followButton" data-user="<?php echo $user->user_id; ?>" data-profile="<?php ?>">Edit Profile</button>
<?php endif; ?>


?>
<h4><a href="'.url_for($user->username).'">'.$user->firstName." ".$user->lastName.'</a></h4>