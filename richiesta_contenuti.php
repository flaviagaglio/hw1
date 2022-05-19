<?php
session_start();

$id_raccolta = $_GET['id_raccolta'];
$connessione = mysqli_connect('localhost', 'root', '', 'HomeWork') or die('Errore: '.mysqli_connect_error());
mysqli_query($connessione, 'set character set utf8');


$query = "select c.img_url, c.titolo, c.id_risorsa_spotify, c.nome_album, c.artisti from contenuto c join associazione a on c.id_contenuto = a.id_contenuto where a.id_raccolta = '".$id_raccolta."'";
$res = mysqli_query($connessione, $query);
$risultati = array();

while($row = mysqli_fetch_assoc($res)) {
	$risultati[] = $row;
}

echo json_encode($risultati);
mysqli_free_result($res);
mysqli_close($connessione); 
?>