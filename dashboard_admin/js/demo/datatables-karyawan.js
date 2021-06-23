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
                    [6, 'statusPgw', '{"aktif":"aktif","keluar":"keluar"}']
                  ]
      },
      restoreButton : false,
      deleteButton : false
    });
  })

  var tabelKeluar = $('#tabelKeluar').dataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
      url : "includes/fetch_tabelKeluar.inc.php",
      type : "POST"
    }
  });

  $('#tabelKeluar').on('draw.dt', function(){
    $('#tabelKeluar').Tabledit({
      url : 'includes/action_keluar.inc.php',
      dataType : 'json',
      hideIdentifier : true,
      columns:{
        identifier : [3, 'identifier'],
        editable : [
                    [1, 'uid'],
                    [2, 'nama']
                  ]
      },
      restoreButton : false,
      editButton : false,
      onSuccess : function(data, textStatus, jqXHR){
        if(data.action == 'delete'){
          $('#' + data.id).remove;
          $('#tabelKeluar').DataTable().ajax.reload();
        }
      }
    });
  })

});