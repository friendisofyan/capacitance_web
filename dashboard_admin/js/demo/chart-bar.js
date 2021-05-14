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
    url : "includes/fetch_chartBar.php",
    type : "post",
    data : {
      "tglAwal" : tglAwal,
      "tglAkhir" : tglAkhir
    },
    success: function(data){
      console.log(data);
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
          backgroundColor: '#49e2ff',
          borderColor: '#46d5f1',
          hoverBackgroundColor: '#CCCCCC',
          hoverBorderColor: '#666666',
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
            xAxes: [{
              time: {
                unit: 'day'
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
                // max: 30,
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
    }
  })
}