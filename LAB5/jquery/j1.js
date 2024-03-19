$(document).ready(function () {
  const generateColor = () => {
    var letters = "0123456789ABCDEF";
    var color = "#";
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  };
  let originalBackgroundColor = $("body").css("background-color");
  let originalTitleText = $("#message").text();

  for (var i = 0; i < 16; i++) {
    $("#color-palette").append(
      $('<div class="color-cell"></div>').css(
        "background-color",
        generateColor()
      )
    );
  }
  $(".color-cell").mouseenter(function () {
    $("body").css("background-color", $(this).css("background-color"));

    $(".title").text($(this).css("background-color"));
  });
  $(".color-cell").mouseleave(function () {
    $(".title").text(originalBackgroundColor);
    $("body").css("background-color", originalBackgroundColor);
  });
  $(".color-cell").click(function () {
    originalBackgroundColor = $(this).css("background-color");
    $("body").css("background-color", $(this).css("background-color"));
    $("body");
    $("#message").fadeIn();
    $("#message").fadeOut(3000);
  });
  $(".title").click(function () {
    var $temp = $("<input>");
    $("body").append($temp);

    $temp.val($(this).text()).select();
    document.execCommand("copy");
    $temp.remove();

    $("#message").text("Color has been copied to clipboard");
    $("#message").fadeIn();
    $("#message").fadeOut(3000);
    setTimeout(() => {
      $("#message").text(originalTitleText);
    }, 3200);
  });
});
