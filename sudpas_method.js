document.addEventListener("DOMContentLoaded", () => {
  const kakao = document.getElementById("kakao");
  const naver = document.getElementById("naver");
  const apple = document.getElementById("apple");
  const samsung = document.getElementById("samsung");
  const card = document.getElementById("card");
  const phone = document.getElementById("phone");
  const popup = document.getElementById("popup");
  const popupInst = document.getElementById("popupInst");
  const confirmButton = document.getElementById("confirm");
  const cancleButton = document.getElementById("cancle");
  let DBid;

  kakao.addEventListener("click", () => {
    if (kakao.className === "activated") {
      popupInst.innerHTML = "'카카오페이'를 비활성화<br/>하시겠습니까?";
    } else {
      popupInst.innerHTML = "'카카오페이'를 활성화<br/>하시겠습니까?";
    }
    popup.style.display = "block";
    DBid = 1;
  });

  naver.addEventListener("click", () => {
    if (naver.className === "activated") {
      popupInst.innerHTML = "'네이버페이'를 비활성화<br/>하시겠습니까?";
    } else {
      popupInst.innerHTML = "'네이버페이'를 활성화<br/>하시겠습니까?";
    }
    popup.style.display = "block";
    DBid = 2;
  });

  apple.addEventListener("click", () => {
    if (apple.className === "activated") {
      popupInst.innerHTML = "'애플페이'를 비활성화<br/>하시겠습니까?";
    } else {
      popupInst.innerHTML = "'애플페이'를 활성화<br/>하시겠습니까?";
    }
    popup.style.display = "block";
    DBid = 3;
  });

  samsung.addEventListener("click", () => {
    if (samsung.className === "activated") {
      popupInst.innerHTML = "'삼성페이'를 비활성화<br/>하시겠습니까?";
    } else {
      popupInst.innerHTML = "'삼성페이'를 활성화<br/>하시겠습니까?";
    }
    popup.style.display = "block";
    DBid = 4;
  });

  card.addEventListener("click", () => {
    if (card.className === "activated") {
      popupInst.innerHTML = "'신용/체크카드'를 비활성화<br/>하시겠습니까?";
    } else {
      popupInst.innerHTML = "'신용/체크카드'를 활성화<br/>하시겠습니까?";
    }
    popup.style.display = "block";
    DBid = 5;
  });

  phone.addEventListener("click", () => {
    if (phone.className === "activated") {
      popupInst.innerHTML = "'휴대폰'를 비활성화<br/>하시겠습니까?";
    } else {
      popupInst.innerHTML = "'휴대폰'를 활성화<br/>하시겠습니까?";
    }
    popup.style.display = "block";
    DBid = 6;
  });

  confirmButton.addEventListener("click", () => {
    fetch("process_method.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `methodInputValue=${encodeURIComponent(DBid)}`,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("데이터베이스 연결 오류");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success === true) {
          alert("활성화 여부 변경 성공");
          window.location.href = "sudpas_method.php";
        } else {
          alert("활성화 여부 변경 실패");
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
