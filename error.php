<?php
if (isset($_REQUEST["error"])) {
    if ($_REQUEST["error"] == "1") {
        echo '<div class="error">' . $lang->getContent("passwordError1") . '</div>';
    }

    if ($_REQUEST["error"] == "2") {
        echo '<div class="error">' . $lang->getContent("connectError1") . '</div>';
    }

    if ($_REQUEST["error"] == "3") {
        echo '<div class="error">' . $lang->getContent("connectError2") . '</div>';
    }

    if ($_REQUEST["error"] == "4") {
        echo '<div class="error">' . $lang->getContent("fileError1") . '</div>';
    }

    if ($_REQUEST["error"] == "5") {
        echo '<div class="error">' . $lang->getContent("fileError2") . '</div>';
    }

    if ($_REQUEST["error"] == "6") {
        echo '<div class="error">' . $lang->getContent("fileError3") . '</div>';
    }

    if ($_REQUEST["error"] == "7") {
        echo '<div class="error">' . $lang->getContent("emptyError") . '</div>';
    }

    if ($_REQUEST["error"] == "8") {
        echo '<div class="good">' . $lang->getContent("disconnectGood") . '</div>';
    }

    if ($_REQUEST["error"] == "9") {
        echo '<div class="error">' . $lang->getContent("passwordError2") . '</div>';
    }

    if ($_REQUEST["error"] == "10") {
        echo '<div class="error">' . $lang->getContent("nameError") . '</div>';
    }

    if ($_REQUEST["error"] == "11") {
        echo '<div class="good">' . $lang->getContent("articleEditGood") . '</div>';
    }

    if ($_REQUEST["error"] == "12") {
        echo '<div class="error">' . $lang->getContent("longError1") . '</div>';
    }

    if ($_REQUEST["error"] == "13") {
        echo '<div class="error">' . $lang->getContent("longError2") . '</div>';
    }

    if ($_REQUEST["error"] == "14") {
        echo '<div class="error">' . $lang->getContent("smallError1") . '</div>';
    }

    if ($_REQUEST["error"] == "15") {
        echo '<div class="error">' . $lang->getContent("smallError2") . '</div>';
    }

    if ($_REQUEST["error"] == "16") {
        echo '<div class="good">' . $lang->getContent("articleAddGood") . '</div>';
    }

    if ($_REQUEST["error"] == "17") {
        echo '<div class="good">' . $lang->getContent("error") . '</div>';
    }
}
