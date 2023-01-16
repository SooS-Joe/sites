<?php

    function connessione($hostname, $username, $password, $database)
    {
        $connect = new mysqli($hostname, $username, $password, $database);
        if ($connect->connect_errno) {
            echo "Errore di connessione: ".$connect->connect_error."\n";
            exit();
        }
        return ($connect);
    }
?>