<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: login.php');
	exit;
}

if (isset($_POST['id_risorsa']) && isset($_POST['id_raccolta'])) {
	$connessione = mysqli_connect('localhost', 'root', '', 'HomeWork') or die('Errore: '.mysqli_connect_error());
    mysqli_query($connessione, 'set character set utf8');
    $idrisorsa = $_POST['id_risorsa'];
    $idraccolta = $_POST['id_raccolta'];
	
	$query = "delete from associazione where id_raccolta = '".$idraccolta."' and id_contenuto = (select id_contenuto from contenuto where id_risorsa_spotify = '".$idrisorsa."');";
	
	$query2 = "delete from contenuto where id_contenuto not in (select a.id_contenuto from associazione a join raccolta r on a.id_raccolta = r.id_raccolta)";
	
	mysqli_query($connessione, $query);
	mysqli_query($connessione, $query2);
    mysqli_close($connessione);
}
?>