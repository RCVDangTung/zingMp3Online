<?php
/**
 * Created by PhpStorm.
 * User: Tu
 * Date: 20/2/2015
 * Time: 8:55 PM
 */

function getAlbum($content) {
    $info = explode("xml=\"", $content);
    if ($info[0] == $content) {
        printError();
        return;
    }
    $info = $info[1];
    $xmlURL = explode("\"", $info)[0];
    $jsonContent = file_get_contents($xmlURL);
    $album = json_decode($jsonContent)->data;

    for ($i=0; $i<count($album); $i++) {
        printSong($album[$i], $i + 1);
    }
}

function printSong($song, $index) {
    $idb = "btn-" . $index;
    $idp = "player-" . $index;
    echo "<h3 class='list-group-item'>". $index . ". " . $song->title ."<span class='badge'>$song->performer</span></h3>";
    echo "<li class='list-group-item list-group-item-info'>Download: <a href='" . $song->source . "' download='" . $song->source . "'>128 kpbs</a> <button class='btn btn-info btn-xs btn-play' id='" . $idb . "' onclick='playMusicAlbum(" . $index . ");'>Play</button></li>";
    echo "<li class='list-group-item list-group-item-info' id='" . $idp . "' style='display: none'><audio controls><source  src='" . $song->source . "' type='audio/mpeg''>Your browser does not support the audio element.</audio></li>";
}
?>