<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato BMI</title>
</head>
<body>
    <p>Buongiorno 
        <?php 
            if($_POST['sex'] == "M") echo "sig.";
            else if($_POST['sex'] == "F") echo "sig.ra";
            echo " $_POST[name] $_POST[surname] il tuo ";
        ?> 
    </p>
</body>
</html>