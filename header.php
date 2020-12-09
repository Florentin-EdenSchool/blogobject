<!DOCTYPE html>
<html lang="fr">

<head>
  <!-- Javascripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="./js/lang.js"></script>

  <!-- Stylesheets -->
  <link href="style/style.css" rel="stylesheet">
  <?php
  include('load.php');
  $config = new ManagerConfig();
  session_start();

  echo '<link rel="icon" type="image/png" href="' . $config->getPath("image") . 'favicon.png" />';

  if (!isset($_SESSION["lang"])) {
    $_SESSION["lang"] = "fr";
  }

  if (isset($_GET["lang"])) {
    $_SESSION["lang"] = $_GET["lang"];
    header('Location: ' . $_SERVER['PHP_SELF']);
  }

  $lang = new ManagerLang($_SESSION["lang"]);
  ?>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Meta -->
  <title>Blogax</title>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!-- Enlever après upload -->
  <meta name="robots" content="noindex">
  <meta content="Blogax" property="og:title">
  <meta property="og:site_name" content="Blogax">
  <meta content="Blogax" property="og:description">
  <meta content="Blogax" name="description">
  <meta name="viewport" content="width=350, initial-scale=1">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php
    echo '<img class="navbar-brand" style="width: 30px;" src="' . $config->getPath("image") . 'favicon.png" alt="Logo"></img>';
    ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <?php
        echo '<a class="nav-item nav-link" href="index.php">' . $lang->getContent("home") . '</a>';

        //Si connecté
        if (isset($_SESSION['id'])) {
          echo '<a class="nav-item nav-link" href="insertion.php">' . $lang->getContent("post") . '</a>';
        }

        echo '<a class="nav-item nav-link" href="register.php">' . $lang->getContent("register") . '<span class="sr-only"></span></a>';

        //Si non-connecté
        if (!isset($_SESSION['id'])) {
          echo '<a class="nav-item nav-link" href="login.php">' . $lang->getContent("connect") . '<span class="sr-only"></span></a>';
        } else {
          echo '<a class="nav-item nav-link" href="disconnect.php">' . $lang->getContent("disconnect") . '</a>';
        }
        ?>
        <a class="nav-item nav-link" id="fr">🇫🇷</a>
        <a class="nav-item nav-link" id="en">🇬🇧</a>
      </div>
    </div>
  </nav>