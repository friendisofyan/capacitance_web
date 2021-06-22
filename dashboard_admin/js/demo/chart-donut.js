$(document).ready(function () {
  var selector = $('#donutChartSel').val();
  
  var pgwId = getPgwId(selector);
  showGraphDonut(pgwId);

  $('#donutChartSel').on('change', function() {
    var pgwId = getPgwId($(this).val());
    window.donutGraph.destroy();
    showGraphDonut(pgwId);
  });
});

function getPgwId(selector){
  var identifier = selector.split(" - ");
  return identifier[0];
}

function showGraphDonut(pgwId)
{
  $.ajax({
    url : "/dashboard/includes/fetch_chart-donut.inc.php",
    type : "post",
    data : {
      "pgwId" : pgwId,
    },
    success: function(data){
      console.log(data);
      var dataset = [];

      dataset.push(data.hadir);
      dataset.push(data.izin);
      dataset.push(data.absen);

      var chartdata = {
          labels: ["Hadir", "Sakit/Izin", "Absen"],
          datasets: [{
            data: dataset,
            backgroundColor: ['#1cc88a', '#FFE22B', '#F53737'],
            hoverBackgroundColor: ['#17a673', '#ECD127', '#D6301D'],
          }],
        };

      var graphTarget = $("#donutChartKehadiran");

      window.donutGraph = new Chart(graphTarget, {
        type: 'doughnut',
        data: chartdata,
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
          },
          legend: {
            display: true
          },
          cutoutPercentage: 80,
        }
      });
    }
  })
}