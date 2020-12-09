<?php
spl_autoload_register("load");
function load($classname)
{
    include "./class/" . $classname . ".php";
}

$config = new ManagerConfig();