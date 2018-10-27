<div class="row">
  {!! Form::open(['class' => 'form form-horizontal', 'id' => 'filter']) !!}
  <div class="col-md-3 col-md-offset-1">
    <div class="form-group">
      <label for="pendidikan" class="form-label">Jenjang Pendidikan</label>
      <select name="pendidikan" id="pendidikan" onChange="kondisi()" class="form-control">
        <option value="">Pilih Jenjang Pendidikan</option>
        @foreach($pendidikan as $index => $item)
          <option value="{{ $item->id }}">{{ $item->nama }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="kecamatan" class="form-label">Kecamatan</label>
      <select name="kecamatan" id="kecamatan" onChange="kondisi()" class="form-control">
        <option value="">Pilih Kecamatan</option>
         @foreach($kecamatan as $index => $item)
          <option value="{{ $item->id }}">{{ $item->nama }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="sekolah" class="form-label">Sekolah</label>
      <select name="sekolah" onChange="changeSekolah()" id="sekolah" class="form-control">
        <option value="">Data Kosong</option>
      </select>
    </div>
  </div>
  <div class="col-md-1 text-right">
    <button type="button" id="oke" onClick="filter()" disabled class="btn btn-md btn-success oke">Oke</button>
  </div>
  {!! Form::close() !!}
</div>