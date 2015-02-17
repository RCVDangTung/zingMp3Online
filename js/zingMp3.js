/**
 * Created by Tu on 07/2/2015.
 */

function getLink() {
    var link = document.getElementById("link-mp3").value;
    if (link) {
        $(document).ready(function () {
            $("#list-link").load("php/solution.php?url=" + link);
        });
    }
    else {
        alert("Vui lòng dán link vào!");
    }
}

function pullLink() {
    $(document).ready(function () {
        document.getElementById("link-mp3").value = "http://mp3.zing.vn/bai-hat/My-Everything-Tien-Tien/ZW6FEBZA.html";
    });
}

function playMusic() {
    $(document).ready(function () {
        $("#btn-play").fadeOut(1000);
        $("#player").delay(1000).animate({width: 'toggle'});
    });
}