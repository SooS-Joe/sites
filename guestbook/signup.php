<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/052423e961.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
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
            <input required="" type="password" name="pword" autocomplete="off" class="input">
            <label class="user-label">Password</label>
        </div>
        <div class="cool-input">
            <input required="" type="password" name="cpword" autocomplete="off" class="input">
            <label class="user-label">Conferma Password</label>
        </div>
        <div class="container">
            <input type="checkbox" id="cbx" style="display: none;">
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
    <div class="result">
        <p>
            <?php
            if(isset($_POST['sent']))
            {

            }
            ?>
        </p>
    </div>
</body>
</html>