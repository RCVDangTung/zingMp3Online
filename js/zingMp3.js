/**
 * Created by Tu on 07/2/2015.
 */

function reFresh() {
    $("#result").load("data/functions.txt");
    $("#refresh").fadeOut('slow');
}

var listLink, i=0;
$.getJSON("data/listLink.json", function (content) {
    listLink = content;
});

function incIndex() {
    if (i<listLink.length - 1) i++;
    else i = 0;
}

function getLink() {
    $("#refresh").hide();
    var link = $("#link-mp3").val();
    if (link) {
        $(document).ready(function () {
            link = encodeURI(link);
            $("#load").fadeIn('fast');
            $("#result").load("php/solution.php?url=" + link);
        });
    }
    else alert("Vui lòng dán link vào!");
}

function pullLink() {
    $(document).ready(function () {
        $("#link-mp3").val(listLink[i]);
        incIndex();
    });
}

function playMusic() {
    $(document).ready(function () {
        $("#btn-play").fadeOut(1000);
        $("#player").delay(1000).animate({width: 'toggle'});
    });
}

function playMusicAlbum(index) {
    $(document).ready(function () {
        $("#btn-" + index).fadeOut(1000);
        $("#player-" + index).delay(1000).animate({width: 'toggle'});
    });
}