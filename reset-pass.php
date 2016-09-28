<?php

use OperationWithDB\Database;

require_once 'php/autoload.php';
require_once 'php/php-functions.php';

$email = '';
$message = '';
$encrypt = '';
$select = "SELECT user_id FROM users where md5(90 * 43 + user_id)='";

$errors = [
	'pass' => '',
	'conf' => ''
];

$haveError = false;
	
if ($_GET['encrypt']) {
	$encrypt = $_GET['encrypt'];
	$sql = $select . $encrypt . "'";
	
	if (!Database::query($sql, ['user_id'])) {
		$message = 'Invalid key please try again! <a href="forgot-pass.php">Forget Password?</a>.';
	}
} else {
	session_destroy();
	header('Location: homepage.php');
	die;
}
if ($_POST) {
	$pass = test_input(getFromArray($_POST, 'pass'));
	$confPass = test_input(getFromArray($_POST, 'conf'));
	
	if (!preg_match('/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $pass)) {
		$errors['pass'] = 'Password format: upper and lower case and number or special char - min 8 chars!';
		$haveError = true;
	}
	if(strcmp($pass, $confPass) !== 0){
		$errors['conf'] = 'The two passwords do not match!';
		$haveError = true;
	}
	if (!$haveError) {
		$sql = $select . $encrypt . "'";
		$index = Database::query($sql, ['user_id'])[0]['user_id'];
		$cryptPass = crypt($pass, '$2a$07$2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi$'); //CRYPT_BLOWFISH

		$sql = "UPDATE users SET password='" . $cryptPass . "' where user_id = " . $index;
		
		Database::query($sql, ['user_id']);
		
		$message = 'Your password changed sucessfully <a href="sign-in.php">Click here to login</a>.';
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Reset Password</title>
		<link href="assets/css/sign-style.css" rel="stylesheet" type="text/css" />
		<link href="assets/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
			nav {
				margin-bottom: 100px;
			}
			footer {
				margin-top: 310px;
			}
			.wrapper input {
				width: 50%;
			}
			.wrapper label {
				width: 30%;
			}
			.wrapper form {
				margin-left: 80px;
			}
			#hidden {
				display: none;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<nav>
				<div>
					<h1 id="logo"><a href="homepage.php">DocCreate</a></h1>
					<ul>
						<li><a href="comming-soon.php">About</a></li>
						<li><a href="comming-soon.php">Blog</a></li>
						<li><a href="comming-soon.php">Terms</a></li>
						<li><a href="comming-soon.php">Privacy</a></li>
						<li><a href="sign-in.php">Login / Sign up</a></li>
					</ul>
				</div>
			</nav>
			<div class="wrapper">
				<h1>
					Enter the new password and confirm it.
				</h1>
				<form id="formLog" action="" method="post">
					<div>
						<label for="pass">Password</label>
						<input class="<?= $errors['pass'] ? 'err' : '';?>" type="password" id="pass" name="pass" />
						<p class="error"><?= $errors['pass'];?></p>
					</div>
					<div>
						<label for="conf">Confirm Password</label>
						<input class="<?= $errors['conf'] ? 'err' : '';?>" type="password" id="conf" name="conf" />
						<p class="error"><?= $errors['conf'] ? $errors['conf'] : $message;?></p>
					</div>
					<div id="<?= Database::query($sql, ['user_id']) ? '' : 'hidden' ?>">
						<button>Reset</button>
					</div>
				</form>		
			</div>
			<footer>
				<p>
					<a href="https://plus.google.com">
						<span class="fa fa-google-plus"></span>
					</a>
					<a href="https://www.pinterest.com">
						<span class="fa fa-pinterest"></span>
					</a>
					<a href="https://twitter.com">
						<span class="fa fa-twitter"></span>
					</a>
					<a href="https://www.facebook.com/">
						<span class="fa fa-facebook"></span>
					</a>
					<a href="https://www.instagram.com/">
						<span class="fa fa-instagram"></span>
					</a>
				</p>
				<p>DocCreate &copy; 2016 - Privacy Policy</p> 
			</footer>
		</div>
	</body>
</html>