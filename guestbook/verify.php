<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica mail</title>
</head>
<body>
    <p class="result">
        <?php
        require "connection.php";
        if (isset($_GET['code'])) {
            $sql = "SELECT IDUser FROM guestbook_activationcodes WHERE Codice='$_GET[code]'";
            $result = $connect->query($sql);
            if($result->num_rows == 1)
            {
                if($row = $result->fetch_assoc())
                {
                    $sql = "UPDATE guestbook_users SET Attivo = 1  WHERE ID = $row[IDUser]";
                    $connect->query($sql);
                    $sqL = "DELETE FROM guestbook_acrivationcodes WHERE ID = $row[ID]";
                    $connect->query($sql);
                }
            }
            else
            {
                echo "codice di verifica non valido";
            }
        }
        header( "Refresh:5; url: index.php");
        $connect->close();
        ?>
    </p>
</body>
</html>