$(document).ready(function () {
  $("#summernote").summernote();
});

function loadUsersOnline() {
  $.get("includes/functions.php?onlineusers=result", function (data) {
    $(".usersonline").text(data);
    // console.log($(".usersonline").text(data));
  });
}

setInterval(function () {
  loadUsersOnline();
}, 1000);

$(document).ready(function () {
  $("#selectAllBoxes").click(function (event) {
    if (this.checked) {
      $(".checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function () {
        this.checked = false;
      });
    }
  });
});
