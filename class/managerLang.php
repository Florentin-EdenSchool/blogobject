<?php
class ManagerLang
{
    private $lang;

    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    public function getContent($name)
    {
        $path = json_decode(file_get_contents('./locale/' . $this->lang . '.json'), true);
        return $path[$name];
    }
}