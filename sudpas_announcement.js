document.addEventListener("DOMContentLoaded", () => {
  const createButton = document.getElementById("createButton");
  const dataContainer = document.getElementById("dataContainer");
  const popupContainer = document.getElementById("popupContainer");
  const titleInput = document.getElementById("title");
  const contentInput = document.getElementById("content");
  const saveButton = document.getElementById("saveButton");
  const closeButton = document.getElementById("closeButton");
  const pagination = document.getElementById("pagination");

  createButton.addEventListener("click", () => {
    popupContainer.style.display = "block";
  });

  popupContainer.addEventListener("click", (e) => {
    if (e.target === popupContainer) {
      popupContainer.style.display = "none";
    }
  });

  saveButton.addEventListener("click", () => {
    fetch("process_announcement.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `titleInputValue=${encodeURIComponent(
        titleInput.value
      )}&contentInputValue=${encodeURIComponent(
        contentInput.value
      )}&task=${encodeURIComponent("create")}&DBid=${encodeURIComponent("0")}`,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("데이터베이스 연결 오류");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success === true) {
          alert("공지사항 작성 성공");
          window.location.href = "sudpas_announcement.php";
        } else {
          alert("작성 실패");
        }
      })
      .catch((error) => {
        console.error(error);
      });
  });

  closeButton.addEventListener("click", () => {
    popupContainer.style.display = "none";
  });

  dataContainer.addEventListener("click", (e) => {
    if (e.target.classList.contains("tableButton")) {
      const group = e.target.getAttribute("group");
      const action = e.target.getAttribute("data-action");

      if (action === "modify") {
        fetch("process_announcement.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `titleInputValue=${encodeURIComponent(
            titleInput.value
          )}&contentInputValue=${encodeURIComponent(
            contentInput.value
          )}&task=${encodeURIComponent("modify")}&DBid=${encodeURIComponent(
            group
          )}`,
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error("데이터베이스 연결 오류");
            }
            return response.json();
          })
          .then((data) => {
            if (data.success === true) {
              titleInput.value = data.message.title;
              contentInput.value = data.message.content;
              popupContainer.style.display = "block";
            } else {
              alert("해당 공지를 불러올 수 없습니다!");
            }
          })
          .catch((error) => {
            console.error(error);
          });
      } else if (action === "delete") {
        if (confirm("정말로 삭제하시겠습니까?")) {
          fetch("process_announcement.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `titleInputValue=${encodeURIComponent(
              titleInput.value
            )}&contentInputValue=${encodeURIComponent(
              contentInput.value
            )}&task=${encodeURIComponent("delete")}&DBid=${encodeURIComponent(
              group
            )}`,
          })
            .then((response) => {
              if (!response.ok) {
                throw new Error("데이터베이스 연결 오류");
              }
              return response.json();
            })
            .then((data) => {
              if (data.success === true) {
                alert("삭제 성공!");
              } else {
                alert("삭제 실패!");
              }
            })
            .catch((error) => {
              console.error(error);
            });
          window.location.href = "sudpas_announcement.php";
        } else {
          alert("삭제가 취소되었습니다.");
        }
      } else if (action === "activate") {
        fetch("process_announcement.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `titleInputValue=${encodeURIComponent(
            titleInput.value
          )}&contentInputValue=${encodeURIComponent(
            contentInput.value
          )}&task=${encodeURIComponent("activate")}&DBid=${encodeURIComponent(
            group
          )}`,
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error("데이터베이스 연결 오류");
            }
            return response.json();
          })
          .then((data) => {
            if (data.success === true) {
              alert("활성화 상태 변경 성공!");
              location.reload();
            } else {
              alert("활성화 상태 변경 실패!");
            }
          })
          .catch((error) => {
            console.error(error);
          });
      }
    }
  });

  pagination.addEventListener("click", (e) => {
    if (e.target.classList.contains("pageButton")) {
      const page = e.target.getAttribute("page");

      window.location.href = `sudpas_announcement.php?page=${page}`;
    } else if (e.target.classList.contains("prevButton")) {
      const currentPage =
        parseInt(new URLSearchParams(window.location.search).get("page")) || 1;

      window.location.href = `sudpas_announcement.php?page=${currentPage - 1}`;
    } else if (e.target.classList.contains("nextButton")) {
      const currentPage =
        parseInt(new URLSearchParams(window.location.search).get("page")) || 1;

      window.location.href = `sudpas_announcement.php?page=${currentPage + 1}`;
    }
  });
});
