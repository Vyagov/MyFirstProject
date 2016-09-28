<?php

use OperationWithDB\Database;
use OperationWithDB\Users;

require_once 'autoload.php';
require_once 'php-functions.php';

session_start();

$fname = '';
$lname = '';
$email = '';

$errors = [
	'fname' => '',
	'lname' => '',
	'email' => '',
	'pass' => '',
	'conf' => ''
];

$haveError = false;

if ($_POST) {
	$fname = test_input(getFromArray($_POST, 'fname'));
	$lname = test_input(getFromArray($_POST, 'lname'));
	$email = test_input(getFromArray($_POST, 'email'));
	$pass = test_input(getFromArray($_POST, 'pass'));
	$confPass = test_input(getFromArray($_POST, 'conf'));

	if (!preg_match('/^[a-zA-Z]*$/', $fname) || $fname == '') {
		$errors['fname'] = 'Invalid first name!';
		$haveError = true;
	}
	if (!preg_match('/^[a-zA-Z]*$/', $lname) || $lname == '') {
		$errors['lname'] = 'Invalid last name!';
		$haveError = true;
	}
	if (!preg_match('/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $pass)) {
		$errors['pass'] = 'Password format: upper and lower case and number or special char - min 8 chars!';
		$haveError = true;
	}
	if (!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/', $email)) {
		$errors['email'] = 'Invalid email!';
		$haveError = true;
	} else {
		$user = new Users('', $email);
		$check = $user->checkEmail();

		if ($check) {
			$haveError = true;
			$errors['email'] = 'With this email already exists account!';
		}
	}
	if(strcmp($pass, $confPass) !== 0){
		$errors['conf'] = 'The two passwords do not match!';
		$haveError = true;
	}
	if (!$haveError) {
		$cryptPass = crypt($pass, '$2a$07$2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi$'); //CRYPT_BLOWFISH
		
		$user = new Users($cryptPass, $email, $fname, $lname);
		
		Database::insertObject($user);
		
		header('Location: blanks.php');
		die;
	}
}