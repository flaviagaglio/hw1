<?php
session_start();

$connessione = mysqli_connect('localhost', 'root', '', 'HomeWork') or die('Errore: '.mysqli_connect_error());
mysqli_query($connessione, 'set character set utf8');
$user = $_SESSION['username'];

$query = "select titolo, id_raccolta from raccolta where nome_utente = '".$user."'"; 

$res = mysqli_query($connessione, $query);
$risultati = array();
while ($riga = mysqli_fetch_assoc($res)) {
    $risultati[] = $riga;
}

$ris = json_encode($risultati);
echo $ris;

mysqli_free_result($res);
mysqli_close($connessione);
?>