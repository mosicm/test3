<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
					
					// Filtriranje POST promenljivih koje dolaze kroz formu.
					$email = FormValidation::clearInput($_POST['email']);
					$password = FormValidation::clearInput($_POST['password']);

					// Uporedjivanje podataka iz forme sa podacima u bazi.Ukoliko su podaci o korisniku tacni u sesiju se smesta ime korisnika i vrsi se redirekcija na index stranu sa odgovarajucom porukom koja se takodje prenosi kroz sesiju. U suprotnom se pojavljuje poruka sa greskom.
					$user = User::checkUser($email, md5($password));
					if($user){
						session_start();
						$_SESSION['name'] = $user->name;
						$_SESSION['success'] = "You've successfully logged in";
						header("Location: index.php");
					}else{
						echo "<h3>Invalid data!Error logging you in!</h3>";
					}

				}

				session_start();
				// Ova poruka dolazi sa results strane ukoliko korisnik pokusa da pristupi strani, a nije ulogovan. Nakon prikaza se brise iz sesije. 
				if(isset($_SESSION['message'])){
					echo "<h3>{$_SESSION['message']}</h3>";
					unset($_SESSION['message']);
				}
				if(isset($_SESSION['name'])){
					echo "<h3>You are already logged in</h3>";
				}else{

				?>
				<form method="post" action="">
					Email:<br>
					<input type="text" name="email" class="form-text"><br>
					Password:<br>
					<input type="text" name="password" class="form-text"><br><br>
					<input type="submit" name="btn_submit" value="Login" class="form-btn">
				</form>
				<?php
				}
				?>

			</div>

		</div><!-- end of #main -->

		<div id="footer">
			
			<p>Copyright by </p>

		</div><!-- end of #footer -->

	</div><!-- end of #wrapper -->
</body>
</html>