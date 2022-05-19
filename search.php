<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: login.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset = 'utf-8'>
	<meta name = 'viewport' content = 'width=device-width, initial-scale = 1'>
	<script src = 'http://code.jquery.com/jquery-latest.js'></script>
	<link rel = 'stylesheet' href = 'navbar.css'/>
	<link rel = 'stylesheet' href = 'search.css'/>
		<script src = 'search.js' defer = 'true'></script>
    <title>Ricerca</title>
  </head>

  <body>
	<div id = 'navbar'>
		<div class = 'riga'><a href = 'home.php'>Home</a></div>
		<div class = 'riga'><a id = 'active' href = 'search.php'>Ricerca</a></div>
		<div class = 'riga' id = 'logout'><a href = 'logout.php'>Logout</a></div>
	</div>
	<form name = 'form' method = 'post'>
		<input id = 'ricerca' type = 'text' name = 'ricerca' placeholder = "Digita il nome di un artista, un gruppo o una canzone">
		<input id = 'bottone' value = 'Ricerca' type = 'submit'>
	</form>
	<div id = 'content'></div>
  </body>
</html>

<?php
if (isset($_POST['titolo']) && isset($_POST['immagine']) && isset($_POST['idraccolta']) && isset($_POST['idspotify']) && isset($_POST['album']) && isset($_POST['artista'])) {
    $connessione = mysqli_connect('localhost', 'root', '', 'HomeWork') or die('Errore: '.mysqli_connect_error());
    mysqli_query($connessione, 'set character set utf8');
    $user = $_SESSION['username'];
    $titolo = $_POST['titolo'];
    $immagine = $_POST['immagine'];
    $idraccolta = $_POST['idraccolta'];
    $idspotify = $_POST['idspotify'];
	$album = $_POST['album'];
	$artista = $_POST['artista'];
	
	do {
		$query = "select id_contenuto from contenuto where id_risorsa_spotify = '$idspotify'"; 
		$res = mysqli_query($connessione, $query);
		if(mysqli_num_rows($res) == 0) {
			$query = "insert into contenuto(titolo, id_risorsa_spotify, img_url, nome_album, artisti) values('".$titolo."', '".$idspotify."', '".$immagine."', '".$album."', '".$artista."')";
			mysqli_query($connessione, $query);
		} 
	} while(mysqli_num_rows($res) == 0);
	
	$query = "insert into associazione(id_raccolta, id_contenuto) values('".$idraccolta."', (select id_contenuto from contenuto where titolo = '".$titolo."'))";
	
	$query2 = "update raccolta set img_url = '".$immagine."' where id_raccolta = '".$idraccolta."' and img_url = 'spotify.jpg'"; //aggiorna l'immagine della raccolta
	mysqli_query($connessione, $query2);
	
    mysqli_query($connessione, $query);
    mysqli_close($connessione);
}
?>