$(document).ready(function () {
  var awal = $("#tglAwal").val();
  var akhir = $("#tglAkhir").val();
  showGraph(awal, akhir);

  $('#tglAwal, #tglAkhir').change(function(){
    window.barGraph.destroy();
    showGraph($("#tglAwal").val(), $("#tglAkhir").val());
  });
});


function showGraph(tglAwal, tglAkhir)
{
  $.ajax({
    url : "includes/fetch_chartBar.inc.php",
    type : "post",
    data : {
      "tglAwal" : tglAwal,
      "tglAkhir" : tglAkhir
    },
    success: function(data){
      var name = [];
      var counter = [];

      for (var i in data) {
          name.push(data[i].nama);
          counter.push(data[i].counter);
      }

      var chartdata = {
        labels: name,
        datasets: [{
          label: 'Jumlah kehadiran',
          backgroundColor: '#074BE9',
          hoverBackgroundColor: '#2183FF',
          maxBarThickness: 20,
          data: counter
        }],
      };

      var graphTarget = $("#barChartKehadiran");

      window.barGraph = new Chart(graphTarget, {
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
            x: {
              time: {
                unit: 'day'
              },
              grid: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 6
              },
            },
            y: {
              ticks: {
                min: 0,
                // max: 30,
                maxTicksLimit: 5,
                padding: 10,
              },
              grid: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
              }
            },
          }
        }
      });
    }
  })
}
