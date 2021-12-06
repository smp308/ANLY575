$(function () {
  let userId;


  $("a.delete-user").click(function (event) {
    event.preventDefault();

    userId = $(this).data("dialog-id");
    const firstName = $(this).data("first_name");
    const lastName = $(this).data("last_name");
    const email = $(this).data("email");


    $("#deque-dialog").addClass("deque-show-block");
    $("#deque-dialog").removeClass("deque-hidden");
    $("#deque-dialog").attr("data-dialog-id", userId);
    $(".deque-dialog-button-submit").attr("data-dialog-id", userId);
    $("#deque-dialog .deque-dialog-button-submit").focus();
    $(".first_name").html(firstName);
    $(".last_name").html(lastName);
    $(".email").html(email);
  });


  $(".deque-dialog-button-cancel, .deque-dialog-button-close").click(
    function () {
      $("#deque-dialog").removeClass("deque-show-block");
      $("#deque-dialog").addClass("deque-hidden");
      let idInt = userId.match(/\d+/)[0];
      $(`a[href="user-delete.php?id=${idInt}"]`).focus();
    }
  );
});