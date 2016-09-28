<?php

require_once 'php-functions.php';

session_start();

$index = getFromArray($_POST, 'index');

unset($_SESSION['template'][$index]);

echo json_encode($_SESSION['template']);