/**
 * Created by Tu on 07/2/2015.
 */

var listLink = [
    "http://mp3.zing.vn/bai-hat/My-Everything-Tien-Tien/ZW6FEBZA.html",
    "http://m.mp3.zing.vn/bai-hat/My-Everything-Tien-Tien/ZW6FEBZA.html",
    "mp3.zing.vn/bai-hat/My-Everything-Tien-Tien/ZW6FEBZA.html",
    "m.mp3.zing.vn/bai-hat/My-Everything-Tien-Tien/ZW6FEBZA.html"
];
var i = 0;
function incIndex() {
    if (i<listLink.length - 1) {
        i++;
    }
    else i = 0;
}

function getLink() {
    var link = document.getElementById("link-mp3").value;
    if (link) {
        $(document).ready(function () {
            link = encodeURI(link);
            $("#load").fadeIn('fast');
            $("#list-link").load("php/solution.php?url=" + link);
        });
    }
    else {
        alert("Vui lòng dán link vào!");
    }
}

function pullLink() {
    $(document).ready(function () {
        document.getElementById("link-mp3").value = listLink[i];
        incIndex();
    });
}

function playMusic() {
    $(document).ready(function () {
        $("#btn-play").fadeOut(1000);
        $("#player").delay(1000).animate({width: 'toggle'});
    });
}