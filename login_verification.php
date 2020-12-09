<?php
include('load.php');

//Si il est bien passé par la page d'enregistrement
if (!isset($_POST["identification"]) || !isset($_POST["username"])) {
    header('Location: login.php?error=3');
    return;
}

if (empty($_POST["username"]) || empty($_POST["identification"])) {
    header('Location: login.php?error=7');
    return;
}

try {
    //Pour éviter les injections JS
    $_POST["username"] = str_replace("<", "&lt;", $_POST["username"]);
    $_POST["username"] = str_replace(">", "&gt;", $_POST["username"]);

    //Création de l'utilisateur
    $user = new User();

    $user->setUsername($_POST["username"]);
    $user->setIdentification(crypt($_POST["identification"], '5fb3f6276a585iap91Ijs291'));

    //Connexion BDD
    $base = new BDD($config->getBDD("db"), $config->getBDD("username"), $config->getBDD("password"), $config->getBDD("host"));

    $manager = new ManagerUser($base->connect());
    $result = $manager->login($user->getUsername(), $user->getIdentification());

    //Enregistrement du nom tapé en session
    session_start();
    $_SESSION["username"] = $_POST["username"];

    //Si pas d'utilisateur
    if (sizeof($result) == 0) {
        header('Location: login.php?error=1');
    } 
    //Si il y en a un
    else {
        $_SESSION['id'] = $result[0]->getId();
        header('Location: index.php');
    }
} catch (Exception $e) {
    header('Location: login.php?error=17');
    return;
}
