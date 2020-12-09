<?php include('header.php'); ?>

<form action="register_verification.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <?php
    echo '<label>' . $lang->getContent("name") . '</label>';
    ?>
    <input type="text" class="form-control" name="username" maxlength="50" minlength="5" onkeyup="usernameVerification(this.value)" required>
    <script>
      usernameVerification("start");
      function usernameVerification(str) {
        if (!str.length == 0) {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if (this.responseText) {
                if (document.getElementById("ajaxError").textContent != this.responseText)
                  document.getElementById("ajaxError").innerHTML = this.responseText;
              }
            }
          };
          xmlhttp.open("GET", "username_verification.php?name=" + str, true);
          xmlhttp.send();
        }
      }
    </script>
    <div id="ajaxError" class="error"></div>
  </div>
  <div class="form-group">
    <?php
    echo '<label>' . $lang->getContent("password") . '</label>';
    ?>
    <input type="password" class="form-control" name="identification" maxlength="50" minlength="5" required>
  </div>
  <div class="form-group">
    <?php
    echo '<label>' . $lang->getContent("password") . '</label>';
    ?>
    <input type="password" class="form-control" name="confirmation" maxlength="50" minlength="5" required>
  </div>
  <?php
  echo '<button type="submit" class="btn btn-primary">' . $lang->getContent("send") . '</button>'
  ?>
</form>

<?php
//Les codes erreurs
include('error.php');

include('footer.php');
?>