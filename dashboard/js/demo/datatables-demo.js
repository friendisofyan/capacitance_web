// Call the dataTables jQuery plugin
$(document).ready(function() {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status =="200"){
      document.getElementById("tableKehadiran").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "includes/get_datatable.inc.php?q=", true);
  xhttp.send();
  $('#dataTable').DataTable();
});
