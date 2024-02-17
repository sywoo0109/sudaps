const methodUrlParams = new URLSearchParams(window.location.search);
const methodYearParam = methodUrlParams.get("method");
const methodDefaultYear = new Date().getFullYear();
const methodYearParamValue = methodYearParam
  ? parseInt(methodYearParam)
  : methodDefaultYear;

document.addEventListener("DOMContentLoaded", () => {
  const methodChartYearInput = document.getElementById("methodChartYear");

  methodChartYearInput.addEventListener("change", () => {
    yearValue = methodChartYearInput.value;

    if (!isNaN(parseFloat(yearValue)) && isFinite(yearValue)) {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set("method", yearValue);
      const newUrl = window.location.pathname + "?" + urlParams.toString();
      window.location.href = newUrl;
    }
  });
});

fetch("lib/process_methodChart.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
  },
  body: `methodYearInputValue=${encodeURIComponent(methodYearParamValue)}`,
})
  .then((response) => {
    if (!response.ok) {
      throw new Error("데이터베이스 연결 오류");
    }
    return response.json();
  })
  .then((data) => {
    if (data.success === true) {
      const methodData = Object.values(data.message).map((value) =>
        parseInt(value)
      );

      const chartData = {
        labels: [
          "카카오페이",
          "네이버페이",
          "애플페이",
          "삼성페이",
          "신용/체크카드",
          "휴대폰",
        ],
        datasets: [
          {
            data: methodData,
            backgroundColor: [
              "#FFEB00",
              "#2DB400",
              "#8E8E93",
              "#14259A",
              "#FFA600",
              "#1C1C1E",
            ],
          },
        ],
      };

      const options = {
        plugins: {
          legend: {
            display: true,
            position: "right",
          },
        },
      };

      const ctx = document.getElementById("myChart").getContext("2d");
      const myChart = new Chart(ctx, {
        type: "pie",
        data: chartData,
        options: options,
      });
    }
  })
  .catch((error) => {
    console.error(error);
  });
