<?php
require("song.php");
require("album.php");

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

    $urlm = "http://m.mp3.zing.vn";
    $arr = explode("mp3.zing.vn", $url);
    $urlm .= $arr[1];

    if (!($content = file_get_contents($urlm))) {
        printError();
        return;
    }

    if (strpos($url, "bai-hat")) {//Bài hát đơn
        getSong($url, $content);
    }
    else if (strpos($url, "album")) {//Album
        getAlbum($content);
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
    echo "<script>$('#load').fadeOut('slow'); $('#refresh').delay(1000).fadeIn(1000);</script>";
}
?>