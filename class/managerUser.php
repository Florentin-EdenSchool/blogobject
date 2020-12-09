<?php
class ManagerUser
{
    private $base;

    public function __construct($base)

    {
        $this->base = $base;
    }

    public function login($username, $identification): array
    {
        $sql = "SELECT username, identification, id FROM `users` where username=:username and identification=:identification;";
        $resultat = $this->base->prepare($sql);
        $resultat->execute(array('username' => $username, 'identification' => $identification));
        $array = array();

        while ($ligne = $resultat->fetch()) {
            $thisUser = new User();
            $thisUser->setUsername($ligne["username"]);
            $thisUser->setIdentification($ligne["identification"]);
            $thisUser->setId($ligne["id"]);
            array_push($array, $thisUser);
        }

        $resultat->closeCursor();
        return $array;
    }

    public function register($username, $identification)
    {
        $sql = "SELECT username FROM `users` where username=:username;";
        $resultat = $this->base->prepare($sql);
        $resultat->execute(array('username' => $username));
        if ($resultat->fetch()) {
            header('Location: register.php?error=10');
        } else {
            $unique = rand(100000000, 999999999);
            $sql = "INSERT INTO users (id, username, identification) VALUES (:id, :username, :identification);";
            $resultat = $this->base->prepare($sql);
            $resultat->execute(array('id' => $unique, 'username' => $username, 'identification' => $identification));
            header('Location: login.php');
        }
        $resultat->closeCursor();
    }

    public function register_verification($name):bool
    {
        $result = false;
        $sql = "SELECT username FROM `users` where username=:username;";
        $resultat = $this->base->prepare($sql);
        $resultat->execute(array('username' => $name));
        if ($resultat->fetch()) {
            $result = true;
        }
        $resultat->closeCursor();
        return $result;
    }
}
