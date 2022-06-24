<?php
	session_start();
	if(!isset($_POST['login']))
	{
		header('Location: index.php');
		exit();
	}
	require_once "polaczenie.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($polaczenie -> connect_errno!=0)
	{
		echo "Error".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$sql = "SELECT * FROM uzytkownicy WHERE user='$login' AND pass='$haslo'";

		if($wynik = @$polaczenie->query($sql))
		{
			$ilu=$wynik->num_rows;
			if($ilu>0)
			{
				$_SESSION['zalogowany'] = true;				
				$wiersz = $wynik->fetch_assoc();
				$_SESSION['id']= $wiersz['id'];
				$_SESSION['user'] =$wiersz['user'];
				// 58 minuta
				unset($_SESSION['blad']);
				$wynik->close();
				header('Location: zalogowany.php');

			}
			else
			{
				$_SESSION['blad'] = '<span> Zły login lub hasło! </span>';
				header('Location: index.php');
			}
		}
		$polaczenie->close();
	}
?>