<section class="wrapper" role="region">
    <header>
            <nav role="navigation" id="nav">
                <a href="<?php echo url_for("home"); ?>" class="site-logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" ><g><path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z" fill="#1DA1F2"/></g></svg>
                </a>
                <a href="<?php echo url_for("home"); ?>" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="home-link"><g><path d="M22.58 7.35L12.475 1.897c-.297-.16-.654-.16-.95 0L1.425 7.35c-.486.264-.667.87-.405 1.356.18.335.525.525.88.525.16 0 .324-.038.475-.12l.734-.396 1.59 11.25c.216 1.214 1.31 2.062 2.66 2.062h9.282c1.35 0 2.444-.848 2.662-2.088l1.588-11.225.737.398c.485.263 1.092.082 1.354-.404.263-.486.08-1.093-.404-1.355zM12 15.435c-1.795 0-3.25-1.455-3.25-3.25s1.455-3.25 3.25-3.25 3.25 1.455 3.25 3.25-1.455 3.25-3.25 3.25z"/></g></svg>
                <h3>Home</h3>
                </a>
                <a href="<?php echo url_for("expore.php"); ?>" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="home-link"><g><path d="M21 7.337h-3.93l.372-4.272c.036-.412-.27-.775-.682-.812-.417-.03-.776.27-.812.683l-.383 4.4h-6.32l.37-4.27c.037-.413-.27-.776-.68-.813-.42-.03-.777.27-.813.683l-.382 4.4H3.782c-.414 0-.75.337-.75.75s.336.75.75.75H7.61l-.55 6.327H3c-.414 0-.75.336-.75.75s.336.75.75.75h3.93l-.372 4.272c-.036.412.27.775.682.812l.066.003c.385 0 .712-.295.746-.686l.383-4.4h6.32l-.37 4.27c-.036.413.27.776.682.813l.066.003c.385 0 .712-.295.746-.686l.382-4.4h3.957c.413 0 .75-.337.75-.75s-.337-.75-.75-.75H16.39l.55-6.327H21c.414 0 .75-.336.75-.75s-.336-.75-.75-.75zm-6.115 7.826h-6.32l.55-6.326h6.32l-.55 6.326z"/></g></svg>
                <h3>Explore</h3>
                </a>
                <a href="<?php echo url_for("i/notifications"); ?>" class="notification-container">
                <?php  if(empty(count((array)$notificationCount))){}else{echo '<div class="notification-count">'.count((array)$notificationCount).'</div>';} ?>
                <svg viewBox="0 0 24 24" class="home-link"><g><path d="M21.697 16.468c-.02-.016-2.14-1.64-2.103-6.03.02-2.533-.812-4.782-2.347-6.334-1.375-1.393-3.237-2.164-5.242-2.172h-.013c-2.004.008-3.866.78-5.242 2.172-1.534 1.553-2.367 3.802-2.346 6.333.037 4.332-2.02 5.967-2.102 6.03-.26.194-.366.53-.265.838s.39.515.713.515h4.494c.1 2.544 2.188 4.587 4.756 4.587s4.655-2.043 4.756-4.587h4.494c.324 0 .61-.208.712-.515s-.005-.644-.265-.837zM12 20.408c-1.466 0-2.657-1.147-2.756-2.588h5.512c-.1 1.44-1.29 2.587-2.756 2.587z"></path></g></svg>
                <h3>Notifications</h3>
                </a>
                <a href="<?php echo url_for("messages"); ?>" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="home-link"><g><path d="M19.25 3.018H4.75C3.233 3.018 2 4.252 2 5.77v12.495c0 1.518 1.233 2.753 2.75 2.753h14.5c1.517 0 2.75-1.235 2.75-2.753V5.77c0-1.518-1.233-2.752-2.75-2.752zm-14.5 1.5h14.5c.69 0 1.25.56 1.25 1.25v.714l-8.05 5.367c-.273.18-.626.182-.9-.002L3.5 6.482v-.714c0-.69.56-1.25 1.25-1.25zm14.5 14.998H4.75c-.69 0-1.25-.56-1.25-1.25V8.24l7.24 4.83c.383.256.822.384 1.26.384.44 0 .877-.128 1.26-.383l7.24-4.83v10.022c0 .69-.56 1.25-1.25 1.25z"/></g></svg>
                <h3>Messages</h3>
                </a>
                <a href="<?php echo url_for("profile"); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="home-link" ><g><path d="M12 11.816c1.355 0 2.872-.15 3.84-1.256.814-.93 1.078-2.368.806-4.392-.38-2.825-2.117-4.512-4.646-4.512S7.734 3.343 7.354 6.17c-.272 2.022-.008 3.46.806 4.39.968 1.107 2.485 1.256 3.84 1.256zM8.84 6.368c.162-1.2.787-3.212 3.16-3.212s2.998 2.013 3.16 3.212c.207 1.55.057 2.627-.45 3.205-.455.52-1.266.743-2.71.743s-2.255-.223-2.71-.743c-.507-.578-.657-1.656-.45-3.205zm11.44 12.868c-.877-3.526-4.282-5.99-8.28-5.99s-7.403 2.464-8.28 5.99c-.172.692-.028 1.4.395 1.94.408.52 1.04.82 1.733.82h12.304c.693 0 1.325-.3 1.733-.82.424-.54.567-1.247.394-1.94zm-1.576 1.016c-.126.16-.316.246-.552.246H5.848c-.235 0-.426-.085-.552-.246-.137-.174-.18-.412-.12-.654.71-2.855 3.517-4.85 6.824-4.85s6.114 1.994 6.824 4.85c.06.242.017.48-.12.654z"/></g></svg>
                <h3>Profile</h3>
                </a>
                
            </nav>
            <div class="header-footer" role="button" tabindex="0" data-focusable="true" id="modalButton">
                <div class="image-wrapper">
                    <img src="<?php echo url_for($user->profilePic); ?>" alt="User Profile Pic">
                </div>
                <div class="user-name">
                    <span class="user-fullname"><?php echo $user->firstName." ".$user->lastName; ?></span>
                    <span class="user-screenName">@<?php echo $user->username; ?></span>
                </div>
                <img src="<?php echo url_for('frontend/assets/images/down.svg'); ?>" alt="" width="20px" height="20px">
            </div>
                    <!-- The Modal -->
            <div id="myLogoutModal" class="logout-modal">
                <!-- Modal content -->
                <div class="logout-modal-body">
                    <div class="logout-modal-header" role="button" tabindex="0" data-focusable="true">
                        <div class="wrapper-image">
                            <img src="<?php echo url_for($user->profilePic); ?>" alt="User Profile Pic">
                        </div>
                        <div class="user-name">
                            <span class="user-fullname"><?php echo $user->firstName." ".$user->lastName; ?></span>
                            <span class="user-screenName">@<?php echo $user->username; ?></span>
                        </div>
                        <img src="<?php echo url_for('frontend/assets/images/check.svg'); ?>" alt="" width="20px" height="20px">
                    </div>
                    <div class="logout-modal-footer">
                        <a href="<?php echo url_for("logout"); ?>">
                        <i class="fa fa-sign-out"></i>  Log out @<?php echo $user->username; ?>
                    </a>
                    </div>   
                </div>
        

            </div>
        </header>
    <main role="main">