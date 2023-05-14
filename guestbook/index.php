<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsBetter</title>
    <script src="https://kit.fontawesome.com/052423e961.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require "connection.php"?>
    <div class="navbar">
        <h1><i class="fa-solid fa-envelope"></i> NewsBetter</h1>
        <a href="login.php" class="login-btn"><span>LogIn</span></a>
        <a href="signup.php" class="signup-btn">SignUp</a>
    </div>
    <div class="articoli">
        <div class="cards">
            <?php
            $sql = "SELECT guestbook_newsletters.Titolo AS Titolo, guestbook_newsletters.MessaggioNews AS Testo, guestbook_administrators.Nome AS Nome, guestbook_administrators.Cognome AS Cognome 
            FROM guestbook_newsletters INNER JOIN guestbook_administrators ON guestbook_newsletters.UserAdmin = guestbook_administrators.UserAdmin;";
            if($result = $connect->query($sql))
            {
                while($row = $result->fetch_assoc())
                {
                    echo "        
                    <div class = 'card'>
                        <h2>$row[Titolo]</h2>
                        <p>$row[Testo]</p>
                        <p>Scritto da: $row[Nome] $row[Cognome]</p>
                    </div>";
                }
            }
            ?>
        </div>
    </div>
    <footer>
        <p>Creato da Giosuè Davide Tieri, 5Ai</p>
    </footer>
</body>
</html>