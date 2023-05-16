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
    <?php 
        require "connection.php";
        
        //Creazione funzioni ausiliarie
        function userAlredyExist($connect, $email)
        {
            $sql = "SELECT * FROM guestbook_users WHERE guestbook_users.Email = '$email'";
            $result = $connect->query($sql);
            if($result->num_rows > 0)
                return true;
            else
                return false;
        }
        
        function createUser($connect, $name, $surname, $email, $pwd)
        {
            $news = (isset($_POST['news']) ? 'true' : 'false');
            $pwd = password_hash($pwd, PASSWORD_BCRYPT);
            $sql = "INSERT INTO guestbook_users(Nome, Cognome, Email, Pword, NewsOK, Attivo)
                    VALUES ('$name', '$surname', '$email', '$pwd', $news, false);";
            $result = $connect->query($sql);
            if ($result)
            {
                $sql = "SELECT ID FROM guestbook_users WHERE Email = '$email'";
                if ($result = $connect->query($sql))
                    return $result->fetch_assoc()['ID'];
            }
            else
                return false;
        }

        function createVerificationCode($connect, $id)
        {
            $activationCode = substr(md5(uniqid(rand(), true)), 16, 10);
            $sql = "INSERT INTO guestbook_activationcodes(Codice, IDUser)
                    VALUE('$activationCode', $id)";
            $connect->query($sql);
            return $activationCode;
        }
    ?>
    <div class="navbar">
        <a href="/guestbook/" class="title"><h1><i class="fa-sharp fa-solid fa-envelope"></i> NewsBetter</h1></a>
        <div class="buttons">
            <a class="nav-btn" href="login.php">Accedi</a>
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
        <?php
        if (!empty($_POST))
        {
            if(strcmp($_POST['pword'], $_POST['cpword']) != 0)
            {
                echo "<p class='result' style='color: red;'>Le password non coincidono.</p>";
            }
            else if(userAlredyExist($connect, $_POST["email"]) )
            {
                echo "<p class='result' style='color: goldenrod;'>Indirizzo email già in uso. Sei già registrato? <a href='login.php'>Accedi qui</a></p>";
            }
            else if ($id = createUser($connect, $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["pword"]))
            {
                $activationCode = createVerificationCode($connect, $id);
                $destinatario = $_POST["email"];
                $oggetto = "Verifica il tuo account NewsBetter!";
                $messaggio = "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <script src='https://kit.fontawesome.com/052423e961.js' crossorigin='anonymous'></script>
                    <title>Benvenuto</title>
                </head>
                <body>
                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;600;700;800;900&display=swap');
                        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap');

                        :root {
                            font-family: 'Roboto', sans-serif;
                            --maincolor: #3a0ca3;
                        }

                        body {
                            padding: 0;
                            margin: 0;
                            border: 0;
                            min-height: 100vh;
                        }
                        .titolo {
                            padding: 0;
                            border: 0;
                            margin: 0;    
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        }
                        
                        .titolo h1 {
                            margin: 0;
                            padding: 20px;
                            font-family: 'Roboto Slab', sans-serif;
                            font-weight: 900;
                            font-size: 3rem;
                        }

                        .titolo a {
                            text-decoration: none;
                            background: -webkit-linear-gradient(bottom right, var(--maincolor), #8d0bad);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                        }


                        div.mail-content {
                            font-weight: 500;
                            box-shadow: 0px 187px 75px rgba(0, 0, 0, 0.01), 0px 105px 63px rgba(0, 0, 0, 0.05), 0px 47px 47px rgba(0, 0, 0, 0.09), 0px 12px 26px rgba(0, 0, 0, 0.1), 0px 0px 0px rgba(0, 0, 0, 0.1);
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                            width: fit-content;
                            background-color: white;
                            border-radius: 20px;
                            margin-top: 50px;
                            padding: 50px;
                            position: relative;
                            margin-left: auto;
                            margin-right: auto;
                            transition: 400ms;
                        }

                        div.mail-content h1 {
                            color: var(--maincolor);
                        }

                        div.mail-content p {
                            text-align: center;
                            font-size: 1.5rem;
                        }
                    </style>
                    <div class='titolo'>
                        <h1>Benvenut* in <a href='https://giosuedavidetieri.altervista.org/guestbook'><i class='fa-solid fa-envelope'></i> NewsBetter</a>!</h1>
                    </div>
                    <div class='mail-content'>
                        <p>Ciao $_POST[name] $_POST[surname].</p>
                        <p>Ti diamo il benvenuto nella nostra newsletter!<br>
                        Conferma il tuo account al seguente <a href='https://giosuedavidetieri.altervista.org/guestbook/verify.php?code=$activationCode'>link</a>.<br></p>
                        <p>Saluti dallo staff di NewsBetter!</p>
                    </div>
                </body>
                </html>
                ";
                
                $headers = array(
                    'MIME-Version' => '1.0',
                    'Content-type' => 'text/html;charset=UTF-8',
                    'From' => 'NewsBetter<NewsBetter@ns558.altervista.org>'
                );
                
                if(mail($destinatario, $oggetto, $messaggio, $headers))
                {
                    echo "<p class='result' style='color: green;'>Registrazione avvenuta con successo.</p>";   
                    header("Location: /guestbook/index.php?activate=false");
                }
                else
                    echo "<p class='result' style='color: red'>C'è stato un problemone nell'invio della mail, Un casotto... Per dindirindina riprova più tardi !!</p>";
            }
            else
                echo "<p style='color: red;'>Problema durante la registrazione: $connect->error . È pregato di riprovare.</p>";
        }
        $connect->close()
        ?>
        <div class="buttons">
            <button class="nav-btn" type="submit" name="sent">Registrati</button>
        </div>
    </form>
</body>
</html>
