const profile = document.querySelector(".profile");
const profileItems = document.querySelector(".profile-items");

profile.addEventListener("click", () => {
  if (profileItems.style.display === "none") {
    profileItems.style.display = "block";
  } else {
    profileItems.style.display = "none";
  }
});
