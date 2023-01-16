<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <!-- <script src="bmi.js"></script> -->
    <title>Inserimento</title>
</head>
<body>
    <h1><a class="title" href="Index.html">Deposito telefoni</a></h1>
    <h2>Registrazione</h2>
    <form name="nuovotel" method="POST" action="inserisci.php">
        <!-- TODO: rifare tutto con le div -->
        <table>
            <tr>
                <td>
                    <div class="field">
                        Marca <br>
                        <input type="text" name="brand" required>
                    </div>
                </td>
			</tr>
            <tr>
                <td>
                    <div class="field">
                        Modello <br>
                        <input type="text" name="model" required>
                    </div>
                </td>
            </tr>
			<tr>
                <td>    
                    <div class="field">
                        Prezzo<br>
                        <input type="number" name="price" required min="0" step="0.01">       
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Invia">
                    <input type="reset" value="Pulisci">
                </td>
            </tr>               
		</table>
        <?php
            require "connetti.php";
            $connect = connessione("giosuedavidetieri.altervista.org", "root", "", "my_giosuedavidetieri");
            $commend = "INSERT INTO Telefoni(Marca, Modello, Prezzo) VALUES ('$_POST[brand]', '$_POST[model]', '$_POST[price]')";
            $risultato = $connect->query($command);

            
        ?>
        <!--border 1px align center-->
 	</form>
</body>
</html>