<?php

if (isset($_POST['submit'])) 
{
    $bdd = new PDO('mysql:host=localhost;dbname=client;charset=utf8', 'root', '');
    if (!empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['username']) and !empty($_POST['name'])) 
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        $name = $_POST['name'];
        $password2 = $_POST['password2'];

        $check = $bdd->prepare('SELECT nameClient, emailClient, pseudoClient, passwordClient  FROM clients WHERE emailClient = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if ($row == 0) {
            if (strlen($username) <= 100) {
                if (strlen($email) <= 100) {
                    if ($password == $password2) {
                        $password = hash('sha256', $password);
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $insert = $bdd->prepare('INSERT INTO clients(nameClient, emailClient, pseudoClient, passwordClient) VALUES(:nameClient, :emailClient, :pseudoClient, :passwordClient)');
                        $insert->execute(array(
                            'nameClient' => $name,
                            'emailClient' => $email,
                            'pseudoClient' => $username,
                            'passwordClient' => $password
                        ));
                        echo('Votre compte a bien été créé !');

                    } else echo "Mots de passes non identique !";
                } else header('Location: register.php?error=1');
            } else header('Location: register.php?error=1');
        } else header('Location: register.php?error=1');
    }
}