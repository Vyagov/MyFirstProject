<?php

use OperationWithDB\Users;

require_once 'autoload.php';
require_once 'php-functions.php';

$email = getFromArray($_POST, 'emailAddress');
$pass = getFromArray($_POST, 'password');

$cryptPass = crypt($pass, '$2a$07$2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi$'); //CRYPT_BLOWFISH

$user = new Users($cryptPass, $email);

echo $user->checkLogin();

