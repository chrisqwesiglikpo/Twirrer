<?php

if(!isset($page_title)){
    $page_title="Home / Twitter";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title><?php echo $page_title; ?></title>
    <link
      href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.9/cropper.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.9/cropper.min.js"></script>
    <script src="<?php echo url_for('frontend/assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo url_for('frontend/assets/js/jquery.js'); ?>"></script>
    <link rel="icon" type="image" href="<?php echo url_for('frontend/assets/images/twitter.ico'); ?>">
    <!-- <link rel="icon" type="image" href="<?php //echo url_for('frontend/assets/favicon/favicon.png'); ?>"> -->
    <link rel="stylesheet" href="<?php echo url_for('frontend/assets/css/font-awesome/css/font-awesome.css'); ?>">
    <link rel="stylesheet" href="<?php echo url_for('frontend/assets/css/master.css'); ?>">
    <link rel="stylesheet" href="<?php echo url_for('frontend/assets/dist/emojionearea.min.css'); ?>">

</head>
<body>

