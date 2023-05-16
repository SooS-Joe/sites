<?php
$altervista = false;
function connessione($hostname, $username, $password, $database)
{
    $connect = new mysqli($hostname, $username, $password, $database);
    if ($connect->connect_errno) {
        echo "Errore di connessione: ".$connect->connect_error."\n";
        exit();
    }
    return ($connect);
}
$connect = null;
if($altervista)
    $connect = connessione("localhost", "giosuedavidetieri", "", "my_giosuedavidetieri");
else
    $connect = connessione("localhost", "root", "", "Guestbook");

?>