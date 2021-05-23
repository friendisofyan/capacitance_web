$(document).ready(function(){
  var tabelAdmin = $('#tabelAdmin').DataTable({
    "processing" : true,
    "serverSide": true,
    "order" : [],
    "ajax" : {
      url : "includes/fetch_tabelAdmin.inc.php",
      type : "POST"
    }
  });

  $('#tabelAdmin').on('draw.dt', function(){
    $('#tabelAdmin').Tabledit({
      url : 'includes/action_admin.inc.php',
      dataType : 'json',
      columns:{
        identifier : [1, 'adminUid'],
        editable : [[0, 'adminName']]
      },
      restoreButton : false,
      onSuccess : function(data, textStatus, jqXHR){
        if(data.action == 'delete'){
          $('#' + data.id).remove;
          $('#tabelAdmin').DataTable().ajax.reload();
        }
      }
    });
  })
})