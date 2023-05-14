<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/052423e961.js" crossorigin="anonymous"></script>
    <title>Invio Mail</title>
</head>
<body>
    <?php
        $mittente = $_POST["EmailMittente"];
        $destinatario = $_POST["EmailDestinatario"];
        $oggetto = $_POST["oggetto"];
        $messaggio = $_POST["messaggio"];
        mail($destinatario, $oggetto, $messaggio, "From: $mittente");
    ?>
    <h1>Email inviata con successo</h1>
</body>
</html>