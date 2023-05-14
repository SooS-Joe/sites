<?php


$servername = "localhost";
$username = "root";
$password = "";
$nomeDB="ScelteGiovani";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) 
{
    die("Connection failed: ". $conn->connect_error);
}



$sql = "CREATE DATABASE $nomeDB";
if ($conn->query($sql) === TRUE)
{
    echo "Database creato corretamente";
}
else
{
    echo "Errore nella creazione del database".$conn->error;
}


$conn->close();

$conn = new mysqli($servername, $username, $password, $nomeDB);
if ($conn->connect_error)
    {
        die("Connessione fallita: ". $conn->connect_error);
    }

$createRegioni = "CREATE table Regioni
    (
        codice int primary key auto_increment,
        nome varchar(25) not null
    )";

if ($conn->query($createRegioni) === TRUE)
{
    echo "Tabella Regioni creata con successo";
}
else 
{
    echo "Errore nella creazione della tabella Regioni".$conn->error;
}

$createIndirizzi = "CREATE table Indirizzi
    (
        codice int primary key auto_increment,
        descrizione varchar(25) not null
    )";

if ($conn->query($createIndirizzi) === TRUE)
{
    echo "Tabella Indirizzi creata con successo";
}
else 
{
    echo "Errore nella creazione della tabella Indirizzi".$conn->error;
}

$createPercorsi = "CREATE table Percorsi
    (
        codice int primary key auto_increment,
        descrizione varchar(25) not null
    )";

if ($conn->query($createPercorsi) === TRUE)
{
    echo "Tabella Percorsi creata con successo";
}
else 
{
    echo "Errore nella creazione della tabella Percorsi".$conn->error;
}

$createStudenti = "CREATE table Studenti
(
    codice int primary key auto_increment,
    nome varchar(25) not null,
    cognome varchar(25) not null,
    Indirizzo int not null,
    Regione int not null,
    Percorso int not null,
    foreign key(Indirizzo) references Indirizzi(Codice),
    foreign key(Regione) references Regioni(Codice),
    foreign key(Percorso) references Percorsi(Codice)
)";

if ($conn->query($createStudenti) === TRUE)
{
    echo "Tabella Dichiarazione_Percorso creata con successo";
}
else 
{
    echo "Errore nella creazione della tabella Dichiarazione_Percorso".$conn->error;
}
$conn->close();

?>