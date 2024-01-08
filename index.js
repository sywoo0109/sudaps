document.addEventListener("DOMContentLoaded", () => {
  const idInput = document.getElementById("id");

  idInput.addEventListener("blur", () => {
    const inputValue = idInput.value;
    const isKorean = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/.test(inputValue);
    const isMaxLength = inputValue.length <= 10;
    const errorMessage = document.getElementById("id_error_message");

    errorMessage.innerHTML =
      isKorean || !isMaxLength ? "id를 확인해주세요" : "&nbsp;";
  });

  const pwInput = document.getElementById("pw");

  pwInput.addEventListener("input", () => {
    const inputValue = pwInput.value;
    const isKorean = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/.test(inputValue);
    const isMaxLength = inputValue.length <= 10;
    const hasUpperCase = /[A-Z]/.test(inputValue);
    const hasSpecialChar = /[^\w]/.test(inputValue);
    const errorMessage = document.getElementById("pw_error_message");

    if (isKorean || !isMaxLength || !hasUpperCase || !hasSpecialChar) {
      errorMessage.innerHTML = "pw를 확인해주세요";
    } else {
      errorMessage.innerHTML = "&nbsp;";
    }
  });
});
