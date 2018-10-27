<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#satu" data-toggle="tab" >
        Pelayanan Pendidikan oleh Pemerintah Kota
      </a></li>
      <li class=""><a href="#dua" data-toggle="tab">
        Pelayanan Pendidikan Dasar oleh Satuan Pendidikan
      </a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade active in" id="satu">
        <table class="table table-bordered table-custom">
          <thead>
            <tr>
              <th class="no">No</th>
              <th>Penjelasan</th>
              <th>Isi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pertanyaan as $index => $item)
				<tr>
					<td>{{ table_row_number($pertanyaan, $index) }}</td>
				</tr>
            @endforeach
          </tbody>
        </table>
        <div id="paginate" onClick="changePaginate()">{!! $pertanyaan->appends(Request::input()); !!}</div>
      </div>
    </div>
    <div class="col-md-1 col-md-offset-11">
      <button type="submit" class="btn btn-md btn-success">Kirim</button>
    </div>
  </div>
</div>