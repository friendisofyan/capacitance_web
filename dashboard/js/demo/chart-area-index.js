$(document).ready(function () {
  showGraphArea(pgwId);
});


function showGraphArea()
{
  $.ajax({
    url : "includes/fetch_chart-area.inc.php",
    type : "post",
    data : {
      "pgwId" : pgwId,
    },
    success: function(data){
      console.log(data);
      var x = [];
      var y = [];

      for (var i in data) {
          x.push(data[i].bulan);
          y.push(data[i].persen);
      }

      var chartdata = {
        labels: x,
        datasets: [{
          label: "Kehadiran",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.05)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: y,
        }],
      };

      var graphTarget = $("#areaChartKehadiranIndex");

      window.areaGraph = new Chart(graphTarget, {
        type: 'line',
        data: chartdata,
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            x: {
              time: {
                unit: 'date'
              },
              grid: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 10
              }
            },
            y: {
              ticks: {
                maxTicksLimit: 10,
                padding: 10,
                // Include a percent sign in the ticks
                callback: function(value, index, values) {
                  return value + '%';
                }
              },
              grid: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
              }
            },
          },
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  var label = context.dataset.label || '';

                  if (label) {
                    label += ': ';
                  }
                  if (context.parsed.y !== null) {
                    label += context.parsed.y + '%';
                  }
                  return label;
                }
              }
            }
          }
        }
      });
    }
  })
}

Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';