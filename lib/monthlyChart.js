const urlParams = new URLSearchParams(window.location.search);
const yearParam = urlParams.get("year");
const defaultYear = new Date().getFullYear();
const yearParamValue = yearParam ? parseInt(yearParam) : defaultYear;

document.addEventListener("DOMContentLoaded", () => {
  const monthlyChartYearInput = document.getElementById("monthlyChartYear");

  monthlyChartYearInput.addEventListener("change", () => {
    yearValue = monthlyChartYearInput.value;

    if (!isNaN(parseFloat(yearValue)) && isFinite(yearValue)) {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set("year", yearValue);
      const newUrl = window.location.pathname + "?" + urlParams.toString();
      window.location.href = newUrl;
    }
  });
});

fetch("lib/process_monthlyChart.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
  },
  body: `yearInputValue=${encodeURIComponent(yearParamValue)}`,
})
  .then((response) => {
    if (!response.ok) {
      throw new Error("데이터베이스 연결 오류");
    }
    return response.json();
  })
  .then((data) => {
    if (data.success === true) {
      const donationData = Object.values(data.message).map((value) =>
        parseInt(value)
      );

      const chartData = {
        labels: [
          "1월",
          "2월",
          "3월",
          "4월",
          "5월",
          "6월",
          "7월",
          "8월",
          "9월",
          "10월",
          "11월",
          "12월",
        ],
        datasets: [
          {
            label: "기부 금액",
            backgroundColor: "#002c77",
            data: donationData,
          },
        ],
      };

      const options = {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
        plugins: {
          legend: {
            display: false,
          },
        },
        maintainAspectRatio: false,
      };

      const ctx = document.getElementById("myBarChart").getContext("2d");
      const myBarChart = new Chart(ctx, {
        type: "bar",
        data: chartData,
        options: options,
      });
    }
  })
  .catch((error) => {
    console.error(error);
  });
