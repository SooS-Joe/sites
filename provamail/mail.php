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
        $destinatario = $_POST["EmailDestinatario"];
        $oggetto = $_POST["Oggetto"];
        $messaggio = "<p>Egregi* ".$_POST["NomeDestinatario"]."</p>
        <p>".$_POST["Messaggio"]."</p><br>
        <img src=\"giosuedavidetieri.altervista.org/provamail/img/q".$_POST['Immagine'].".jpg\">
        <p>Saluti, ".$_POST["NomeMittente"].".</p>";
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
        $headers .= 'From: '.$_POST['NomeMittente'].'<'.$_POST['EmailMittente'].'>' . "\r\n"; 
        if(mail($destinatario, $oggetto, $messaggio, $headers))
            echo "<h1>Email inviata con successo!</h1>
            <p>Questa è la mail inviata:</p><hr>
            <p>"."Da: ".$_POST['NomeMittente']." ".$_POST["EmailMittente"]."</p>
            <p>"."A: ".$_POST['NomeDestinatario']." ".$_POST["EmailDestinatario"]."</p><br>
            <p>".$_POST["Oggetto"]."</p>
            <p>".$messaggio."</p>";
        else
            echo "<h1>C'è stato un problemone nell'invio della mail, Un casotto... Per dindirindina riprova più tardi !!</h1>";
    ?>
    
</body>
</html>