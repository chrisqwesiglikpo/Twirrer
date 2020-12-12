<?php

$allowed  = array('image/png', 'image/jpeg', 'image/jpg');
$ext=explode('/',$allowed[2]);
echo strtolower(end($ext));
