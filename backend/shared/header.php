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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo url_for('frontend/assets/js/jquery.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo url_for('frontend/assets/css/font-awesome/css/font-awesome.css'); ?>">
    <link rel="stylesheet" href="<?php echo url_for('frontend/assets/css/master.css'); ?>">

</head>
<body>

