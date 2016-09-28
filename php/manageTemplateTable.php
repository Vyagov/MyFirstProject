<?php

require_once 'php-functions.php';

session_start();

$template = isset($_SESSION['template']) ? $_SESSION['template'] : [];

echo json_encode($template);