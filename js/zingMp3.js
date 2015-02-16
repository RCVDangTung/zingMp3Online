/**
 * Created by Tu on 07/2/2015.
 */

function getLink() {
    var link = document.getElementById("link-mp3").value;
    if (link) {
        var arr = link.split("/");
        var id = arr[arr.length - 1];
        var urlDownload = "http://mp3.zing.vn/download/vip/song/" + id;
        document.getElementById("list-link").innerHTML = "<p><a href=\"" + urlDownload + "\" target=\"_blank\">Download 320kpbs</a></p>";
    }
}