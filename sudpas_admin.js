document.addEventListener("DOMContentLoaded", () => {
  const groupNameInput = document.getElementById("groupName");
  const groupNameError = document.getElementById("groupNameError");
  const applyButtonInput = document.getElementById("applyButton");
  const cancleButtonInput = document.getElementById("cancleButton");

  groupNameInput.addEventListener("input", () => {
    if (groupNameInput.value.length <= 10) {
      groupNameError.setAttribute("style", "color: gray;");
    } else {
      groupNameError.setAttribute("style", "color: red;");
    }
  });

  applyButtonInput.addEventListener("click", () => {
    const groupNameValue = groupNameInput.value;

    if (groupNameInput.value.length > 0 && groupNameInput.value.length <= 10) {
      fetch("process_groupcreate.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `inputValue=${encodeURIComponent(groupNameValue)}`,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("데이터베이스 연결 오류");
          }
          return response.json();
        })
        .then((data) => {
          if (data.success === true) {
            alert("새로운 관리자 그룹을 생성했습니다");
            window.location.href = "sudpas_admin.php";
          } else if (
            data.message === "Group name already exists in the database"
          ) {
            alert("관리자 그룹이 이미 존재합니다");
          }
        })
        .catch((error) => {
          console.error(error);
        });
    }
  });
});
