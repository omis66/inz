<?php
session_start();

if(!isset($_SESSION['zalogowany'])) //dodajemy tam gdzie ma wstęp tylko zalogowany 
{
	header('Location: index.php');
	exit();
}
$points = 100;
$_SESSION['pointsg'] = $points;
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
		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
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
					<div class="welcome">
						<?php
						echo "Witaj ".$_SESSION['user']."!";
						echo '<span class="best-score">'.'Twój najlepszy wynik:'.'</span>';
						require_once "polaczenie.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$nazwa_usera = $_SESSION['user'];
$sql = "SELECT id, user, score FROM wyniki WHERE user='$nazwa_usera' order by score desc";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

  $licznik = 0;
  while($row = mysqli_fetch_assoc($result)) {
	$licznik = $licznik + 1;
	if($licznik==1)
	{
	echo '<div class="rank-score-best">'.$row['score'].'</div>';
	}
  }
} else {
  echo '<span class="nogame">'.'Musisz zagrać przynajmniej raz żebym wskazał Ci wynik!'.'</span>';
}

mysqli_close($conn);
						?>

					</div>
					<div class="instruction">
					<span>Instrukcja</span>
					<p>Przed Tobą 5 pytań + pytanie rozgrzewkowe.<br>
					Za każdą poprawną odpowiedź możesz dostać 10 punktów.Wskazanie niepoprawnej odpowiedzi (z wyłączeniem pytania rozgrzewkowego) generuje ujemne punkty. W zależności od pomyłki możesz otrzymać -20 punktów, -10 punktów oraz - 5 punktów. Zaczynasz grę z licznikiem wskazującym 100 punktów.	<br>
					<span class="caution"> Uwaga </span>
					<br>
					W trakcie gry nie cofaj wstecz!
					</p>
					</div>
				</div>
			</section>
			<section class="second">
			
			<div class="quiz">
				<span class="info-text"> Rozgrzewka </span>
				<div class="q q1">
				<img src="img/strona.jpg" alt="Zdjęcie obrazujące stronę"></div>
				<span class="question"> W którym roku powstała strona DronTrzebownisko.PL?</span>
				<form class="anserw-button-box" method="get" action="pytanie1.php">
  				<button class="anserw-button" name="p_m" value="1">2016</button>
  				<button class="anserw-button" name="p_m" value="2">2018</button>
				<button class="anserw-button " name="p_m" value="3">2019</button>
  				<button class="anserw-button" name="p_m" value="4">2017</button>
				</form>
			</div>
			</section>
		</main>
		<footer class="footer">
			<p> &copy; Michał Krudysz 2022 </p>
		</footer>
	</body>
</html>
