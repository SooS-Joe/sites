<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Output</title>
</head>
<body>
    <p style="color: red">
        <?php
        for ($i = 0; $i < $_POST['value1']; $i++)
        echo "*";
        ?>
    </p>
    <p style="color: green">
        <?php
            for ($i = 0; $i < $_POST['value2']; $i++)
                echo "@";
        ?>
    </p>
</body>
</html>