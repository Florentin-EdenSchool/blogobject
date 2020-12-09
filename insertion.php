<?php
include('header.php');

//Si il n'est pas connecté
if (!isset($_SESSION['id'])) {
    header('Location: login.php?error=2');
}
?>

<form action="insertion_verification.php" method="POST" enctype="multipart/form-data" id="form-search">
    <div class="form-group">
        <?php
        echo '<label>' . $lang->getContent("title") . '</label>'
        ?>
        <input type="text" name="title" class="form-control" maxlength="50" minlength="5" required>
    </div>

    <div class="form-group">
        <?php
        echo '<label>' . $lang->getContent("commentary") . '</label>'
        ?>
        <textarea name="commentary" class="form-control " maxlength="500" minlength="5" required></textarea>
    </div>

    <div class="form-group">
        <img id="output" src="" width="100" height="100">
        <?php
        echo '<p></p><label>' . $lang->getContent("image") . '</label>'
        ?>
        <input type="file" name="image" class="form-control" multiple="false" accept=".png,.jpg,.jpeg" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" required>
    </div>

    <?php
    echo '<input type="submit" class="btn btn-primary" value="' . $lang->getContent("add") . '" name="add">'
    ?>
</form>

<?php
include('error.php');

include('footer.php');
?>