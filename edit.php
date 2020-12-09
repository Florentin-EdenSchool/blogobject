<?php
include('header.php');

if (isset($_POST['delete'])) {
    //Création article
    $article = new Article();

    $article->setId($_POST["id"]);

    //Connexion BDD
    $base = new BDD($config->getBDD("db"), $config->getBDD("username"), $config->getBDD("password"), $config->getBDD("host"));

    $manager = new ManagerArticle($base->connect());
    $manager->delete($article);

    header('Location: index.php');
} else if (isset($_POST['modification'])) {
    //Connexion BDD
    $base = new BDD($config->getBDD("db"), $config->getBDD("username"), $config->getBDD("password"), $config->getBDD("host"));
    $manager = new ManagerArticle($base->connect());
    $article = $manager->selectId($_POST["id"]);

    echo '<h1>' . $lang->getContent("editArticle") . '<b> ' . $article->getTitle() . '</b></h1>
        <form action="edit_verification.php" method="POST" enctype="multipart/form-data" id="form-search">
        <input name="id" type="hidden" value=' . $article->getId() . '>
        <div class="form-group">
            <label>' . $lang->getContent("title") . '</label>
            <input type="text" name="title" class="form-control" value="' . $article->getTitle() . '" maxlength="50" minlength="5" required>
        </div>

        <div class="form-group">
            <label>' . $lang->getContent("commentary") . '</label>
            <textarea name="commentary" class="form-control" maxlength="500" minlength="5" required>' . $article->getCommentary() . '</textarea>
        </div>

        <div class="form-group">
            <img id="output" src="' . $config->getPath("image") . $article->getToken() . '" width="100" height="100">
            </p>
            <label>' . $lang->getContent("image") . '</label>
            <input type="file" name="image" class="form-control" multiple="false" onchange="document.getElementById(`output`).src = window.URL.createObjectURL(this.files[0])" accept=".png,.jpg,.jpeg" value="./images/' . $article->getToken() . '" required>
        </div>

        <input type="submit" class="btn btn-primary" value="' . $lang->getContent("edit") . '" name="edit">
    </form>';
} else {
    header('Location: index.php');
}

include('footer.php');
