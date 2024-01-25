document.addEventListener("DOMContentLoaded", () => {
  const idInput = document.getElementById("id");
  const idError = document.getElementById("idError");
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

  idInput.addEventListener("blur", () => {
    const idValue = idInput.value;
    const isAlphabetic = /^[a-zA-Z]+$/.test(idValue);
    const isLengthValid = idValue.length >= 1 && idValue.length <= 10;

    if (isAlphabetic && isLengthValid) {
      idError.setAttribute("style", "color: gray;");
      delete checklist.id;
      checklist.id = idValue;
    } else {
      idError.setAttribute("style", "color: red;");
      delete checklist.id;
    }
  });

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
    if (Object.keys(checklist).length === 6) {
      fetch("process_admin_create.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `idInputValue=${encodeURIComponent(
          checklist.id
        )}&groupInputValue=${encodeURIComponent(
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
            alert("새 관리자 생성 성공");
            window.location.href = "sudpas_admin.php";
          } else {
            alert("새 관리자 생성 실패");
          }
        })
        .catch((error) => {
          console.error(error);
        });
    }
  });
});

// Aa!1BbC2
