document.addEventListener("DOMContentLoaded", () => {
  const idInput = document.getElementById("id");

  idInput.addEventListener("blur", () => {
    const inputValue = idInput.value;
    const errorMessage = document.getElementById("id_error_message");

    fetch("process_idcheck.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `inputValue=${encodeURIComponent(inputValue)}`,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Failed to connect to the database");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success === true) {
          errorMessage.innerHTML = "&nbsp;";
        } else {
          errorMessage.innerHTML = "id를 확인해주세요";
        }
      })
      .catch((error) => {
        console.error(error);
      });
  });

  const pwInput = document.getElementById("pw");

  pwInput.addEventListener("blur", () => {
    const idInputValue = idInput.value;
    const pwInputValue = pwInput.value;
    const errorMessage = document.getElementById("pw_error_message");

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
          throw new Error("Failed to connect to the database");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success === true) {
          errorMessage.innerHTML = "&nbsp;";
        } else {
          errorMessage.innerHTML = "pw를 확인해주세요";
        }
      })
      .catch((error) => {
        console.error(error);
      });
  });
});
