<?php
$servername = "localhost";
$username = "root";
$password = "";
$nomeDB="sceltegiovani";
$conn = new mysqli($servername, $username, $password, $nomeDB);
    if ($conn->connect_error)
        {
            die("Connessione fallita: ". $conn->connect_error);
        }
?>
<!DOCTYPE html>
<html lang="pr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inserimento Utente</title>
</head>
<body>
    <form action = "Inserimento_Utente.php" method= "POST">
        <input type= "text" name= "Nome" required>
        <input type= "text" name= "Cognome" required>
        <select name = 'Indirizzo' id = 'Indirizzo1' required>
            <option value = 1>Liceo Classico</option>
            <option value = 2>Liceo Artistico</option>
            <option value = 3>Liceo Scentifico</option>
            <option value = 4>Liceo Linguistico</option>
            <option value = 5>Liceo Musicale</option>
            <option value = 6>Meccanica, Meccatronica ed Energia</option>
            <option value = 7>Trasporti e Logistica</option>
            <option value = 8>Elettronica ed Elettrotecnica</option>
            <option value = 9>Informatica e Telecomunicazioni</option>
            <option value = 10>Grafica e Comunicazione</option>
            <option value = 11>Chimica, Materiali e Biotecnologie</option>
            <option value = 12>Moda</option>
            <option value = 13>Agrario, Agroalimentare e Agroindustria(Istituto Tecnico)</option>
            <option value = 14>Costruzioni, Ambiente e Territorio</option>
            <option value = 15>Enogastronomia e ospitalita alberghiera</option>
            <option value = 16>Agricoltura(Istituto Professionale)</option>
            <option value = 17>Pesca commerciale e produzioni ittiche</option>
            <option value = 18>Industria e artigianato per il Made in Italy</option>
            <option value = 19>Manutenzione e assistenza tecnica</option>
            <option value = 20>Gestione delle acque e risanamento ambientale</option>
            <option value = 21>Servizi commerciali</option>
            <option value = 22>Servizi culturali e dello spettacolo</option>
            <option value = 23>Servizi per la sanita e l'assistenza sociale</option>
            <option value = 24>Arti ausiliarie delle professioni sanitarie(ottico)</option>
            <option value = 25>Arti ausiliarie delle professioni sanitarie(odontotecnico)</option>
        </select>
        <select name = 'Regione' id= 'Regione1' required>
            <option value = 1>Lombardia</option>
            <option value = 2>Lazio</option>
            <option value = 3>Campania</option>
            <option value = 4>Veneto</option>
            <option value = 5>Sicilia</option>
            <option value = 6>Emilia-Romagna</option>
            <option value = 7>Piemonte</option>
            <option value = 8>Puglia</option>
            <option value = 9>Toscana</option>
            <option value = 10>Calabria</option>
            <option value = 11>Sardegna</option>
            <option value = 12>Liguria</option>
            <option value = 13>Marche</option>
            <option value = 14>Abruzzo</option>
            <option value = 15>Friuli-Venezia Giulia</option>
            <option value = 16>Trentino-Alto Adige</option>
            <option value = 17>Umbria</option>
            <option value = 18>Basilicata</option>
            <option value = 19>Molise</option>
            <option value = 20>Valle d'Aosta</option>
        </select>
        <select name = 'Percorso' id= 'Percorso1'>
            <option value = 1>ITS</option>
        </select>
        <button type = 'submit' name='invia'>Inserisci</button>    
    </form>
</body>
</html>
<?php
if(isset($_POST['invia']))
{
$inserimento = "INSERT into Studenti(nome, cognome, Indirizzo, Regione, Percorso)
        values('$_POST[Nome]', '$_POST[Cognome]', '$_POST[Indirizzo]', '$_POST[Regione]', '$_POST[Percorso]');
";

if ($conn->query($inserimento) === TRUE)
{
    echo "Dato inserito con successo";
}
else 
{
    echo "Errore nell'inserimento dei dati".$conn->error;
}
}
?>