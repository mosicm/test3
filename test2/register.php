<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="wrapper">
		
		<div id="header">
			
			<div id="nav">
				
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="register.php">Register</a></li>
					<li><a href="login.php">Login</a></li>
				</ul>

			</div><!-- end of nav -->

			<div id="search">
				
				<form method="post" action="results.php">
					<select name="field">
						<option value="name">Name</option>
						<option value="email">Email</option>
					</select>
					<input type="text" name="filter">
					<input type="submit" name="btn_search" value="Search">

				</form>

			</div><!-- end of #search -->

		</div><!-- end of #header -->

		<div id="main">
			
			<div class="form">

				<?php

				if(isset($_POST['btn_submit'])){
	
					$form_val = new FormValidation;

					// Validacija POST promenljivih.
					$name = $form_val->validateName($_POST['name']);
					$email = $form_val->validateEmail($_POST['email']);
					$password = $form_val->validatePassword($_POST['password'], $_POST['re_password']);

					// Greske su cuvaju u polju errors klase FormValidation. Ukoliko ih ima bice prikazane, u suprotnom korisnik se unosi u bazu, pokrece se sesija koja ce sadrzati ime korisnika i odgovarajucu poruku, vrsi se redirekcija na index stranu.
					if(count($form_val->errors) > 0){
						echo "<div class='error'>";
						echo "<ul>";
						foreach($form_val->errors as $error){
							echo "<li>{$error}</li>";
						}
						echo "</ul>";
						echo "</div>";
					}else{
						$user = new User;
						$user->name = $name;
						$user->email = $email;
						$user->password = md5($password);
						$user->save();
						session_start();
						$_SESSION['name'] = $user->name;
						$_SESSION['success'] = "You've successfully registered";
						header("Location: index.php");
					}

				}

				?>

				<form method="post" action="">
					Name:<br>
					<input type="text" name="name" class="form-text"><br>
					Email:<br>
					<input type="text" name="email" class="form-text"><br>
					Password:<br>
					<input type="text" name="password" class="form-text"><br>
					Confirm Password:<br>
					<input type="text" name="re_password" class="form-text"><br><br>
					<input type="submit" name="btn_submit" value="Save" class="form-btn">
				</form>

			</div>

		</div><!-- end of #main -->

		<div id="footer">
			
			<p>Copyright by </p>

		</div><!-- end of #footer -->

	</div><!-- end of #wrapper -->
</body>
</html>