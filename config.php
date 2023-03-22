<?php
try 
{
    $bdd = new PDO('mysql:host=localhost;dbname=client;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    //phpinfo();
    die('Erreur : '.$e->getMessage());
}
?>