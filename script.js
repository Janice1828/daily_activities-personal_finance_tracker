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
