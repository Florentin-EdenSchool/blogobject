<?php
if (isset($_POST['edit'])) {
    include('load.php');
    $image = uniqid();

    //Si l'utilisateur n'a pas rentré titre ou commentaire
    if (!isset($_POST["title"]) || !isset($_POST["commentary"])) {
        header('Location: article.php?error=7');
        return;
    }

    //Image erreurs
    if ($_FILES['image']['error']) {
        switch ($_FILES['image']['error']) {
            case 1:
                header('Location: article.php?error=1');
                break;
            case 2:
                header('Location: article.php?error=1');
                break;
            case 3:
                header('Location: article.php?error=5');
                break;
            case 4:
                header('Location: article.php?error=5');
                break;
        }
        return;
    }

    //Titre ou commentaire trop long
    if (strlen($_POST["title"]) > 50 || strlen($_POST["commentary"]) > 500) {
        header('Location: article.php?error=14');
        return;
    }

    //Titre ou commentaire trop court
    if (strlen($_POST["title"]) < 5 || strlen($_POST["commentary"]) < 5) {
        header('Location: article.php?error=15');
        return;
    }

    //Si c'est PNG ou JPG ou JPEG
    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detectedType = exif_imagetype($_FILES['image']['tmp_name']);
    $error = !in_array($detectedType, $allowedTypes);

    //Sinon
    if ($error) {
        header('Location: article.php?error=6');
        return;
    }

    $path = $_FILES['image']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $title = trim($_POST["title"]);
    $commentary = trim($_POST["commentary"]);
    $_POST["commentary"] = str_replace("<", "&lt;", $commentary);
    $_POST["commentary"] = str_replace(">", "&gt;", $commentary);
    $_POST["title"] = str_replace("<", "&lt;", $title);
    $_POST["title"] = str_replace(">", "&gt;", $title);

    //Ajout nouvelle image et suppression ancienne
    if ((isset($_FILES['image']['name']) && ($_FILES['image']['error'] == UPLOAD_ERR_OK))) {
        $chemin_destination = 'images/';
        move_uploaded_file($_FILES['image']['tmp_name'], $chemin_destination . $image . "." . $ext);

        //Connexion BDD
        $base = new BDD($config->getBDD("db"), $config->getBDD("username"), $config->getBDD("password"), $config->getBDD("host"));

        $manager = new ManagerArticle($base->connect());
        $manager = $manager->selectId($_POST["id"]);

        unlink($config->getPath("image") . $manager->getToken());
    }

    //Création article
    session_start();
    $editArticle = new Article();

    $editArticle->setTitle($_POST["title"]);
    $editArticle->setCommentary($_POST["commentary"]);
    $editArticle->setId($_POST["id"]);
    $editArticle->setToken($image . "." . $ext);
    $lastdate = date('d-m-Y');
    $editArticle->setDate($lastdate);

    //Connexion BDD
    $base = new BDD($config->getBDD("db"), $config->getBDD("username"), $config->getBDD("password"), $config->getBDD("host"));

    $manager = new ManagerArticle($base->connect());
    $manager->edit($editArticle);

    header('Location: index.php?error=11');
} else {
    header('Location: index.php');
}
