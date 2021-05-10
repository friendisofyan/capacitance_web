<?php
  include_once("header_dashboard_admin.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Tabel Kehadiran</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Kehadiran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <div class="form-group row">
                <label for="filterTanggal" class="col-1 col-form-label">Tanggal:</label>
                <div class="col-sm-3">
                  <input class="form-control" type="date" value="2021-05-06" id="filterTanggal">
                </div>
              </div>
              <table class="table table-bordered" id="tabelKehadiran" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal</th>
                    <th>Temperatur</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                  </tr>
                </thead>
                  
              </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
  include_once("footer_dashboard_admin.php");
?>