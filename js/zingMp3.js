/**
 * Created by Tu on 07/2/2015.
 */

function getLink() {
    var link = document.getElementById("link-mp3").value;
    if (link) {
        $(document).ready(
          function () {
              $("#list-link").load("php/solution.php?url=" + link);
          });
    }
    else {
        alert("Vui lòng dán link vào!");
    }
}