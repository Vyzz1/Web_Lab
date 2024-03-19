function createTableRow(student) {
  return `
          <tr data-id="${student.id}">
            <td>${student.id}</td>
            <td class="student-name">${student.name}</td>
            <td class="student-email">${student.email}</td>
            <td class="student-phone">${student.phone}</td>
            <td>
              <button type="button" class="btn btn-sm btn-primary edit-student" >Edit</button>
              <button type="button" class="btn btn-sm btn-danger delete-student" >Delete</button>
            </td>
          </tr>`;
}

function updateTableRow(studentId, student) {
  var row = $("#table-body").find(`tr[data-id='${studentId}']`);
  row.find(".student-name").text(student.name);
  row.find(".student-email").text(student.email);
  row.find(".student-phone").text(student.phone);
}

// getstudent();
function loadStudent() {
  $.get(
    "http://localhost:8012/lab5/get-students.php",
    function (data) {
      data.data.forEach(function (student) {
        $("#table-body").append(createTableRow(student));
      });
    },
    "json"
  );
}
loadStudent();
$(".add-student").click(function () {
  var studentData = {
    name: $("#name").val(),
    email: $("#email").val(),
    phone: $("#phone").val(),
  };

  $.post(
    "http://localhost:8012/lab5/add-student.php",
    studentData,
    function (data) {
      console.log(data);
      $("#table-body").append(
        createTableRow({ ...studentData, id: data.data.id })
      );
    },
    "json"
  );
});

$(document).on("click", ".delete-student", function () {
  let id = $(this).closest("tr").data("id");

  confirmRemoval(id);
});

$(document).on("click", ".edit-student", function () {
  var studentId = $(this).closest("tr").data("id");
  var row = $(this).closest("tr");
  $("#name").val(row.find(".student-name").text());
  $("#email").val(row.find(".student-email").text());
  $("#phone").val(row.find(".student-phone").text());
  $("#student-id").val(studentId);
  $(".add-student").prop("disabled", true);
  $(".update-student").prop("disabled", false).data("id", studentId);
});

$(".update").click(function () {
  $("#table");
  var studentId = $("#student-id").val();
  console.log(studentId);
  var studentData = {
    id: studentId,
    name: $("#name").val(),
    email: $("#email").val(),
    phone: $("#phone").val(),
  };
  console.log(studentData);
  $.post(
    "http://localhost:8012/lab5/update-student.php",
    studentData,
    function (data) {
      console.log(data);
      if (data.status === "success") {
        updateTableRow(studentId, data.student);
        showMessage("success", "Student updated successfully.");
      } else {
        showMessage("error", "Failed to update student.");
      }
    },
    "json"
  );
  updateTableRow(studentId, studentData);
});
function confirmRemoval(studentId) {
  $("#confirm-removal-modal").modal("show");

  $("#delete-button")
    .off("click")
    .on("click", function () {
      $.post(
        "http://localhost:8102/lab5/delete-student.php",
        { id: studentId },
        function (data) {
          if (data.status === "success") {
            $("#table-body").find(`tr[data-id='${studentId}']`).remove();
            showMessage("success", "Student removed successfully.");
          } else {
            showMessage("error", "Failed to remove student.");
          }
          $("#confirm-removal-modal").modal("hide");
        },
        "json"
      );
    });
}
function showMessage(type, message) {
  var alertDiv = type === "success" ? $(".alert-success") : $(".alert-danger");
  alertDiv.find("strong").text(message);
  alertDiv.fadeIn().delay(3000).fadeOut();
}
