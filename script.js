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
function displayTask() {
  let tasksLists = document.getElementById("tasks-lists");
  const tasksToggle = document.getElementById("tasks-toggle-icon");
  if (tasksLists.style.display == "none") {
    tasksLists.style.display = "block";
    tasksToggle.src = "../icons/arrow_up.png";
  } else {
    tasksLists.style.display = "none";
    tasksToggle.src = "../icons/arrow_down.png";
  }
}
function toggleFinances() {
  const financeLists = document.getElementById("finance-lists");
  const financeToggle = document.getElementById("finance-toggle-logo");
  if (financeLists.style.display == "none") {
    financeLists.style.display = "block";
    financeToggle.src = "../icons/arrow_up.png";
  } else {
    financeLists.style.display = "none";
    financeToggle.src = "../icons/arrow_down.png";
  }
}
