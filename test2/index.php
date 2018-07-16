<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
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
			
			<?php
			session_start();
			// Nakon redirekcije prilikom registracije i logovanja prikazuje se poruka da je operacija uspesna, a potom se odmah brise is sesije.
			if(isset($_SESSION['success'])){
				echo "<h3>{$_SESSION['success']}</h3>";
				unset($_SESSION['success']);
			}
			// Ukoliko je korisnik ulogovan prikazuje se pozdravna poruka, u suprotnom se trazi da se uloguje ili registruje.
			if(isset($_SESSION['name'])){
				echo "<h1>Welcome " . $_SESSION['name'] . "</h1>";
				echo "<div class='logout-btn'><a href='logout.php'>Logout</a></div>";
			}else{
				echo "<h1>Welcome guest!<br>Please login or register if you don't have an account.</h1>";
			}
			?>

		</div><!-- end of #main -->

		<div id="footer">
			
			<p>Copyright by </p>

		</div><!-- end of #footer -->

	</div><!-- end of #wrapper -->
</body>
</html>
