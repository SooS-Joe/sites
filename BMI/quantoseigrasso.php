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
            $status = "";
            $image = "";
            $bmi = $_POST['mass']/($_POST['height']*$_POST['height']); 
            if($_POST['sex'] == "M") 
                echo "sig.";
            else if($_POST['sex'] == "F") 
                echo "sig.ra";
            echo " $_POST[name] $_POST[surname] il tuo BMI è: $bmi";

            if($bmi < 16)
            {
                $status = "";
                if($_POST['sex'] == "M")
                    $image = "man1.png";
                if($_POST['sex'] == "F")
                    $image = "woman1.png";
            }
            
            else if($bmi >= 16 && $bmi < 18.5)
            {
                if($_POST['sex'] == "M")
                    $image = "man1.png";
                if($_POST['sex'] == "F")
                    $image = "woman1.png";
            }
            elseif ($bmi >= 18.5 && $bmi <= 25) 
            {
                if($_POST['sex'] == "M")
                    $image = "man1.png";
                if($_POST['sex'] == "F")
                    $image = "woman1.png";
            }
        ?> 
    </p>
    <img src=<?php echo "\"$image\"";?> alt="bmi image">
</body>
</html>