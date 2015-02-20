<?php
if (!empty($_GET["url"])) {
    $url = $_GET["url"];

    //Nếu không có giao thức http thì thêm vào link
    $urlClone = "t" . $url;
    if (!strpos($urlClone, "http://")) {
        $url = "http://" . $url;
    }

    //Kiểm tra xem link có phải của zing Mp3 không?
    if (!strpos($url, "://mp3.zing.vn/") && !strpos($url, "://m.mp3.zing.vn/")) {
        printError();
        return;
    }

    if (strpos($url, "://mp3") != null) {
        $arr = explode("http://", $url);
        $urlm = "http://m." . $arr[1];
    } else if (strpos($url, "://m.mp3.zing.vn") != null) {
        $urlm = $url;
    }

    if (!($content = file_get_contents($urlm))) {
        printError();
        return;
    }

    //Get infomation song
    $info = explode("xml=\"", $content);
    if ($info[0] == $content) {
        printError();
        return;
    }
    $info = $info[1];
    $xmlURL = explode("\"", $info)[0];
    $jsonContent = file_get_contents($xmlURL);
    $music = json_decode($jsonContent);
    $data = $music->data[0];

    //Get img ava
    //$content1 = explode("property=\"og:image\" content=\"", $content)[1];
    //$img = explode("\"", $content1)[0];

    //Get lyric
    $lyric = explode("<p id=\"conLyrics\" class=\"row-5\">", $content)[1];
    $lyric = explode("</p>", $lyric)[0];

    //Content
    $title = $data->title;
    $singer = $data->performer;
    $link128 = $data->source;
    $link320 = "http://mp3.zing.vn/download/vip/song/" . getID($url);

    echo "<li class=\"list-group-item list-group-item-info\"><h3 style=\"font-weight: bold;\">" . $title . "</h3></li>";
    echo "<li class=\"list-group-item list-group-item-info\">Thể hiện: <strong>" . $singer . "</strong></li>";
    echo "<li class=\"list-group-item list-group-item-info\">Download: <a href=\"" . $link128 . "\" download=\"" . $link128 . "\">128 kpbs</a> - <a href=\"" . $link320 . "\" download=\"" . $link320 . "\">320 kpbs</a></li>";
    echo "<li class=\"list-group-item list-group-item-info\"><button class=\"btn btn-info\" id=\"btn-play\" onclick=\"playMusic();\">Play</button><audio controls style=\"display: none;\" id=\"player\"><source src=\"" .  $link128 ."\" type=\"audio/mpeg\">Your browser does not support the audio element.</audio></li>";
    echo "<li class=\"list-group-item list-group-item-warning\"><p>" . $lyric . "</p></li>";

    stopLoadIcon();
}
else {
    die("No!");
}

function getID($url) {
    $url = str_replace(".", "/", $url);
    $arr = explode("/", $url);
    $pos = count($arr) - 2;
    return $arr[$pos];
}

function printError() {
    echo "<h3 class='list-group-item list-group-item-danger'>Đã có lỗi xảy ra <img src='img/cry.png'/></h3>";
    stopLoadIcon();
}

function stopLoadIcon() {
    echo "<script>$('#load').fadeOut('slow');</script>";
}
?>