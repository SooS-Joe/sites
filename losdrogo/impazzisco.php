<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Non so matto</title>
</head>
<body>
    <?php
        for ( $i = 0; $i < $_POST["cazzi"]; $i++) {
            echo "<p color:green>*</p>";
        }
        for ( $i = 0; $i < $_POST["falli"]; $i++) {
            echo "<p color: red>@</p>";
        }
    ?>    
</body>
</html>