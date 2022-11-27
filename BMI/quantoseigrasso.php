<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script defer src="bmi.js"></script>
    <title>Risultato BMI</title>
</head>
<body>
    <h1>Risultato</h1>
    <div id="resutlContainer">
        <div id="bmi" hidden>
            <?php
                $status = "";
                $image = "";
                $bmi = $_POST['mass']/pow($_POST['height'], 2);
                echo ($bmi); 
            ?>
        </div>
        <p>Buongiorno 
            <?php
                if($_POST['sex'] == "M")  
                {
                    echo "sig.";
                    $image = "bmiscalemale.png";
                }
                else if($_POST['sex'] == "F") 
                {
                    echo "sig.ra";
                    $image = "bmiscalefemale.png";
                }
                $bmi = round($bmi, 2);
                echo " $_POST[name] $_POST[surname] il tuo BMI è: $bmi";
            ?> 
        </p>
        <img src="<?php echo $image?>" width="450px" height="250px" alt="bmi image">
        <div width="450px" height="5px" id="slider">
            <svg height="100px" width="100px" id="pointer">
                <path d="M74.905,75.035c0-11.811-18.276-40.142-23.516-48.022c-0.661-0.994-2.119-0.996-2.782-0.003  c-5.263,7.876-23.633,36.212-23.633,48.025C24.974,88.823,36.151,100,49.939,100S74.905,88.823,74.905,75.035z" />
            </svg>
        </div>
    </div>
</body>
</html>