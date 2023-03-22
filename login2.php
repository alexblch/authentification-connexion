<?php
    
    if(isset($_POST['submit']))
    {
        require_once('config.php');
        $email = $_POST['email'];
        $password = $_POST['password'];
        $check = $bdd->prepare('SELECT nameClient, emailClient, pseudoClient, passwordClient  FROM clients WHERE emailClient = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 1)
        {
            $password = hash('sha256', $password);
            if($data['passwordClient'] == $password && $data['emailClient'] == $email)
            {
                session_start();
                $_SESSION['id'] = $data['id'];
                $_SESSION['pseudo'] = $data['pseudo'];
                $_SESSION['email'] = $data['email'];
                header('Location: index.php');
            }
        }else header('Location: login2.php?error=123');
    }else header('Location: login2.php?error=1234');
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Connexion</title>
    </head>
    <body>
        <h1>ERROR</h1>
        <p>Vous avez une erreur de mdp ou de mail</p>
    </body>
</html>