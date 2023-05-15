<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/052423e961.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>

    <title>Sign Up</title>
</head>
<body>
    <?php require "connection.php"?>
    <div class="navbar">
        <a href="/guestbook/" class="title"><h1><i class="fa-solid fa-envelope"></i> NewsBetter</h1></a>
        <div class="buttons">
            <a class="nav-btn" href="login.php">LogIn</a>
        </div>
    </div>
    <form action="signup.php" method="post">
        <h1>Sign Up</h1>
        <div class="input-group">
            <div class="cool-input">
                <input required="" type="text" name="name" autocomplete="off" class="input">
                <label class="user-label">Nome</label>
            </div>
            <div class="cool-input">
                <input required="" type="text" name="surname" autocomplete="off" class="input">
                <label class="user-label">Cognome</label>
            </div>
        </div>
        <div class="cool-input">
            <input required="" type="email" name="email" autocomplete="off" class="input">
            <label class="user-label">Email</label>
        </div>
        <div class="cool-input">
            <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" -->
            <input required="" type="password" name="pword"  autocomplete="off" class="input">
            <label class="user-label">Password</label>
        </div>
        <div class="cool-input">
            <input required="" type="password" name="cpword" autocomplete="off" class="input">
            <label class="user-label">Conferma Password</label>
        </div>
        <div class="container">
            <input type="checkbox" name="news" id="cbx" style="display: none;">
            <label for="cbx" class="check">
                <svg width="18px" height="18px" viewBox="0 0 18 18">
                    <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                    <polyline points="1 9 7 14 15 4"></polyline>
                </svg>
            </label>
            Voglio ricevere aggiornamenti sui nuovi post
        </div>
        <div class="buttons">
            <button class="nav-btn" type="submit" name="sent">Registrati</button>
        </div>
    </form>
    
    <?php
    echo `<div class="result">`;
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        echo $_POST['news'];
        $news = ($_POST['news'] == 'on' ? 'true' : 'false');
        $sql = "SELECT * FROM guestbook_users WHERE guestbook_users.Email = '$_POST[email]'";
        $result = $connect->query($sql);
        if ($result && $result->fetch_assoc())
        {
            echo "<p style='color: goldenrod;'>Indirizzo email già in uso. Sei già registrato? <a href='login.php'>Accedi qui</a></p>";
        }
        else if($_POST['pword'] == $_POST['cpword'])
        {
            echo "<p style='color: red;'>Le password non coincidono.</p>";
        }
        else
        {
            $pwd = password_hash($_POST['pword'], PASSWORD_BCRYPT);
            $sql = "INSERT INTO guestbook_users(Nome, Cognome, Email, Pword, NewsOK, Attivo)
                    VALUES ('$_POST[name]', '$_POST[surname]', '$_POST[email]', '$pwd', $news, false);";
            if ($result = $connect->query($sql))
            {
                header("Location: /guestbook/index.php");
                echo "<p style='color: green;'>Registrazione avvenuta con successo.</p>";

            }
            else
                echo "<p style='color: red;'>Problema durante la registrazione: $connect->error . È pregato di riprovare.</p>";
        }
    }
    echo `</div>`;
    ?>
</body>
</html>