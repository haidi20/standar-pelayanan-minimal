<div class="row">
    {!! Form::open(['class' => 'form form-horizontal', 'id' => 'form-pr']) !!}
      <div class="col-md-4">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="tahun" class="form-label">Tahun</label>
            <select name="tahun" id="tahun" class="form-control">
              <option value="">Pilih Tahun</option>
              @foreach($tahun as $index => $item)
                <option value="{{ $item }}" {{ request('tahun') == $item ? 'selected' : '' }}>{{ $item }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="periode" class="form-label">Periode</label>
            <select name="periode" id="periode" class="form-control">
              <option value="">Pilih Periode</option>
              <option value="1">January - Juni</option>
              <option value="2">Juli - Desember</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="pendidikan" class="form-label">Jenjang Pendidikan</label>
            <select name="pendidikan" id="pendidikan" class="form-control">
              <option value="">Semua Jenjang Pendidikan</option>
              @foreach($pendidikan as $index => $item)
                <option value="{{ $item->id }}" {{request('pendidikan') == $item->id ? 'selected' : ''}}>{{ $item->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <select name="kecamatan" id="kecamatan" class="form-control">
              <option value="">Kota Samarinda</option>
               @foreach($kecamatan as $index => $item)
                  <option value="{{ $item->id }}" {{request('kecamatan') == $item->id ? 'selected' : ''}}>{{ $item->nama }}</option>
                @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="sekolah" class="form-label">Sekolah</label>
            <select name="sekolah" id="sekolah" class="form-control">
              <option value="">Semua Sekolah</option>
              @foreach($sekolah as $index => $item)
                <option value="{{ $item->id }}" {{request('sekolah') == $item->id ? 'selected' : ''}}>{{ $item->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-1 col-md-offset-9">
          <button type="button" class="btn btn-md btn-success" onClick="kirim()">Oke</button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
    <div class="col-md-8">
      <table class="table table-bordered table-custom">
        <thead>
          <tr>
            <th class="no">No</th>
            <th>Indikator Pencapaian (IP)</th>
            <th class="action">Persen</th>
          </tr>
        </thead>
        <tbody id="tablePersen">
         @foreach($ip as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td align="center">{{ $ip[$index] }}</td>
              <td></td>
            </tr>
         @endforeach
        </tbody>
      </table>
    </div>
  </div>