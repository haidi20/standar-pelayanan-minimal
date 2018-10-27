<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-tabs">
      <li class="" id="linkSatu" onClick="changeTab(1)"><a href="#satu" data-toggle="tab" >
        Pelayanan Pendidikan oleh Pemerintah Kota
      </a></li>
      <li class="" id="linkDua" onClick="changeTab(2)"><a href="#dua" data-toggle="tab">
        Pelayanan Pendidikan Dasar oleh Satuan Pendidikan
      </a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade in" id="satu">
        <table class="table table-bordered table-custom">
          <thead>
            <tr>
              <th class="no">No</th>
              <th>Penjelasan</th>
              <th>Isi</th>
            </tr>
          </thead>
          	<tbody>
            @foreach($pertanyaanSatu as $index => $item)
      				<tr>
      					<td class="no">{{ table_row_number($pertanyaanSatu, $index) }}</td>
      					<td width="100%">{{ $item->keterangan }}</td>
      					<td>
      						@if($item->pilihan == 0)
      							<input type="text" class="form-control form" 
      								   data-pertanyaan="{{ $item->id }}" 
      								   data-sekolah="{{ request('sekolah') }}" 
      								   name="isi[]" 
      								   value="{{ array_get($isi, $item->id) }}"
      						    >
      						@elseif($item->pilihan == 1)
      							<select class="form-control" 
      									data-pertanyaan="{{ $item->id }}" 
      								    data-sekolah="{{ request('sekolah') }}" 
      								    name="isi[]" 
      							>
                      <option value="1" {{ array_get($isi, $item->id) == 1 ? 'selected' : ''}}>Ya</option>
                      <option value="0" {{ array_get($isi, $item->id) == 0 ? 'selected' : ''}}>Tidak</option>
                    </select>
	                @else
	                	<input type="hidden" name="isi[]">
      						@endif
      					</td>
      				</tr>
            @endforeach
          </tbody>
        </table>
        <div id="paginate">{!! $pertanyaanSatu->appends(Request::input()); !!}</div>
      </div>
      <div class="tab-pane fade in" id="dua">
        <table class="table table-bordered table-custom">
          <thead>
            <tr>
              <th class="no">No</th>
              <th>Penjelasan</th>
              <th>Isi</th>
            </tr>
          </thead>
            <tbody>
            @foreach($pertanyaanDua as $index => $item)
              <tr>
                <td class="no">{{ table_row_number($pertanyaanDua, $index) }}</td>
                <td width="100%">{{ $item->keterangan }}</td>
                <td>
                  @if($item->pilihan == 0)
                    <input type="text" class="form-control form" 
                         data-pertanyaan="{{ $item->id }}" 
                         data-sekolah="{{ request('sekolah') }}" 
                         name="isi[]" 
                         value="{{ array_get($isi, $item->id) }}"
                      >
                  @elseif($item->pilihan == 1)
                    <select class="form-control" 
                        data-pertanyaan="{{ $item->id }}" 
                          data-sekolah="{{ request('sekolah') }}" 
                          name="isi[]" 
                    >
                      <option value="1" {{ array_get($isi, $item->id) == 1 ? 'selected' : ''}}>Ya</option>
                      <option value="0" {{ array_get($isi, $item->id) == 0 ? 'selected' : ''}}>Tidak</option>
                    </select>
                  @else
                    <input type="hidden" name="isi[]">
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div id="paginate">{!! $pertanyaanDua->appends(Request::input()); !!}</div>
      </div>
    </div>
  <div class="col-md-1 col-md-offset-11">
    <button type="submit" class="btn btn-md btn-success">Kirim</button>
  </div>
</div>