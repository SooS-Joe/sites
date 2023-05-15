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
    $connect = connessione("localhost", "akirajoelaemilagrosespana", " ", "my_akirajoelaemilagrosespana");
    $select = "SELECT * FROM Telefoni";
    $result = $connect->query($select);
    if(!$connect->query($command))
    {
        echo("prelevazione dei dati non riuscito:" . $connect->error);
        exit();
    }

    $trovato = false;

    while (!$trovato && $raw=$result->fetch_assoc())
    {
        if($raw['marca'] == $_POST['marca'] && $raw['modello'] == $_POST['modello'])
            $trovato = true;
    }

    if ($trovato) {
        $select = "DELETE * FROM Telefoni WHERE idtelefono = '$raw[idtelefono]'";
        $result = $connect->query($select);
        if(!$connect->query($command))
        {
            echo("eliminazione non riuscito:" . $connect->error);
            exit();
        }
    }
    else
    {
        echo("Telefono non trovato :C");
    }

    ?>
    <table cellpodding="8" cellspacing="3"></table>
    <style>
        th{
          color: #99CCFF;
          background: #CCCCFF;
          text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;  
        }

        td{

            align: left;
            color: #99CCFF;
        }

    </style>