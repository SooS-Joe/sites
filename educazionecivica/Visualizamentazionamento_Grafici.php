
<?php
$servername = "localhost";
$username = "root";
$password = "";
$nomeDB="ScelteGiovani";
$conn = new mysqli($servername, $username, $password, $nomeDB);
if ($conn->connect_error)
    {
        die("Connessione fallita: ". $conn->connect_error);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Statistiche Percorsi Post-Scuola</h1>
    <form action = "Visualizamentazionamento_Grafici.php" method = "POST">
        <select name = 'Indirizzo' id = 'Indirizzo1' required>
            <option value = 0 disabled selected>Scegli l'indirizzo da esaminare.</option>
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
            <option value = 0 disabled selected>Scegli la regione da esaminare.</option>
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
        <br>
        <button type='submit' name='invia'>Esamina</button> 
    </form>
    <div class="data">
        <div class="grafico">
            <canvas id="grafico"></canvas>
        </div>
        <div class="tabella">
            <table>
                <tr>
                    <th>
                        <p>Nome Indirizzo</p>
                    </th>
                    <th>
                        <p>Percentuale Studenti</p>
                    </th>
                </tr>
                <?php
                    $totale = 0;
                    if(isset($_POST['invia']))
                    {
                        $visualizamentazionamento = "SELECT Percorsi.descrizione AS Percorso, count(Studenti.codice)AS numStudenti
                        FROM Studenti inner join Percorsi on Studenti.Percorso = Percorsi.codice inner join Indirizzi on Studenti.Indirizzo = Indirizzi.codice inner join Regioni on Studenti.Regione = Regioni.codice 
                        WHERE Indirizzi.codice = '$_POST[Indirizzo]' AND Regioni.codice = '$_POST[Regione]'
                        GROUP BY Percorsi.descrizione;";

                        $result = $conn->query($visualizamentazionamento);
                        $data = array();
                        while ($row = $result->fetch_assoc()){
                            $data[] = $row;
                            $totale+= $row['numStudenti'];
                        }
                        $percentuali = array();
                        for($i=0; $i<sizeof($data); $i++)
                        {
                            $percentuali[]= ($data[$i]['numStudenti']/$totale)*100;
                            echo" <tr>
                            <td><p>".$data[$i]["Percorso"]."</p></td>
                            <td><p>".$percentuali[$i]."%</p></td>
                            </tr>";
                        }
                    }
                ?>
                <tr>
                    <td colspan="2">
                        <p> <?php echo "Il totale degli studenti esaminati è $totale";?> </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <script>
        const grafico = document.getElementById('grafico');
        const data = {
            labels: [
                <?php 
                for($i=0; $i<sizeof($data); $i++)
                    echo "'".$data[$i]['Percorso']." "."(".$percentuali[$i]."%)'".($i==sizeof($data)-1?"":", ");
                ?>
            ],
            datasets: [{
                label: 'Studenti',
                data: [
                    <?php
                    for($i=0; $i<sizeof($data); $i++)
                        echo "".$data[$i]['numStudenti'].($i==sizeof($data)-1?"":", ");
                    ?>
                ],
                backgroundColor: [
                    '#C3EAFF',
                    '#FFC6D9',
                    '#FFF7AE',
                    '#B74F6F',
                    '#636B61',
                    '#9368B7',
                    '#21897E',
                    '#F7EF81',
                    '#ACEB98',
                    '#FFBF69',
                    '#E2E4F6',
                    '#22162B',
                    '#DFBE99',
                    '#7678ED',
                    '#503D42'
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 20
                            }
                        }
                    }
                }
            }
        };
        new Chart(grafico, config);

    </script>
</body>
</html>

