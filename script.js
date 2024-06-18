function displayProfile() {
  const profilelinks = document.getElementById("logout-userprofile");
  profilelinks.style.display = "block";
  let profileLinksStatus = window.getComputedStyle(profilelinks, null).display;
  if (profileLinksStatus == "block") {
    setTimeout(() => {
      window.onclick = (e) => {
        let location = e.target;
        if (
          profileLinksStatus == "block" &&
          !location.closest("#logout-userprofile")
        ) {
          profilelinks.style.display = "none";
          profileLinksStatus = "none";
        }
      };
    }, 100);
  }
}
let date = new Date();
let d = date.getDate();
const month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
let getMonth = month[date.getMonth()];
let year = date.getFullYear();
if (getMonth < 10) {
  getMonth = "0" + getMonth;
}
if (d < 10) {
  d = "0" + d;
}
document.getElementById("date").value = `${year}-${getMonth}-${d}`;
document.getElementById("displayDate").innerHTML = `${year}-${getMonth}-${d}`;
function displayTask() {
  let tasksLists = document.getElementById("tasks-lists");
  const tasksToggle = document.getElementById("tasks-toggle-icon");
  if (tasksLists.style.display == "none") {
    tasksLists.style.display = "block";
    tasksToggle.src = "../../icons/arrow_up.png";
  } else {
    tasksLists.style.display = "none";
    tasksToggle.src = "../../icons/arrow_down.png";
  }
}
function displayTaskback() {
  let tasksLists = document.getElementById("tasks-lists-back");
  const tasksToggle = document.getElementById("tasks-back-toggle-icon");
  if (tasksLists.style.display == "none") {
    tasksLists.style.display = "block";
    tasksToggle.src = "./../icons/arrow_up.png";
  } else {
    tasksLists.style.display = "none";
    tasksToggle.src = "./../icons/arrow_down.png";
  }
}

function toggleFinances() {
  const financeLists = document.getElementById("finance-lists");
  const financeToggle = document.getElementById("finance-toggle-logo");
  if (financeLists.style.display == "none") {
    financeLists.style.display = "block";
    financeToggle.src = "../../icons/arrow_up.png";
  } else {
    financeLists.style.display = "none";
    financeToggle.src = "../../icons/arrow_down.png";
  }
}
function toggleFinancesback() {
  const financeLists = document.getElementById("finance-lists-back");
  const financeToggle = document.getElementById("finance-back-toggle-logo");
  if (financeLists.style.display == "none") {
    financeLists.style.display = "block";
    financeToggle.src = "./../icons/arrow_up.png";
  } else {
    financeLists.style.display = "none";
    financeToggle.src = "./../icons/arrow_down.png";
  }
}
function toggleUsers() {
  const userLists = document.getElementById("user-lists");
  const toggleLogo = document.getElementById("user-toggle-img");
  if (userLists.style.display == "none") {
    userLists.style.display = "block";
    toggleLogo.src = "../../icons/arrow_up.png";
  } else {
    userLists.style.display = "none";
    toggleLogo.src = "../../icons/arrow_down.png";
  }
}
function toggleUsersback() {
  const userLists = document.getElementById("user-back-lists");
  const toggleLogo = document.getElementById("user-back-toggle-img");
  if (userLists.style.display == "none") {
    userLists.style.display = "block";
    toggleLogo.src = "./../icons/arrow_up.png";
  } else {
    userLists.style.display = "none";
    toggleLogo.src = "./../icons/arrow_down.png";
  }
}
function toggleMotives() {
  const motiveLists = document.getElementById("motive-lists");
  const toggleLogo = document.getElementById("motives-toggle-img");
  if (motiveLists.style.display == "none") {
    motiveLists.style.display = "block";
    toggleLogo.src = "../../icons/arrow_up.png";
  } else {
    motiveLists.style.display = "none";
    toggleLogo.src = "../../icons/arrow_down.png";
  }
}
function toggleMotivesback() {
  const motiveLists = document.getElementById("motive-back-lists");
  const toggleLogo = document.getElementById("motives-back-toggle-img");
  if (motiveLists.style.display == "none") {
    motiveLists.style.display = "block";
    toggleLogo.src = "./../icons/arrow_up.png";
  } else {
    motiveLists.style.display = "none";
    toggleLogo.src = "./../icons/arrow_down.png";
  }
}
function toggleContactus() {
  const contactList = document.getElementById("message-lists");
  const toggleLogo = document.getElementById("contact-toggle-img");
  if (contactList.style.display == "none") {
    contactList.style.display = "block";
    toggleLogo.src = "../../icons/arrow_up.png";
  } else {
    contactList.style.display = "none";
    toggleLogo.src = "../../icons/arrow_down.png";
  }
}
function toggleContactusback() {
  const contactList = document.getElementById("message-back-lists");
  const toggleLogo = document.getElementById("contact-toggle-back-img");
  if (contactList.style.display == "none") {
    contactList.style.display = "block";
    toggleLogo.src = "./../icons/arrow_up.png";
  } else {
    contactList.style.display = "none";
    toggleLogo.src = "./../icons/arrow_down.png";
  }
}
function toggleMaster() {
  const masterLists = document.getElementById("master-lists");
  const toggleLogo = document.getElementById("master-toggle-img");

  if (masterLists.style.display == "none") {
    masterLists.style.display = "block";
    toggleLogo.src = "../../icons/arrow_up.png";
  } else {
    masterLists.style.display = "none";
    toggleLogo.src = "../../icons/arrow_down.png";
  }
}
function toggleMasterback() {
  const masterLists = document.getElementById("master-back-lists");
  const toggleLogo = document.getElementById("master-back-toggle-img");

  if (masterLists.style.display == "none") {
    masterLists.style.display = "block";
    toggleLogo.src = "./../icons/arrow_up.png";
  } else {
    masterLists.style.display = "none";
    toggleLogo.src = "./../icons/arrow_down.png";
  }
}
function addExpensesInput() {
  event.preventDefault();
  addInput("monthlyexpenses-repeater-fields");
}
function addIncomeInput() {
  event.preventDefault();
  addInput("monthlyincome-repeater-fields");
}
function addInput(containerName) {
  event.preventDefault();
  const inputContainer = document.getElementById(containerName);
  const numInputs = inputContainer.querySelectorAll("input").length;
  const newInput = document.createElement("input");
  console.log(numInputs);
  newInput.setAttribute("name", `title[${numInputs}]`);
  newInput.setAttribute("type", "text");
  const divContainer = document.createElement("div");
  divContainer.setAttribute("class", "d-flex gap-2");
  const removeCurrentInput = document.createElement("button");
  removeCurrentInput.innerHTML = "-";
  removeCurrentInput.setAttribute("class", "btn-danger");
  divContainer.appendChild(newInput);
  divContainer.appendChild(removeCurrentInput);
  console.log(inputContainer);
  inputContainer.appendChild(divContainer);
  removeCurrentInput.addEventListener("click", function () {
    event.preventDefault();
    divContainer.remove();
  });
}
