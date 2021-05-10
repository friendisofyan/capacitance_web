// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#tabelKehadiran').dataTable({
    // "searching" : true,
    // "processing" : true,
    // "serverSide" : true,
    "ajax" : {
      url : "includes/fetch_datatable.php",
      dataSrc : ""
    }
  });
});
