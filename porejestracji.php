<?php
	session_start();
	if(!isset($_SESSION['udanarejestracja']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}

?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300&display=swap"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="css/main.css" />
		<title>Quiz z Gminy Trzebownisko</title>
	</head>
	<body>
		<header>
			<div class="logo">
				<img src="./img/logo.png" alt="Logo DonTrzebownisko.pl" />
			</div>
			<div class="nav">
				<a class="button-1" href="index.php">Strona główna</a>
				<a class="button-2" href="rejestracja.php">Załóż konto</a>
				<a class="button-3" href="#">Pomoc</a>
			</div>
		</header>
		<main>
			<section class="first">
				<div class="bg"></div>
				<form action="zaloguj.php" method="post">
					<div class="login-box">
							<div class="login">
							<img class="fav-icon" src="./img/fav.png" alt="Logo obrazkowe strony">
							<span class="success"> Konto utworzone pomyślnie! Możesz się teraz zalogować. </span>
							<label class="text text-login">login</label>
							<input
								class="input"
								type="text"
								name="login"
								required
							/>
							<label class="text password" for="name">hasło</label>
							<input
								class="input"
								type="password"
								name="haslo"
								required
							/>
							<input type="submit" value="Zaloguj się" class="login-button">
							<span class="text-under-button">Skorzystaj z nawigacji na górze i załóż konto aby rozpocząć grę!</span>
							<div class="error">
								<?php
									if(isset($_SESSION['blad']))
									echo $_SESSION['blad'];
									unset($_SESSION['blad']);
								?>
							</div>
						</div>
					</div>
				</form>
			</section>
			<section class="second">
				<div class="points-results">
			<?php
require_once "polaczenie.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, user, score FROM wyniki order by score desc";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

  $licznik = 0;
  while($row = mysqli_fetch_assoc($result)) {
	$licznik = $licznik + 1;
	if($licznik==1)
	{
	echo '<div class="counter1">'.$licznik.'</div>';
    echo '<div class="rank1">'.$row['user'].'</div>';
	echo '<div class="rank-score1">'.$row['score'].'</div>';
	}
	if($licznik==2)
	{
		echo '<div class="counter2">'.$licznik.'</div>';
		echo '<div class="rank2">'.$row['user'].'</div>';
		echo '<div class="rank-score2">'.$row['score'].'</div>';
	}
	if($licznik==3)
	{
		echo '<div class="counter3">'.$licznik.'</div>';
		echo '<div class="rank3">'.$row['user'].'</div>';
		echo '<div class="rank-score3">'.$row['score'].'</div>';
	}
	if($licznik==4)
	{
		echo '<div class="counter4">'.$licznik.'</div>';
		echo '<div class="rank4">'.$row['user'].'</div>';
		echo '<div class="rank-score4">'.$row['score'].'</div>';
	}
	if($licznik==5)
	{
		echo '<div class="counter5">'.$licznik.'</div>';
		echo '<div class="rank5">'.$row['user'].'</div>';
		echo '<div class="rank-score5">'.$row['score'].'</div>';
	}


  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?>

</div>
			</section>
		</main>
		<footer class="footer">
			<p> &copy; Michał Krudysz 2022 </p>
		</footer>
	</body>
</html>
