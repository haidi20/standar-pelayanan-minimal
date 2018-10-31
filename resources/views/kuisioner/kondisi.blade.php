<div class="col-md-3 col-md-offset-2">
  <div class="form-group">
    <label for="pendidikan" class="form-label">Jenjang Pendidikan</label>
    <select name="pendidikan" id="pendidikan" onChange="kondisi()" class="form-control">
      <option value="">Pilih Jenjang Pendidikan</option>
      @foreach($pendidikan as $index => $item)
        <option value="{{ $item->id }}" {{ $item->id == request('pendidikan') ? 'selected' : '' }}>{{ $item->nama }}</option>
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
        <option value="{{ $item->id }}" {{ $item->id == request('kecamatan') ? 'selected' : '' }}>{{ $item->nama }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label for="sekolah" class="form-label">Sekolah</label>
    <select name="sekolah" onChange="changeSekolah()" id="sekolah" class="form-control sekolah">
      @if($sekolah)
        @foreach($sekolah as $index => $item)
          <option value="{{ $item->id }}" {{ $item->id == request('sekolah') ? 'selected' : '' }}>{{ $item->nama }}</option>
        @endforeach
      @else
        <option value="">Data Kosong</option>
      @endif
    </select>
  </div>
</div>