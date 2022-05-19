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
	<link rel = 'stylesheet' href = 'home.css'/>
	<script src = 'home.js' defer = 'true'></script> 
    <title>Home</title>
  </head>

  <body>
	<div id = 'navbar'>
		<div class = 'riga'><a id = 'active' href='home.php'>Home</a></div>
		<div class = 'riga'><a href = 'search.php'>Cerca</a></div>
		<div class = 'riga' id = 'logout'><a href = 'logout.php'>Logout</a></div>
	</div> 
	
	<h1 id = 'benvenuto'>Benvenuto <?php echo $_SESSION['username'] ?>!</h1>
	
	<div id = 'add'>Crea la tua nuova playlist:
		<input type = 'text' id = 'titolo'>
		<input id = 'bottone' value = 'Crea' type = 'submit'>
	</div>
	
	<div id = 'contenitore'></div>

  </body>
</html>

<?php
if (isset($_POST['titolo'])) {
    $connessione = mysqli_connect('localhost', 'root', '', 'HomeWork') or die('Errore: '.mysqli_connect_error());
    mysqli_query($connessione, 'set character set utf8');
    $user = $_SESSION['username'];
    $titolo = $_POST['titolo'];
	if ($titolo != '') {
		$query = "insert into raccolta(titolo, img_url, nome_utente) values('".$titolo."', 'spotify.jpg', '".$user."')"; //dato il titolo della raccolta crea la raccolta
	}
	
    mysqli_query($connessione, $query);
    mysqli_close($connessione);
}
?>



