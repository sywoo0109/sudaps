const popup = document.getElementById("popup");
const closeBtn = document.getElementById("closeBtn");

function openPopup() {
  popup.style.display = "block";
}

function closePopup() {
  popup.style.display = "none";
}

closeBtn.addEventListener("click", closePopup);

document.getElementById("homeSetting").addEventListener("click", openPopup);
