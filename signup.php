<?php
if(isset($_POST['controllo_user'])) { 
	$exists = false;
	$connessione = mysqli_connect('localhost', 'root', '', 'HomeWork') or die('Errore: '.mysqli_connect_error());
	$username = mysqli_real_escape_string($connessione, $_POST['controllo_user']);
	$query = 'select * from utente';
	$res = mysqli_query($connessione, $query) or die('Errore: '.mysqli_error($connessione));
	while ($riga = mysqli_fetch_object($res)) {
		if ($riga->nomeutente === $username || $username == '') {
			$exists = true;
		}
	}
	mysqli_free_result($res);
	mysqli_close($connessione);
	echo $exists;
	exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
		<meta charset = 'utf-8'>
        <title>Registrazione</title>
		<link rel = 'stylesheet' href = 'signup.css'/>
		<script src = 'signup.js' defer = 'true'></script>
    </head>
	
    <body>
		<h1>Signup Page</h1>
		<form name = 'form' method = 'post'>
			<p><label>Nome <input type = 'text' name = 'nome'></label></p>
			<p><label>Cognome <input type = 'text' name = 'cognome'></label></p>
			<p><label>Email <input type = 'text' name = 'email'></label></p>
			<p><label>Nome utente <input id = 'user' type = 'text' name = 'nomeutente'></label></p>
			<p><label>Password <input type = 'password' name = 'password'></label></p>
			<p><label>Conferma password <input type = 'password' name = 'confermapassword'></label></p>
			<input id = 'bottone' value = 'Registrati' type = 'submit'>
		</form>
		</br></br></br>
		<a id = 'link' href = './login.php'>Se hai già un account, accedi!</a>
    </body>
</html>

<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['pass'])) {
	header('Location: home.php');
	exit;
}


if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['nomeutente']) && isset($_POST['password']) && isset($_POST['confermapassword'])) {
	$connessione = mysqli_connect('localhost', 'root', '', 'HomeWork') or die('Errore: '.mysqli_connect_error());
	$nome = mysqli_real_escape_string($connessione, $_POST['nome']);
	$cognome = mysqli_real_escape_string($connessione, $_POST['cognome']);
	$email = mysqli_real_escape_string($connessione, $_POST['email']);
	$username = mysqli_real_escape_string($connessione, $_POST['nomeutente']);
	$password = mysqli_real_escape_string($connessione, $_POST['password']);
	
	$query = "insert into utente(nome, cognome, email, nomeutente, pass) values('".$nome."','".$cognome."','".$email."','".$username."','".$password."')";
	$res = mysqli_query($connessione, $query) or die("Errore: ".mysqli_error($connessione));
	mysqli_free_result($res);
	mysqli_close($connessione);
	$_SESSION['username'] = $_POST['nomeutente'];
	$_SESSION['pass'] = $_POST['password'];
	header('Location: home.php');
	exit;
}
?>
	