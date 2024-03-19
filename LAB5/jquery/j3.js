function allowDrop(event) {
  event.preventDefault();
}

function drag(event) {
  event.dataTransfer.setData("text", event.target.id);
}

function drop(event) {
  event.preventDefault();
  var data = event.dataTransfer.getData("text");
  var draggableElement = document.getElementById(data);
  var dropzone = event.target;

  if (dropzone.className.indexOf("inner-box") > -1) {
    dropzone.appendChild(draggableElement);
  } else if (dropzone.id === "box1" || dropzone.id === "box2") {
    dropzone.appendChild(draggableElement);
  }
  checkCompletionAndCorrectness();
}
function checkCompletionAndCorrectness() {
  var allPlaced = $("#box1 .inner-box1").length === 9;
  var allCorrect = true;

  if (allPlaced) {
    $("#box1 .inner-box1").each(function () {
      var pieceId = $(this).attr("id");
      var childImg = $(this).find("img");
      if (childImg.length > 0) {
        var imgId = childImg.attr("id").replace("drag-img-", "");
        if (pieceId !== imgId) {
          allCorrect = false;
          return false;
        }
      } else {
        allPlaced = false;
        return false;
      }
    });

    if (allPlaced && allCorrect) {
      $("#message").fadeIn(1000);
      $("#message").fadeOut();
    }
  }
}

$(document).ready(function () {
  for (let i = 0; i < 9; i++) {
    $("#box1").append(
      '<div class="inner-box inner-box1" ondrop="drop(event)" id=' +
        i +
        'ondragover="allowDrop(event)"></div>'
    );
  }

  function randomRotate() {
    let arr = [0, 90, 180, 270];
    let index = Math.floor(Math.random() * arr.length);
    return arr[index];
  }

  for (let i = 0; i < 10; i++) {
    $("#box2").append(
      '<div class="inner-box inner-box2" id="' +
        i +
        '" ondrop="drop(event)" ondragover="allowDrop(event)">' +
        '<img id="drag-img-' +
        i +
        '" draggable="true" ondragstart="drag(event)" src="./images/cntt_' +
        ("0" + (i + 1)).slice(-2) +
        '.gif"></div>'
    );
  }

  $(".inner-box2 img").each(function () {
    let random = randomRotate();
    $(this).css("transform", "rotate(" + random + "deg)");
    $(this).data("rotate", random);
  });

  $(".inner-box img").click(function () {
    const rotateValue = $(this).data("rotate");
    const degrees = rotateValue + 90 > 270 ? 0 : rotateValue + 90;
    $(this).css("transform", "rotate(" + degrees + "deg)");
    $(this).data("rotate", degrees);
  });
  $(".inner-box1")
    .prop("draggable", true)
    .on("dragstart", function (e) {
      e.originalEvent.dataTransfer.setData("text", e.target.id);
    });

  $(".inner-box1").each(function (i) {
    $(this).attr("id", +i);
  });

  $("#box1, #box2").on("drop", drop).on("dragover", allowDrop);
});
