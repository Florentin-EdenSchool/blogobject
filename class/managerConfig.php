<?php
class ManagerConfig
{
    public function getBDD($name)
    {
        $path = json_decode(file_get_contents("./config/config.json"), true);
        return $path["bdd"][$name];
    }

    public function getPath($name)
    {
        $path = json_decode(file_get_contents("./config/config.json"), true);
        return $path["path"][$name];
    }
}
