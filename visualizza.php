<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <!-- <script src="bmi.js"></script> -->
    <title>Elenco</title>
</head>
<body>
    <h1><a class="title" href="/Telefoni/">Deposito telefoni</a></h1>
    <h2>Elenco</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modello</th>
            <th>Prezzo</th>
        </tr>
        <?php
            include "connetti.php";
            $connect = connessione("localhost", "giosuedavidetieri", "", "my_giosuedavidetieri");
            $select = "SELECT * FROM Telefoni";
            $result = $connect->query($select);

            if (!$result)
            {
                echo "Errore nella ricerca della Tabella: <b> Telefoni </b>";
                exit();
            }

            while($raw=$result->fetch_assoc())
            {
                echo "<tr>";
                echo "<td>".$raw["id"]."</td>";
                echo "<td>".$raw["marca"]."</td>";
                echo "<td>".$raw["modello"]."</td>";
                echo "<td>".$raw["prezzo"]."</td>";
                echo "</tr>";
            }
            $result->free();
            $connect->close();
            header("Refresh:4; url='index.html'");
        ?>
    </table>
</body>
</html>