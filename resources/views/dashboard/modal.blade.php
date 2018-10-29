<div id="myIp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Penjelasan Indikator Pencapaian (IP)</h4>
      </div>
      <div class="modal-body">
        <p>Jumlah Kelompok permukiman permanen yang sudah dilayani SD/MI dalam jarak kurang dari 3 KM.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Oke</button>
      </div>
    </div>
  </div>
</div>

<div id="myPersen" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Penjelasan Jumlah sekolah pada IP :</h4>
      </div>
      <div class="modal-body">
        <table class="table" style="border:none">
          <tbody>
            <tr>
              <td id="modal" data-toggle="modal" data-target="#myDetailLolos">Jumlah sekolah sudah memenuhi IP 1</td>
              <td>:</td>
              <td v-for="data in modal"></td>
            </tr>
            <tr>
              <td id="modal" data-toggle="modal" data-target="#myDetailTidak">Jumlah sekolah belum memenuhi IP 1</td>
              <td>:</td>
              <td v-for="data in modal"></td>
            </tr>
            <tr>
              <td>Jumlah sekolah di Kota Samarinda</td>
              <td>:</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Oke</button>
      </div>
    </div>
  </div>
</div>

<div id="myDetailLolos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          Daftar sekolah sudah memenuhi syarat IP :
        </h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-custom">
          <thead>
            <tr>
              <th class="no">No</th>
              <th>Nama Sekolah</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Oke</button>
      </div>
    </div>
  </div>
</div>

<div id="myDetailTidak" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          Daftar sekolah belum memenuhi syarat IP :
        </h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-custom">
          <thead>
            <tr>
              <th class="no">No</th>
              <th>Nama Sekolah</th>
            </tr>
          </thead>
          <tbody v-for="data in modal">
            <tr>
              <td>1</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Oke</button>
      </div>
    </div>
  </div>
</div>

<div id="proses" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
        <h4 class="modal-title">Loading</h4>
      </div>
      <div class="modal-body">
        <p>Loading sedang berjalan</p>
      </div>
    </div>
  </div>
</div>