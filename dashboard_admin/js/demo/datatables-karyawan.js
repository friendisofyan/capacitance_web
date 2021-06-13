// Call the dataTables jQuery plugin
// "use strict";
$(document).ready(function() {
  var tabelKaryawan = $('#tabelKaryawan').dataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
      url : "includes/fetch_tabelKaryawan.inc.php",
      type : "POST"
    }
  });

  $('#tabelKaryawan').on('draw.dt', function(){
    $('#tabelKaryawan').Tabledit({
      url : 'includes/action_karyawan.inc.php',
      dataType : 'json',
      columns:{
        identifier : [0, 'pgwId'],
        editable : [
                    [2, 'jabatan'],
                    [6, 'statusPgw']
                  ]
      },
      restoreButton : false,
      deleteButton : false
    });
  })

});