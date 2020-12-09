<?php
include('load.php');

//Si il est bien passé par la page d'enregistrement
if (!isset($_POST["identification"]) || !isset($_POST["username"]) || !isset($_POST["confirmation"])) {
    header('Location: register.php?error=3');
    return;
}

//Si les mots de passe ne sont pas égaux
if (empty($_POST["username"]) || empty($_POST["identification"]) || empty($_POST["confirmation"])) {
    header('Location: register.php?error=7');
    return;
}

//Utilisateur ou mot de passe trop long
if (strlen($_POST["username"]) > 50 || strlen($_POST["identification"]) > 50) {
    header('Location: register.php?error=12');
    return;
}

//Utilisateur ou mot de passe trop court
if (strlen($_POST["username"]) < 5 || strlen($_POST["identification"]) < 5) {
    header('Location: register.php?error=13');
    return;
}

try {
    //Pour éviter les injections JS
    $_POST["username"] = trim($_POST["username"]);
    $_POST["username"] = str_replace("<", "&lt;", $_POST["username"]);
    $_POST["username"] = str_replace(">", "&gt;", $_POST["username"]);

    //Création de l'utilisateur
    $user = new User();

    $user->setUsername($_POST["username"]);
    $user->setIdentification(crypt($_POST["identification"], '5fb3f6276a585iap91Ijs291'));

    //Connexion BDD
    $base = new BDD($config->getBDD("db"), $config->getBDD("username"), $config->getBDD("password"), $config->getBDD("host"));

    $manager = new ManagerUser($base->connect());
    $result = $manager->register($user->getUsername(), $user->getIdentification());

    //Enregistrement du nom tapé en session
    session_start();
    $_SESSION["username"] = $_POST["username"];
} catch (Exception $e) {
    header('Location: register.php?error=17');
    return;
}
