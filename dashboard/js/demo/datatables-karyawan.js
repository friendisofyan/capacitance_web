// Call the dataTables jQuery plugin
// "use strict";
$(document).ready(function() {
  var tabelKaryawan = $('#tabelKaryawan').dataTable({
    "serverside" : true,
    "ajax" : {
      "url" : "includes/fetch_tabelKaryawan.inc.php"
    }
  });

});