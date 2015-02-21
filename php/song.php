<?php
/**
 * Created by PhpStorm.
 * User: Tu
 * Date: 20/2/2015
 * Time: 8:42 PM
 */

function getSong($url, $content) {
    //Get infomation song
    $info = explode("xml=\"", $content);
    if ($info[0] == $content) {
        printError();
        return;
    }
    $info = $info[1];
    $xmlURL = explode("\"", $info)[0];

    //Get link & stream music 128 kpbs
    $arrTemp = explode("/", $xmlURL);
    $link128 = "http://api.mp3.zing.vn/api/mobile/download/song/" . $arrTemp[count($arrTemp) - 1];
    $stream128 = "http://api.mp3.zing.vn/api/mobile/source/song/" . $arrTemp[count($arrTemp) - 1];
    
    $jsonContent = file_get_contents($xmlURL);
    $music = json_decode($jsonContent);
    $data = $music->data[0];

    //Get lyric
    $lyric = explode("<p id=\"conLyrics\" class=\"row-5\">", $content)[1];
    $lyric = explode("</p>", $lyric)[0];

    //Content
    $title = $data->title;
    $singer = $data->performer;
    //$link128 = $data->source;
    $link320 = "http://mp3.zing.vn/download/vip/song/" . getID($url);

    echo "<li class=\"list-group-item list-group-item-info\"><h3 style=\"font-weight: bold;\">" . $title . "</h3></li>";
    echo "<li class=\"list-group-item list-group-item-info\">Thể hiện: <strong>" . $singer . "</strong></li>";
    echo "<li class=\"list-group-item list-group-item-info\">Download: <a href=\"" . $link128 . "\" download=\"" . $link128 . "\">128 kpbs</a> - <a href=\"" . $link320 . "\" download=\"" . $link320 . "\">320 kpbs</a></li>";
    echo "<li class=\"list-group-item list-group-item-info\"><button class=\"btn btn-info\" id=\"btn-play\" onclick=\"playMusic();\">Play</button><audio controls style=\"display: none;\" id=\"player\"><source src=\"" .  $stream128 ."\" type=\"audio/mpeg\">Your browser does not support the audio element.</audio></li>";
    echo "<li class=\"list-group-item list-group-item-warning\"><p>" . $lyric . "</p></li>";
}

function getID($url) {
    $url = str_replace(".", "/", $url);
    $arr = explode("/", $url);
    $pos = count($arr) - 2;
    return $arr[$pos];
}
?>