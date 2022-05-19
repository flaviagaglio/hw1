<!DOCTYPE html>
<html>
    <head>
		<meta charset = 'utf-8'>
        <title>Login</title>
		<link rel = 'stylesheet' href = 'login.css'/>
		<script src = 'login.js' defer = 'true'></script>
    </head>
	
    <body>
		<h1>Login Page</h1>
		<form name = 'form' method = 'post'>
			<p><label>Nome utente <input type = 'text' name = 'nomeutente'></label></p>
			<p><label>Password <input type = 'password' name = 'password'></label></p>
			<input id = 'bottone' value = 'Entra' type = 'submit'>
		</form>
		</br></br></br>
		<a id = 'link' href = './signup.php'>Non sei ancora registrato? Registrati subito!</a>
    </body>
</html>

<?php
session_start();
if (isset($_SESSION['username'])) {
	header('Location: home.php');
	exit;
}

if (isset($_POST['nomeutente']) && isset($_POST['password'])) { 
	$connessione = mysqli_connect('localhost', 'root', '', 'HomeWork') or die('Errore: '.mysqli_connect_error());
    $user = mysqli_real_escape_string($connessione, $_POST['nomeutente']);
    $pass = mysqli_real_escape_string($connessione, $_POST['password']);
    $exists = false;

    $query = 'select * from utente';
    $res = mysqli_query($connessione, $query) or die('Errore :'.mysqli_error($connessione));
    while ($riga = mysqli_fetch_object($res)) {
        if (($riga->nomeutente === $user) && ($riga->pass === $pass)) {
            $exists = true;
        }
    }
    mysqli_free_result($res);
    mysqli_close($connessione);
	
    if ($exists) {
		$_SESSION['username'] = $_POST['nomeutente'];
		$_SESSION['pass'] = $_POST['password'];
        header('Location: home.php');
        exit;
    } else {
        echo "</br> <p id = 'alert'> I dati inseriti sono errati </p>";
    }
}
?>