function getRandomDummyImage(width, height) {
  const randomId = Math.floor(Math.random() * 1000);
  return `https://picsum.photos/${width}/${height}?random=${randomId}`;
}

const dummyImage = document.getElementById("dummyImage");
const imageUrl = getRandomDummyImage(40, 40);
dummyImage.src = imageUrl;

document.addEventListener("DOMContentLoaded", () => {
  const sideBar = document.getElementById("sideBar");
  const dropdownButton = document.getElementById("dropdownButton");
  const dropdownMenu = document.getElementById("adminDropdownContainer");
  const sideBarButton = document.getElementById("sideBarButton");

  dropdownButton.addEventListener("click", () => {
    if (dropdownMenu.style.display === "none") {
      dropdownMenu.style.display = "block";
      dropdownButton.innerHTML = "&#9650;";
    } else {
      dropdownMenu.style.display = "none";
      dropdownButton.innerHTML = "&#9660;";
    }
  });

  sideBarButton.addEventListener("click", () => {
    if (sideBar.style.display === "flex") {
      sideBar.style.display = "none";
    } else {
      sideBar.style.display = "flex";
    }
  });
});
