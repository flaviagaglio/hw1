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
	<link rel = 'stylesheet' href = 'collection.css'/>
	<script src = 'collection.js' defer = 'true'></script> 
	<link href = 'https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i' rel = 'stylesheet'>
    <title>Collection</title>
  </head>

  <body>
	<div id = 'navbar'>
		<div class = 'riga'><a id = 'active' href = 'home.php'>Home</a></div>
		<div class = 'riga'><a href = 'search.php'>Cerca</a></div>
		<div class = 'riga' id = 'logout'><a href = 'logout.php'>Logout</a></div>
	</div>
	<form name = 'form' method = 'post'>
		<input id = 'ricerca' type = 'text' name = 'ricerca' placeholder = "Digita il nome di un artista, un gruppo o una canzone">
		<input id = 'bottone' value = 'Ricerca' type = 'submit'>
	</form>
	
	<div id = 'contenitore'> 
		<?php
		$var = $_GET['idraccolta']; 
		error_log($var);
		echo "<span class = 'hidden' id = 'idraccolta'>";
		echo "$var";
		echo "</span>";
		?> 
	</div>

	<div class = 'central-page'>
		<button class = 'buttonback'> Torna alle tue playlist</button>
	</div>
	
	<div id = "modalview" class = "hidden"></div>
  </body>
</html>


