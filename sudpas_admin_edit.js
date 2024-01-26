document.addEventListener("DOMContentLoaded", () => {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const idValue = urlParams.get("id");
  const groupInput = document.getElementById("group");
  const nameInput = document.getElementById("name");
  const nameError = document.getElementById("nameError");
  const passwordInput = document.getElementById("password");
  const passwordError = document.getElementById("passwordError");
  const passwordCheckInput = document.getElementById("passwordCheck");
  const passwordCheckError = document.getElementById("passwordCheckError");
  const radioButtons = document.querySelectorAll(
    'input[name="activationStatus"]'
  );
  const saveButtonInput = document.getElementById("saveButton");

  const checklist = {
    group: "1",
    radio: "1",
  };

  groupInput.addEventListener("change", () => {
    const groupValue = groupInput.value;
    delete checklist.group;
    checklist.group = groupValue;
  });

  nameInput.addEventListener("blur", () => {
    const nameValue = nameInput.value;
    const isLengthValid = nameValue.length >= 1 && nameValue.length <= 10;

    if (isLengthValid) {
      nameError.setAttribute("style", "color: gray;");
      delete checklist.name;
      checklist.name = nameValue;
    } else {
      nameError.setAttribute("style", "color: red;");
      delete checklist.name;
    }
  });

  passwordInput.addEventListener("blur", () => {
    const passwordValue = passwordInput.value;
    const hasNoKorean = !/[\u3131-\uD79D]/.test(passwordValue);
    const hasUpperCase = /[A-Z]/.test(passwordValue);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(passwordValue);
    const isWithinLengthLimit = passwordValue.length <= 10;

    if (hasNoKorean && hasUpperCase && hasSpecialChar && isWithinLengthLimit) {
      passwordError.setAttribute("style", "color: gray;");
      delete checklist.password;
      checklist.password = passwordValue;
    } else {
      passwordError.setAttribute("style", "color: red;");
      delete checklist.password;
    }
  });

  passwordCheckInput.addEventListener("blur", () => {
    const passwordValue = passwordInput.value;
    const passwordCheckValue = passwordCheckInput.value;

    if (passwordValue === passwordCheckValue) {
      passwordCheckError.setAttribute("style", "color: gray;");
      delete checklist.passwordCheck;
      checklist.passwordCheck = passwordCheckValue;
    } else {
      passwordCheckError.setAttribute("style", "color: red;");
      delete checklist.passwordCheck;
    }
  });

  radioButtons.forEach(function (radioButton) {
    radioButton.addEventListener("change", () => {
      const selectedValue = document.querySelector(
        'input[name="activationStatus"]:checked'
      ).value;
      delete checklist.radio;
      checklist.radio = selectedValue === "true" ? "1" : "0";
    });
  });

  saveButtonInput.addEventListener("click", () => {
    if (Object.keys(checklist).length === 5) {
      fetch("process_admin_edit.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `idValue=${encodeURIComponent(idValue.trim())}
        &groupInputValue=${encodeURIComponent(
          checklist.group
        )}&nameInputValue=${encodeURIComponent(
          checklist.name
        )}&passwordInputValue=${encodeURIComponent(
          checklist.password
        )}&radioInputValue=${encodeURIComponent(checklist.radio)}`,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("데이터베이스 연결 오류");
          }
          return response.json();
        })
        .then((data) => {
          if (data.success === true) {
            alert("관리자 정보 수정 성공");
            window.location.href = "sudpas_admin.php";
          } else {
            alert("관리저 정보 수정 실패");
          }
        })
        .catch((error) => {
          console.error(error);
        });
    }
  });
});

// Aa!1BbC2
