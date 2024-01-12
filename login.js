document.addEventListener("DOMContentLoaded", () => {
  const idInput = document.getElementById("id");
  const idErrorMessage = document.getElementById("idErrorMessage");
  const pwInput = document.getElementById("pw");
  const pwErrorMessage = document.getElementById("pwErrorMessage");
  const loginButtonInput = document.getElementById("loginButton");
  const duErrorMessage = document.getElementById("duErrorMessage");
  const idStoreCheckbox = document.getElementById("idStoreCheckbox");

  idInput.addEventListener("blur", () => {
    const inputValue = idInput.value;

    fetch("process_idcheck.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `inputValue=${encodeURIComponent(inputValue)}`,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("데이터베이스 연결 오류");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success === true) {
          idErrorMessage.innerHTML = "&nbsp;";
        } else {
          idErrorMessage.innerHTML = "id를 확인해주세요";
        }
      })
      .catch((error) => {
        console.error(error);
      });
  });

  pwInput.addEventListener("blur", () => {
    const idInputValue = idInput.value;
    const pwInputValue = pwInput.value;

    fetch("process_pwcheck.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `idInputValue=${encodeURIComponent(
        idInputValue
      )}&pwInputValue=${encodeURIComponent(pwInputValue)}`,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("데이터베이스 연결 오류");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success === true) {
          pwErrorMessage.innerHTML = "&nbsp;";
        } else {
          pwErrorMessage.innerHTML = "pw를 확인해주세요";
        }
      })
      .catch((error) => {
        console.error(error);
      });
  });

  loginButtonInput.addEventListener("click", () => {
    const idInputValue = idInput.value;
    const idErrorMessageValue = idErrorMessage.innerText.trim();
    const pwInputValue = pwInput.value;
    const pwErrorMessageValue = pwErrorMessage.innerText.trim();

    if (idStoreCheckbox.checked) {
      const expiryTime = new Date();
      expiryTime.setTime(expiryTime.getTime() + 365 * 24 * 60 * 60 * 1000);
      document.cookie =
        "userData=" +
        encodeURIComponent(idInputValue) +
        "; expires=" +
        expiryTime.toUTCString() +
        "; path=/";
    }

    if (
      idInputValue !== "" &&
      pwInputValue !== "" &&
      idErrorMessageValue === "" &&
      pwErrorMessageValue === ""
    ) {
      fetch("process_login.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `inputValue=${encodeURIComponent(idInputValue)}`,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("데이터베이스 연결 오류");
          }
          return response.json();
        })
        .then((data) => {
          if (data.success === true) {
            window.location.href = "sudpas.php";
          } else {
            duErrorMessage.innerHTML =
              "비활성화 처리된 id입니다. 관리자에게 문의해주세요.";
          }
        })
        .catch((error) => {
          console.error(error);
        });
    }
  });
});
