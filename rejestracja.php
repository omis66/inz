<?php
	session_start();
	
	if (isset($_POST['login']))
	{
		
		$wszystko_OK=true;
		
		
		$login = $_POST['login'];
		
	
		if ((strlen($login)<5) || (strlen($login)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_login']="Login musi posiadać od 5 do 20 znaków!";
		}
		if (ctype_alnum($login)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_login']="Login może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Wprowadzone hasła różnią się od siebie!";
		}
		require_once "polaczenie.php";
		try
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie -> connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$login'");
				if(!$rezultat) throw new Exception($polaczenie->error);

				$ile_takich_loginow =$rezultat->num_rows;
				if($ile_takich_loginow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_login']="Istnieje w bazie już taki login!";
				}
				if($wszystko_OK==true)
				{
					if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$login', '$haslo1')"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: porejestracji.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				}
				$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo "Błąd serwera!";
			echo '<br />Informacja developerska: '.$e;
		}
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
				<form method="post">
					<div class="login-box">
						<div class="login">
							<img class="fav-icon" src="./img/fav.png" alt="Logo obrazkowe strony">
							<label class="text text-login">login</label>
							<input
								class="input"
								type="text"
								name="login"
								required
							/>
							<?php
								if (isset($_SESSION['e_login']))
									{
									echo '<div class="error">'.$_SESSION['e_login'].'</div>';
									unset($_SESSION['e_login']);
									}
								?>
							<label class="text password" for="name">hasło</label>
							<input
								class="input"
								type="password"
								name="haslo1"
								required
							/>
						<?php
							if (isset($_SESSION['fr_haslo1']))
							{
								echo $_SESSION['fr_haslo1'];
								unset($_SESSION['fr_haslo1']);
							}
						?>
						<?php
							if (isset($_SESSION['e_haslo']))
							{
							echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
							unset($_SESSION['e_haslo']);
							}
						?>	
							<label class="text password" for="name">powtórz hasło</label>
							<input
								class="input"
								type="password"
								name="haslo2"
								required
							/>
						<?php
						if (isset($_SESSION['fr_haslo2']))
						{
							echo $_SESSION['fr_haslo2'];
							unset($_SESSION['fr_haslo2']);
						} ?>
							<input type="submit" value="Utwórz konto" class="login-button">
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
