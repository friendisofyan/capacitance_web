$(document).ready(function () {
  showGraph();
});


function showGraph()
{
  
  {$.post("includes/fetch_chartData.php", { "tglAwal":"2021-05-06", "tglAkhir":"2021-05-07" },
    function (data)
    {
        console.log(data);
        var name = [];
        var marks = [];

        for (var i in data) {
            name.push(data[i].nama);
            marks.push(data[i].counter);
        }

        var chartdata = {
          labels: name,
          datasets: [{
              label: 'Jumlah kehadiran',
              backgroundColor: '#49e2ff',
              borderColor: '#46d5f1',
              hoverBackgroundColor: '#CCCCCC',
              hoverBorderColor: '#666666',
              maxBarThickness: 20,
              data: marks
          }],
        };

        var graphTarget = $("#barChartKehadiran");

        var barGraph = new Chart(graphTarget, {
            type: 'bar',
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
                xAxes: [{
                  time: {
                    unit: 'month'
                  },
                  gridLines: {
                    display: false,
                    drawBorder: false
                  },
                  ticks: {
                    maxTicksLimit: 6
                  },
                }],
                yAxes: [{
                  ticks: {
                    min: 0,
                    max: 5,
                    maxTicksLimit: 5,
                    padding: 10,
                  },
                  gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                  }
                }],
              }
            }
        });
    });
  }
}