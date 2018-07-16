<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Results</title>
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
				
				<form method="post" action="">
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
			// Korisnik mora biti ulogovan da bi mogao da vrsi pretragu, u suprotnom se redirektuje na login stranu sa odgovarajucom porukom
			if(isset($_SESSION['name'])){
				
				if(isset($_POST['btn_search'])){

					$field = FormValidation::clearInput($_POST['field']);
					$filter = FormValidation::clearInput($_POST['filter']);

					if(!empty($filter)){
						// Ako search filter nije prazan vrsi se pretraga u bazi i prikazuju se eventualni rezultati
						$users = User::search($field, $filter);
						if($users){
							foreach($users as $user){
							?>
								Name: <?=$user->name?><br>
								Email: <?=$user->email?><hr>
							<?php
							}
						}else{
							echo "No results found.";
						}
					}else{
						echo "Search filter is empty";
					}

				}

			}else{
				$_SESSION['message'] = "Please login";
				header("Location: login.php");
			}
			?>

		</div><!-- end of #main -->

		<div id="footer">
			
			<p>Copyright by </p>

		</div><!-- end of #footer -->

	</div><!-- end of #wrapper -->
</body>
</html>
