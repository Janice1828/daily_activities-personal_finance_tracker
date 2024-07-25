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
function toggleIncome() {
  const sidebarincomesList = document.getElementById("incomes-list");
  const arrowIcon = document.getElementById("incomeArrow");
  if (sidebarincomesList.style.display == "none") {
    sidebarincomesList.style.display = "block";
    arrowIcon.src = "../../icons/arrow_up.png";
  } else {
    arrowIcon.src = "../../icons/arrow_down.png";
    sidebarincomesList.style.display = "none";
  }
}
function toggleDashboardIncome() {
  const sidebarincomesList = document.getElementById("dashboard-incomes-list");
  const arrowIcon = document.getElementById("dashboardIncomeArrow");
  if (sidebarincomesList.style.display == "none") {
    sidebarincomesList.style.display = "block";
    arrowIcon.src = "../icons/arrow_up.png";
  } else {
    arrowIcon.src = "../icons/arrow_down.png";
    sidebarincomesList.style.display = "none";
  }
}
function toggleExpenses() {
  const sidebarexpensesList = document.getElementById("expenses-list");
  const arrowIcon = document.getElementById("expenseArrow");
  if (sidebarexpensesList.style.display == "none") {
    sidebarexpensesList.style.display = "block";
    arrowIcon.src = "../../icons/arrow_up.png";
  } else {
    sidebarexpensesList.style.display = "none";
    arrowIcon.src = "../../icons/arrow_down.png";
  }
}
function downloadPDF() {
  const printableArea = document.querySelector(".pdf-printable-area").innerHTML;
  let style = "<style>";
  style = style + "table{border:1px solid #000; border-collapse:collapse}";
  style = style + "tr{border:1px solid #000}";
  style =
    style +
    "a{color:black !important; text-decoration:none !important;  pointer-events: none;}";
  style = style + "td{border:1px solid #000}";
  style = style + "th{border:1px solid #000}";
  style = style + "</style>";
  // let link = document.querySelectorAll("a");
  // link.forEach((item) => {
  //   item.setAttribute("href", "#");
  // });
  // console.log(link);
  let windowObj = window.open("", "", "width:900, height:700");
  windowObj.document.write(style);
  windowObj.document.write(printableArea);

  windowObj.document.close();
  windowObj.print();
}

function toggleDashboardExpenses() {
  const sidebarexpensesList = document.getElementById(
    "dashboard-expenses-list"
  );
  const arrowIcon = document.getElementById("dashboardExpenseArrow");
  if (sidebarexpensesList.style.display == "none") {
    sidebarexpensesList.style.display = "block";
    arrowIcon.src = "../icons/arrow_up.png";
  } else {
    sidebarexpensesList.style.display = "none";
    arrowIcon.src = "../icons/arrow_down.png";
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
function stopRefreshing() {
  // event.preventDefault();
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
  newInput.setAttribute("name", `title[${numInputs}]`);
  newInput.setAttribute("type", "text");
  const divContainer = document.createElement("div");
  divContainer.setAttribute("class", "d-flex gap-2 align-items-center");
  const removeCurrentInputBtn = document.createElement("button");
  const removeIcon = document.createElement("img");
  removeIcon.src = "../../icons/icons8-subtract-50.png";
  removeIcon.setAttribute("class", "input-sub-icon");
  removeCurrentInputBtn.append(removeIcon);
  removeCurrentInputBtn.setAttribute("class", "btn-danger  m-0 addInputBtn");
  divContainer.appendChild(newInput);
  divContainer.appendChild(removeCurrentInputBtn);
  inputContainer.appendChild(divContainer);
  removeCurrentInputBtn.addEventListener("click", function () {
    event.preventDefault();
    divContainer.remove();
  });
}

const dateContainer = document.getElementById("date");
if (dateContainer) {
  dateContainer.value = `${year}-${getMonth}-${d}`;
}
const displayingDate = document.getElementById("displayDate");
if (displayingDate) {
  displayingDate.innerHTML = `${year}-${getMonth}-${d}`;
}
let pageLinks = document.querySelectorAll(".page-numbers > a");
if (pageLinks) {
  let bodyId = parseInt(document.body.id) - 1;
  pageLinks[bodyId].classList.add("active-page");
}
