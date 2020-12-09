<?php include('header.php');

if (!isset($_SESSION['username'])) {
  $_SESSION['username'] = "";
}
?>

<form action="login_verification.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <?php
    echo '<label>' . $lang->getContent("name") . '</label>';
    echo '<input type="text" class="form-control" name="username" value="' . $_SESSION["username"] . '"required>';
    ?>
  </div>
  <div class="form-group">
    <?php
    echo '<label>' . $lang->getContent("password") . '</label>';
    ?>
    <input type="password" class="form-control" name="identification" required>
  </div>
  <?php
  echo '<button type="submit" class="btn btn-primary">' . $lang->getContent("send") . '</button>';
  ?>
</form>

<?php
//Les codes erreurs
include('error.php');

include('footer.php');
?>