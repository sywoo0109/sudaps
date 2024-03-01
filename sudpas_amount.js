document.addEventListener("DOMContentLoaded", () => {
  const userInput = document.getElementById("userInput");
  const userInputSave = document.getElementById("userInputSave");
  const userInputDeactivate = document.getElementById("userInputDeactivate");
  const amount1 = document.getElementById("amount1");
  const amount1Save = document.getElementById("amount1Save");
  const amount1Deactivate = document.getElementById("amount1Deactivate");
  const amount2 = document.getElementById("amount2");
  const amount2Save = document.getElementById("amount2Save");
  const amount2Deactivate = document.getElementById("amount2Deactivate");
  const amount3 = document.getElementById("amount3");
  const amount3Save = document.getElementById("amount3Save");
  const amount3Deactivate = document.getElementById("amount3Deactivate");
  const amount4 = document.getElementById("amount4");
  const amount4Save = document.getElementById("amount4Save");
  const amount4Deactivate = document.getElementById("amount4Deactivate");
  const amount5 = document.getElementById("amount5");
  const amount5Save = document.getElementById("amount5Save");
  const amount5Deactivate = document.getElementById("amount5Deactivate");
  const popup = document.getElementById("popup");
  const popupInst = document.getElementById("popupInst");
  const confirmButton = document.getElementById("confirm");
  const cancleButton = document.getElementById("cancle");
  let amount;
  let DBid;
  let task;

  userInputSave.addEventListener("click", () => {
    popupInst.innerHTML = "직접입력 한도를 저장하시겠습니까?";
    popup.style.display = "block";
    amount = userInput.value.replace(/\D/g, "");
    DBid = 1;
    task = "save";
  });

  userInputDeactivate.addEventListener("click", () => {
    popupInst.innerHTML = "직접입력을 비활성화하시겠습니까?";
    popup.style.display = "block";
    DBid = 1;
    task = "deactivate";
  });

  amount1Save.addEventListener("click", () => {
    popupInst.innerHTML = "기부금액1을 저장하시겠습니까?";
    popup.style.display = "block";
    amount = amount1.value.replace(/\D/g, "");
    DBid = 2;
    task = "save";
  });

  amount1Deactivate.addEventListener("click", () => {
    popupInst.innerHTML = "기부금액1을 비활성화하시겠습니까?";
    popup.style.display = "block";
    DBid = 2;
    task = "deactivate";
  });

  amount2Save.addEventListener("click", () => {
    popupInst.innerHTML = "기부금액2를 저장하시겠습니까?";
    popup.style.display = "block";
    amount = amount2.value.replace(/\D/g, "");
    DBid = 3;
    task = "save";
  });

  amount2Deactivate.addEventListener("click", () => {
    popupInst.innerHTML = "기부금액2를 비활성화하시겠습니까?";
    popup.style.display = "block";
    DBid = 3;
    task = "deactivate";
  });

  amount3Save.addEventListener("click", () => {
    popupInst.innerHTML = "기부금액3을 저장하시겠습니까?";
    popup.style.display = "block";
    amount = amount3.value.replace(/\D/g, "");
    DBid = 4;
    task = "save";
  });

  amount3Deactivate.addEventListener("click", () => {
    popupInst.innerHTML = "기부금액3을 비활성화하시겠습니까?";
    popup.style.display = "block";
    DBid = 4;
    task = "deactivate";
  });

  amount4Save.addEventListener("click", () => {
    popupInst.innerHTML = "기부금액4를 저장하시겠습니까?";
    popup.style.display = "block";
    amount = amount4.value.replace(/\D/g, "");
    DBid = 5;
    task = "save";
  });

  amount4Deactivate.addEventListener("click", () => {
    popupInst.innerHTML = "기부금액4를 비활성화하시겠습니까?";
    popup.style.display = "block";
    DBid = 5;
    task = "deactivate";
  });

  amount5Save.addEventListener("click", () => {
    popupInst.innerHTML = "기부금액5를 저장하시겠습니까?";
    popup.style.display = "block";
    amount = amount5.value.replace(/\D/g, "");
    DBid = 6;
    task = "save";
  });

  amount5Deactivate.addEventListener("click", () => {
    popupInst.innerHTML = "기부금액5를 비활성화하시겠습니까?";
    popup.style.display = "block";
    DBid = 6;
    task = "deactivate";
  });

  confirmButton.addEventListener("click", () => {
    fetch("process_amount.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `amountInputValue=${encodeURIComponent(
        amount
      )}&DBid=${encodeURIComponent(DBid)}&task=${encodeURIComponent(task)}`,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("데이터베이스 연결 오류");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success === true) {
          if (data.message === "Successfully change donation amount") {
            alert("기부금액 저장 성공");
          } else if (data.message === "Successfully change activated status") {
            alert("기부금액 비활성화 성공");
          }
          window.location.href = "sudpas_amount.php";
        } else {
          alert("변경 실패");
        }
      })
      .catch((error) => {
        console.error(error);
      });
  });

  cancleButton.addEventListener("click", () => {
    popup.style.display = "none";
  });
});
