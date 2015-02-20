<?php
require("song.php");

if (!empty($_GET["url"])) {
    $url = "t" . $_GET["url"];

    if (strpos($url, " ")) {//Phát hiện có dấu cách "space"
        printError();
        return;
    }

    //Kiểm tra xem link có phải của zing Mp3 không?
    if (!strpos($url, "mp3.zing.vn/") && !strpos($url, "m.mp3.zing.vn/")) {
        printError();
        return;
    }

    if (strpos($url, "bai-hat")) {//Bài hát đơn
        getSong($url);
    }
    else printError();
    stopLoadIcon();
}
else {
    die("No!");
}

function printError() {
    echo "<h3 class='list-group-item list-group-item-danger'>Đã có lỗi xảy ra <img src='img/cry.png'/></h3>";
    stopLoadIcon();
}

function stopLoadIcon() {
    echo "<script>$('#load').fadeOut('slow');</script>";
}
?>