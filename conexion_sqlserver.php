<?php
function conectar()
{
    $dbuser = "DESKTOP-21BHMR9\yimij";
    $userpass = "";

    $dsn = "sqlsrv:Server=DESKTOP-21BHMR9;Database=notas_php"; $dbuser; $userpass;

    try
    {
       $conn = new PDO($dsn);
       if ($conn)
       {
            //echo "Conectado a la DB correctamente";
            return $conn;
       }
    } 
    catch (PDOException $e)
    {
        //echo $e->getMessage();
    }
}
?>