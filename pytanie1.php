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
	$_SESSION['pointsg'] = $_SESSION['pointsg'] + 0;
  }
   if($p_m == 2)
    {
	$_SESSION['pointsg'] = $_SESSION['pointsg'] + 0;
  }
  if($p_m == 3)
  {
  $_SESSION['pointsg'] = $_SESSION['pointsg'] + 0;
}
if($p_m == 4)
{
$_SESSION['pointsg'] = $_SESSION['pointsg'] + 10;
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
		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap" rel="stylesheet">
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
						echo "Cześć ".$_SESSION['user']."!";
						?>
					</div>
					<div class="points">
						<p>Twój aktualny wynik wynosi: </p>
						<?php
						echo '<div class="points">'.'<span>'.$_SESSION['pointsg'].'</span>'." punktów!".'</div>';
						unset($_SESSION['points_u1']);
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
				<span class="info-text2"> Pytanie 1 </span>
				<div class="q q1">
				<img src="img/lotnisko.jpg" alt="Lotnicze zdjęcie portu lotniczego Rzeszów - Jasionka"></div>
				<span class="question"> W którym roku Jan Paweł II wylądował na lotnisku w Jasionce?</span>
				<form class="anserw-button-box" method="get" action="pytanie2.php">
  				<button class="anserw-button" name="p_m" value="1">1991</button>
  				<button class="anserw-button" name="p_m" value="2">1994</button>
				<button class="anserw-button" name="p_m" value="3">1996</button>
  				<button class="anserw-button" name="p_m" value="4">1889</button>
				</form>
				<span class="history">
				<p> Ciekawostka </p>
				Początki istnienia rzeszowskiego lotniska siegają lat okupacji hitlerowskiej. W 1940 roku dla celów wojennych w Jasionce została wybudowana droga startowa o długości 1200 metrów. Niemcy opuszczając lotnisko, dokonali jego kompletnego zniszczenia. </span>
			</div>
			</section>
		</main>
		<footer class="footer">
			<p> &copy; Michał Krudysz 2022 </p>
		</footer>
	</body>
</html>
