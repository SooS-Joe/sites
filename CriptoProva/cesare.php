<html>
    <head>
        <title>Cifrario di Cesare</title>
        <style>
            body {
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                background-color: rgb(30, 30, 30);
            }

            h1{
                text-align: center;
                color:rgb(255, 255, 255);
                font-size: 72px;
                margin-bottom: 0;
            }

            h2{
                text-align: center;
                color:rgb(62, 62, 62);
                margin-top: 0;
                font-size: 40px;
            }

            ul
            {
                padding: 10px;
                list-style-type: none;
                width: max-content;
                background-color: rgb(62, 62, 62);
                margin-left: auto;
                margin-right: auto;
                margin-top: auto;
                margin-bottom: auto;
                border-radius: 25px;
                font-size: 24px;
                border-collapse: collapse;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }

            ul li
            {
                display: inline-block;
                padding-left: 15px;
                padding-right: 15px;
            }

            .title
            {
                text-decoration: none;
                color: rgb(62, 62, 62);
            }

            .title:visited
            {
                color: rgb(62, 62, 62);
            }

            a
            {
                text-decoration: none;
                color: rgb(160, 160, 160);
            }

            a:visited
            {
                color: rgb(144, 0, 0)
            }

            table {
                background-color: rgb(62, 62, 62);
                margin-left: auto;
                margin-right: auto;
                margin-top: auto;
                margin-bottom: auto;
                border-radius: 25px;
                font-size: 24px;
                border-collapse: collapse;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }

            td, th {
                align-content: center;
                width: max-content;
                border-collapse: collapse;
                border-radius: 10px;
                padding: 8px;
                margin-left: auto;
                margin-right: auto;
            }

            .field{
                display: inline-block;
                padding-left: 15px;
                padding-right: 15px;
            }

            input[type = "text"]
            {
                font-size: 22px;
                color:rgb(160, 160, 160);
                width: fit-content;
                height: 40px;
                border-radius: 15px;
                border: none;
                background-color: rgb(30, 30, 30);
            }

            input[type = "number"], input[type = "submit"], input[type = "reset"]
            {
                font-size: 20px;
                color:rgb(160, 160, 160);
                width: 100px;
                height: 40px;
                border-radius: 15px;
                border: none;
                background-color: rgb(30, 30, 30);
            }

            input:disabled
            {
                color:rgb(89, 89, 89);
            }

            .result
            {
                padding: 10px;
                width: max-content;
                background-color: rgb(62, 62, 62);
                margin-left: auto;
                margin-right: auto;
                margin-top: auto;
                margin-bottom: auto;
                border-radius: 25px;
                font-size: 24px;
                border-collapse: collapse;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
        </style>
    </head>
    <?php
        function caesarChipher($message, $key) {
            $key = (int)$key;
            $key = ($key >= 0 ? $key%26 : 26-abs($key%26));
            $alfabeto = range('a', 'z');
            $output = "";
            for ($i = 0; $i < strlen($message); $i++) {
                $char = $message[$i];
                if (!in_array($char, $alfabeto)) {
                    if (in_array(strtolower($char), $alfabeto)) {
                        $output .= strtoupper($alfabeto[(array_search(strtolower($char), $alfabeto) + $key)%26]);
                    } else {
                        $output .= $char;
                    }
                } else {
                    $output .= $alfabeto[(array_search($char, $alfabeto) + $key)%26];
                }
            }
            return $output;
        }
    ?>
    <body>
        <h1>Cifrario di Cesare</h1>
        <table>
            <form method = "POST" action = "cesare.php">
                <tr>
                    <td>Frase da criptare:</td>
                    <td><input name = "Text" type = "text"></td>
                </tr>
                <tr>

                    <td>Chiave:</td>
                    <td><input name = "Key" type = "number"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Invia">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if(!empty($_POST))
                        echo "Frase criptata: " . caesarChipher($_POST['Text'], $_POST['Key']);
                        ?>

                    </td>
                </tr>
            </form>
        </table>
            
    </body>
</html>