<?php
class ManagerArticle
{
    private $base;

    public function __construct($base)

    {
        $this->base = $base;
    }

    public function insert($article)
    {
        $sql = "INSERT INTO articles (title, commentary, dated, token, id, user) VALUES (:title, :commentary, :dated, :token, :id, :user);";
        $resultat = $this->base->prepare($sql);
        $resultat->execute(array('title' => $article->getTitle(), 'commentary' => $article->getCommentary(), 'dated' => $article->getDate(), 'id' => $article->getId(), 'token' => $article->getToken(), 'user' => $article->getUser()));
        $resultat->closeCursor();
    }

    public function select():array
    {
        $sql = "SELECT users.username as owned,title,commentary,token,dated,user,articles.id FROM articles JOIN users ON articles.user = users.id";
        $resultat = $this->base->prepare($sql);
        $resultat->execute();
        $array = array();

        while ($ligne = $resultat->fetch()) {
            $article = new Article();
            $article->setTitle($ligne["title"]);
            $article->setCommentary($ligne["commentary"]);
            $article->setId($ligne["id"]);
            $article->setToken($ligne["token"]);
            $article->setDate($ligne["dated"]);
            $article->setUser($ligne["user"]);
            $article->setOwner($ligne["owned"]);
            array_push($array, $article);
        }

        $resultat->closeCursor();
        return $array;
    }

    public function selectId($id):Article
    {
        //Modification article formulaire
        $sql = "SELECT * from articles where id=:id;";
        $resultat = $this->base->prepare($sql);
        $resultat->execute(array("id" => $id));
        $object = null;

        while ($ligne = $resultat->fetch()) {
            $article = new Article();
            $article->setTitle($ligne["title"]);
            $article->setCommentary($ligne["commentary"]);
            $article->setId($ligne["id"]);
            $article->setToken($ligne["token"]);
            $article->setDate($ligne["dated"]);
            $article->setUser($ligne["user"]);
            $object = $article;
        }

        $resultat->closeCursor();
        return $object;
    }

    public function delete($id)
    {
        //Suppression article, image
        $sql = "SELECT * from articles where id=:id;";
        $resultat = $this->base->prepare($sql);
        $resultat->execute(array("id" => $id->getId()));

        while ($ligne = $resultat->fetch()) {
            $config = new ManagerConfig();
            unlink($config->getPath("image") . $ligne["token"]);
        }

        $sql = "DELETE from articles where id=:id;";
        $resultat = $this->base->prepare($sql);
        $resultat->execute(array("id" => $id->getId()));
        $resultat->closeCursor();
    }

    public function edit($article)
    {
        $sql = "UPDATE articles set title=:title, commentary=:commentary, token=:token, dated=:dated where id=:id;";
        $resultat = $this->base->prepare($sql);
        $resultat->execute(array("title" => $article->getTitle(), "commentary" => $article->getCommentary(), "id" => $article->getId(), 'token' => $article->getToken(), 'dated' => $article->getDate()));
        $resultat->closeCursor();
    }
}
