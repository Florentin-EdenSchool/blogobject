<?php
class Article
{
    private $title;
    private $commentary;
    private $date;
    private $id;
    private $token;
    private $user;
    private $owner;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setCommentary($commentary)
    {
        $this->commentary = $commentary;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCommentary()
    {
        return $this->commentary;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getOwner()
    {
        return $this->owner;
    }
}
?>