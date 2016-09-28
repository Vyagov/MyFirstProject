<?php

require_once 'php/serverSignUp.php';

//session_start();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Login / Sign up</title>
		<link href="assets/css/sign-style.css" rel="stylesheet" type="text/css" />
		<link href="assets/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="assets/node_modules/jquery/dist/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/js-functions.js"></script>
		<script type="text/javascript" src="assets/js/index.js"></script>
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
			<div>
				<div class="wrapper">
					<h1>Login with a DocCreate Account</h1>
					<form id="formLog" action="" method="post">
						<div>
							<input type="email" id="email" placeholder="Email address"/>
							<span></span>
						</div>
						<div id="error">
							<p></p>
						</div>
						<div>
							<input type="password" id="pass" placeholder="Password"/>
							<span></span>
						</div>
						<div id="forgot">
							<p>
								<a href="forgot-pass.php">Forgot Password</a>
							</p>
						</div>
						<div>
							<button>Login</button>
						</div>
					</form>
				</div>
				<div class="wrapper">
					<h1>New to DocCreate? Sign up!</h1>
					<form id="formSign" action="" method="post">
						<div>
							<label for="fname">First Name</label>
							<input class="<?php echo $errors['fname'] ? 'err' : '';?>" type="text" id="fname" name="fname" value="<?= $fname;?>" />
							<p class="error"><?= $errors['fname'];?></p>
						</div>
						<div>
							<label for="lname">Last Name</label>
							<input class="<?php echo $errors['lname'] ? 'err' : '';?>" type="text" id="lname" name="lname" value="<?= $lname;?>" />
							<p class="error"><?= $errors['lname'];?></p>
						</div>
						<div>
							<label for="email">Email Address</label>
							<input class="<?php echo $errors['email'] ? 'err' : '';?>" type="email" id="email" name="email" value="<?= $email;?>" />
							<p class="error"><?= $errors['email'];?></p>
						</div>
						<div>
							<label for="pass">Password</label>
							<input class="<?php echo $errors['pass'] ? 'err' : '';?>" type="password" id="pass" name="pass" />
							<p class="error"><?= $errors['pass'];?></p>
						</div>
						<div>
							<label for="conf">Confirm Password</label>
							<input class="<?php echo $errors['conf'] ? 'err' : '';?>" type="password" id="conf" name="conf" />
							<p class="error"><?= $errors['conf'];?></p>
						</div>
						<div>
							<button>Sign up!</button>
						</div>
					</form>
				</div>
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