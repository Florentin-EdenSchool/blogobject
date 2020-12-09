<?php
class User
{
    private $username;
    private $identification;
    private $id;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setIdentification($identification)
    {
        $this->identification = $identification;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getIdentification()
    {
        return $this->identification;
    }

    public function getId()
    {
        return $this->id;
    }
}
?>