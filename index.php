<?php
include('header.php');

//Les codes erreurs
include('error.php');

//Connexion BDD
$base = new BDD($config->getBDD("db"), $config->getBDD("username"), $config->getBDD("password"), $config->getBDD("host"));
$manager = new ManagerArticle($base->connect());
$article = $manager->select();

//Génération de tous les articles
echo '<div class="card-main">';
for ($i = 0; $i < sizeof($article); $i++) {
    echo '
            <div class="card" style="width: 18rem;">
            <form action="edit.php" method="POST" enctype="multipart/form-data" style="margin-top: 15px; width: 100%;">
            <img class="card-img-top" src="' . $config->getPath("image") . $article[$i]->getToken() . '" alt="Card body">
            <div class="card-body">
            <h5 class="card-title">' . $article[$i]->getTitle() . '</h5>
            </div>
            <ul class="list-group list-group-flush list">
            <li class="list-group-item">' . $article[$i]->getCommentary() . '</li>
            </ul>';
    //Si il est créateur de l'article
    if (isset($_SESSION['id'])) {
        if ($article[$i]->getUser() == $_SESSION['id']) {
            echo '<input name="id" type="hidden" value=' . $article[$i]->getId() . '>
                <input type="submit" name="modification" class="btn btn-primary btn-action" value="' . $lang->getContent("edit") . '"></input>
                  <input type="submit" name="delete" class="btn btn-danger btn-action" value="' . $lang->getContent("delete") . '"></input>';
        }
    }
    echo '<div class="card-footer text-muted">
        ' . $article[$i]->getDate() . ' : ' . $article[$i]->getOwner() . '
      </div>
    </form>
    </div>';
}
echo '</div>';

//Si 0 article
if (sizeof($article) == 0) {
    echo '<div class="error">' . $lang->getContent("content") . '</div>';
}

include('footer.php');
