<?php

use OperationWithDB\Users;

require_once 'php/autoload.php';
require_once 'php/php-functions.php';

$email = '';
$message = '';
$errors = ['email' => ''];

if ($_POST) {
	$email = test_input(getFromArray($_POST, 'email'));
	
	if (!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/', $email)) {
		$errors['email'] = 'Invalid email!';
	} else {
		$user = new Users('', $email);
		$check = $user->checkEmail();
		
		if ($check) {
			$encrypt = md5(1290 * 3 + $check[0]['user_id']);
            $message = "Your password reset link send to your e-mail address.";
            $to = $email;
            $subject = "Forget Password";
            $from = "doccreate@support.bg";
            $body = 'Hello, ' . $check[0]['first_name'] . '. <br/> <br/>Your Membership ID is ' . $check[0]['user_id'] . 
            		' <br><br>Open this link to reset your password http://localhost/MyFirstProject/reset-pass.php?encrypt=' .
            		$encrypt . '<br/><br/>--<br>DocCreate<br>Solve your problems.';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            mail($to,$subject,$body,$headers);
			
		} else {
			$errors['email'] = 'No this email in database!';
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Forgot Password</title>
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
			.wrapper form {
				margin-left: 80px;
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
					To reset your password, submit your email address below. 
					If we can find you in the database, an email will be sent 
					to your email address, with instructions how to get access again.
				</h1>
				<form id="formLog" action="" method="post">
					<div>
						<label for="email">Email Address</label>
						<input class="<?= $errors['email'] ? 'err' : '';?>" type="email" id="email" name="email" value="<?= $email;?>" />
						<p class="error"><?= $errors['email'] ? $errors['email'] : $message;?></p>
					</div>
					<div>
						<button>Search</button>
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