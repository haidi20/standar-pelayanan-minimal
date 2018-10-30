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
        {!! Form::open(['class' => 'form form-horizontal', 'id' => 'kuisioner']) !!}
        <table class="table table-bordered table-custom">
          <thead>
            <tr>
              <th class="no">No</th>
              <th>Penjelasan</th>
              <th>Isi</th>
            </tr>
          </thead>
          	<tbody id="tableSatu">
            @foreach($pertanyaanSatu as $index => $item)
      				@if($item->kondisi_keterangan)
                <tr>
                  <td class="no">{{ table_row_number($pertanyaanSatu, $nomorSatu) }}</td>
                  <td width="100%">{{ $item->keterangan }}</td>
                  <td>
                    @if($item->input_pertanyaan)
                      <input type="hidden" name="pertanyaan[]" value="{{ $item->id }}">
                      <input type="hidden" name="sekolah[]" value="{{ request('sekolah') }}">
                      <input type="text" class="form-control form" name="isi[]" value="{{ array_get($isi, $item->id) }}">
                    @elseif($item->pilihan_pertanyaan)
                      <input type="hidden" name="pertanyaan[]" value="{{ $item->id }}">
                      <input type="hidden" name="sekolah[]" value="{{ request('sekolah') }}">
                      <select class="form-control" name="isi[]">
                        <option value="1" {{ array_get($isi, $item->id) == 1 ? 'selected' : ''}}>Ya</option>
                        <option value="0" {{ array_get($isi, $item->id) == 0 ? 'selected' : ''}}>Tidak</option>
                      </select>
                    @else
                      <input type="hidden" name="isi[]">
                    @endif
                  </td>
                </tr>
                <?php $nomorSatu++ ?>
              @else
                <tr>
                  <td colspan="3" >{{$item->keterangan}}</td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
        {!! Form::close() !!}
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
              @if($item->kondisi_keterangan)
                <tr>
                  <td class="no">{{ table_row_number($pertanyaanDua, $nomorDua) }}</td>
                  <td width="100%">{{ $item->keterangan }}</td>
                  <td>
                    @if($item->input_pertanyaan)
                      <input type="text" class="form-control form" 
                           data-pertanyaan="{{ $item->id }}" 
                           data-sekolah="{{ request('sekolah') }}" 
                           name="isi[]" 
                           value="{{ array_get($isi, $item->id) }}"
                        >
                    @elseif($item->pilihan_pertanyaan)
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
                <?php $nomorDua++ ?>
              @else
                <tr>
                  <td colspan="3" >{{$item->keterangan}}</td>
                </tr>
              @endif
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