<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include "connetti.php";
        $connect = connessione("localhost", "root", "", "articoli");
        $selezione = "SELECT * FROM telefoni";
        $risultato = $connect->query($selezione);

        if (!$risultato)
        {
            echo "Errore nella ricerca della Tabella: <b> Telefoni </b>";
            exit();
        }
        while($riga=$risultato->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>".$riga["id"]."</td>";
            echo "<td>".$riga["marca"]."</td>";
            echo "<td>".$riga["modello"]."</td>";
            echo "<td>".$riga["prezzo"]."</td>";
            echo "</tr>";
        }
        $risultato->free();
        $connect->close();
        header("Refresh:4; url='index.html'");

    ?>

</body>
</html>