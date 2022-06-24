<?php
session_start();

if(!isset($_SESSION['zalogowany'])) //dodajemy tam gdzie ma wstęp tylko zalogowany 
{
	header('Location: index.php');
	exit();
}
$p_m = $_GET['p_m'];
if($p_m == 1) 
	{
	$_SESSION['pointsg'] = $_SESSION['pointsg'] - 5;
  }
   if($p_m == 2)
    {
	$_SESSION['pointsg'] = $_SESSION['pointsg'] + 10;
  }
  if($p_m == 3)
  {
  $_SESSION['pointsg'] = $_SESSION['pointsg'] - 20;
}
if($p_m == 4)
{
$_SESSION['pointsg'] = $_SESSION['pointsg'] - 10;
}
$nazwa =  $_SESSION['user'];
$punkty = $_SESSION['pointsg'];

			require_once "polaczenie.php";
			$conn = new mysqli($host, $db_user, $db_password, $db_name);
			if ($conn->connect_error) {
				die("Bład " . $conn->connect_error);
			}
			
			$sql = "INSERT INTO wyniki VALUES (NULL, '$nazwa', '$punkty')";
			
			if ($conn->query($sql) === TRUE) {
				// echo "Utworzono rekord";
			} else {
				// echo "Bład " . $sql . "<br>" . $conn->error;
			}
			
			$conn->close();
			
?>

			

<!DOCTYPE html>
<html lang="pl">
	<head>
	<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300&display=swap"
			rel="stylesheet"
		/>
		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
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
				<a class="button-2" href="wyloguj.php">Wyloguj się</a>
				<a class="button-3" href="#">Pomoc</a>
			</div>
		</header>
		<main>
			<section class="first2">
				<div class="bg"></div>
				<div class="login-box2">
					<div class="welcome-res">
						<?php
						echo "Brawo ".$_SESSION['user']."!";
						?>
					</div>
					<div class="points">
						<p>Zdobyłeś: </p>
						<?php
						echo '<div class="points">'.'<span>'.$_SESSION['pointsg'].'</span>'." punktów!".'</div>';
						unset($_SESSION['points']);
						?>
					</div>
					<div class="instruction">
					<span class="caution"> Uwaga </span>
					<br>
					Poniżej znajdziesz rankign 5 najlepszych graczy. <br>
					Skorzystaj z nawigacji na górze aby się wylogować!
					</p>
					</div>
				</div>
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
