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
    <form name="modifica" method="POST" action="visualizza.php">
        <table>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modello</th>
                <th>Prezzo</th>
            </tr>
            
			<input type="text" name="model" placeholder="" required>
			<input type="text" name="price" placeholder="" required>
            <?php
                include "connetti.php";
                $connect = connessione("localhost", "giosuedavidetieri", "", "my_giosuedavidetieri");
                $select = "SELECT * FROM Telefoni";
                $result = $connect->query($select);
                $num = 0;

                if (!$result)
                {
                    echo "Errore nella ricerca della Tabella: <b> Telefoni </b>";
                    exit();
                }

                while($raw=$result->fetch_assoc())
                {
                    echo "<tr>";
					if(isset($_POST["M".$raw["IDTelefono"]]))
					{
						echo "<td>".$raw["IDTelefono"]."</td>";
						echo "<td><input type='text' name='brand' value='".$raw['Marca']."' required></td>";
						echo "<td><input type='text' name='model' value='".$raw['Modello']."' required></td>";
						echo "<td><input type='text' name=price value='".$raw['Prezzo']."' required></td>";
						echo "<td>".$raw["Prezzo"]."</td>";
						echo "<td><input type='submit' value='Conferma' name='CM".$raw["IDTelefono"]."'></td>";
					}
					else
					{
						echo "<td>".$raw["IDTelefono"]."</td>";
						echo "<td>".$raw["Marca"]."</td>";
						echo "<td>".$raw["Modello"]."</td>";
						echo "<td>".$raw["Prezzo"]."</td>";
						echo "<td><input type='submit' value='Modifica' name='M".$raw["IDTelefono"]."'></td>";
						if (isset($_POST[$raw["IDTelefono"]])) 
						{
							echo "<td><input type='submit' value='Sicuro?' name='C".$raw["IDTelefono"]."'></td>";
						}
						else if(isset($_POST["C".$raw["IDTelefono"]]))
						{
							$connect->query("DELETE FROM Telefoni WHERE IDTelefono=$raw[IDTelefono]");
							header("Refresh:0");
						}
						else
						{
							echo "<td><input type='submit' value='Elimina' name='".$raw["IDTelefono"]."'></td>";
						}	
					}
                    echo "</tr>";
                    $num++;
                }

                $result->free();
                $connect->close();
            ?>
        </table>
    </form>
</body>
</html>