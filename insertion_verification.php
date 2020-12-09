<?php
include('load.php');

$post = $_POST;
$image = rand(100000000,999999999);

//Erreurs
if (!isset($post['title']) || !isset($post['commentary']) || !isset($_FILES['image'])) {
    header('Location: insertion.php?error=7');
    return;
}

if ($_FILES['image']['error']) {
    switch ($_FILES['image']['error']) {
        case 1:
            header('Location: insertion.php?error=1');
            break;
        case 2:
            header('Location: insertion.php?error=1');
            break;
        case 3:
            header('Location: insertion.php?error=5');
            break;
        case 4:
            header('Location: insertion.php?error=5');
            break;
    }
    return;
}

//Titre ou commentaire trop long
if (strlen($post["title"]) > 50 || strlen($post["commentary"]) > 500) {
    header('Location: insertion.php?error=14');
    return;
}

//Titre ou commentaire trop court
if (strlen($post["title"]) < 5 || strlen($post["commentary"]) < 5) {
    header('Location: insertion.php?error=15');
    return;
}

$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
$detectedType = exif_imagetype($_FILES['image']['tmp_name']);
$error = !in_array($detectedType, $allowedTypes);

if ($error) {
    header('Location: insertion.php?error=6');
    return;
}

//Si il n'y a pas d'erreur
$path = $_FILES['image']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
$title = trim($post["title"]);
$commentary = trim($post["commentary"]);
$post["commentary"] = str_replace("<", "&lt;", $commentary);
$post["commentary"] = str_replace(">", "&gt;", $commentary);
$post["title"] = str_replace("<", "&lt;", $title);
$post["title"] = str_replace(">", "&gt;", $title);

//Ajout image
if ((isset($_FILES['image']['name']) && ($_FILES['image']['error'] == UPLOAD_ERR_OK))) {
    $chemin_destination = 'images/';
    move_uploaded_file($_FILES['image']['tmp_name'], $chemin_destination . $image . "." . $ext);
}

//Création article
session_start();
$article = new Article();

$article->setTitle($post["title"]);
$article->setCommentary($post["commentary"]);
$article->setId(rand(100000000,999999999));
$article->setUser($_SESSION['id']);
$article->setToken($image . "." . $ext);
$lastdate = date('d-m-Y');
$article->setDate($lastdate);

//Connexion BDD
$base = new BDD($config->getBDD("db"), $config->getBDD("username"), $config->getBDD("password"), $config->getBDD("host"));

$manager = new ManagerArticle($base->connect());
$manager->insert($article);

header('Location: insertion.php?error=16');
