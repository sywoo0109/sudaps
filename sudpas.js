document.addEventListener("DOMContentLoaded", () => {
  const dropdownButton = document.getElementById("dropdownButton");
  const dropdownMenu = document.getElementById("adminDropdownContainer");

  dropdownButton.addEventListener("click", () => {
    if (dropdownMenu.style.display === "none") {
      dropdownMenu.style.display = "block";
      dropdownButton.innerHTML = "&#9650;";
    } else {
      dropdownMenu.style.display = "none";
      dropdownButton.innerHTML = "&#9660;";
    }
  });
});
