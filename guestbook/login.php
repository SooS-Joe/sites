<?php 
    require "connection.php";
    
    //Creazione funzioni ausiliarie
    function checkUser($connect, $email, $pwd)
    {
        $sql = "SELECT Pword FROM guestbook_users WHERE guestbook_users.Email = '$email'";
        $result = $connect->query($sql);
        if($row = $result->fetch_assoc())
        {
            if (password_verify($_POST['pword'], $row['Pword'])) {
                $sql = "SELECT * FROM guestbook_users WHERE guestbook_users.Email = '$email'";
                session_start();
                $_SESSION['name'] = $row['Nome'];
                $_SESSION['surname'] = $row['Cognome'];
                $_SESSION['email'] = $row['Email'];
                $_SESSION['active'] = $row['Attivo'];
                return true;
            }
            return false;
        }
        return false;
    }
?>
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
    <div class="navbar">
        <a href="/guestbook/" class="title"><h1><i class="fa-sharp fa-solid fa-envelope"></i> NewsBetter</h1></a>
        <div class="buttons">
            <a class="nav-btn" href="signup.php">Registati</a>
        </div>
    </div>
    <form action="login.php" method="post">
        <h1>Log In</h1>
        <div class="cool-input">
            <input required="" type="email" name="email" autocomplete="off" class="input">
            <label class="user-label">Email</label>
        </div>
        <div class="cool-input">
            <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" -->
            <input required="" type="password" name="pword"  autocomplete="off" class="input">
            <label class="user-label">Password</label>
        </div>
        <div class="buttons">
            <button class="nav-btn" type="submit" name="sent">Accedi</button>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(checkUser($connect, $_POST['email'], $_POST['pword']))
                header("Location: index.php");
            else
                echo "<p class='result' style='color: red;'>Email o password non corrette.</p>";
        }
        ?>
    </form>
</body>
</html>