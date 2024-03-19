const addBtn = document.querySelector("#addBtn");
const body = document.querySelector("tbody");
const resetBtn = document.querySelector("#reset");
const firstnameInput = document.querySelector("#firstname");
const lastnameInput = document.querySelector("#lastname");
const emailInput = document.querySelector("#email");

addBtn.addEventListener("click", () => {
  const firstname = firstnameInput.value;
  const lastname = lastnameInput.value;
  const email = emailInput.value;

  if (firstname === "" || lastname === "" || email === "") {
    alert("Please enter information");
  } else {
    const tr = document.createElement("tr");
    const row = `
      <tr>
          <td>${firstname}</td>
          <td>${lastname}</td>
          <td>${email}</td>
          <td><button class="btn btn-danger deleteBtn btn-sm deleteBtn">Delete</button></td>
      </tr>
      `;
    tr.innerHTML = row;
    body.appendChild(tr);
    attachDeleteEvent();
    firstnameInput.value = "";
    lastnameInput.value = "";
    emailInput.value = "";
  }
});
attachDeleteEvent();
function attachDeleteEvent() {
  const deleteButtons = body.querySelectorAll(".deleteBtn");
  deleteButtons.forEach((button) => {
    button.removeEventListener("click", handleDeleteRow);
    button.addEventListener("click", handleDeleteRow);
  });
}

function handleDeleteRow(e) {
  e.target.closest("tr").remove();
}

resetBtn.addEventListener("click", () => {
  body.innerHTML = "";
});
