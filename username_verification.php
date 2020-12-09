
<?php
include('load.php');
if ($_REQUEST["name"]) {
    session_start();
    $lang = new ManagerLang($_SESSION["lang"]);
    $name = $_REQUEST["name"];
    $base = new BDD($config->getBDD("db"), $config->getBDD("username"), $config->getBDD("password"), $config->getBDD("host"));

    $manager = new ManagerUser($base->connect());
    $result = $manager->register_verification($name);

    echo $result ? '<span class="error">' . $lang->getContent("nameUse") . '</div>' : '<span class="good">' . $lang->getContent("nameAvailable") . '</div>';
}
?> 