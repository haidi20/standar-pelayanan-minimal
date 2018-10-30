<div>
    <div class="col-md-3 col-md-offset-2">
      <div class="form-group">
        <label for="pendidikan">Jenjang Pendidikan</label>
        <select name="pendidikan" id="pendidikan" class="form-control">
          <option value="">Semua Jenjang Pendidikan</option>
          @foreach($pendidikan as $index => $item)
            <option value="{{ $item->id }}" {{ $item->id == request('pendidikan') ? 'selected' : '' }}>{{ $item->nama }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="kecamatan">Kecamatan</label>
        <select name="kecamatan" id="kecamatan" class="form-control">
          <option value="">Semua Kecamatan</option>
          @foreach($kecamatan as $index => $item)
            <option value="{{ $item->id }}" {{ $item->id == request('kecamatan') ? 'selected' : '' }}>{{ $item->nama }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="sekolah">Sekolah</label>
        <select name="sekolah" id="sekolah" class="form-control">
          <option value="">Semua Sekolah</option>
          @foreach($filterSekolah as $index => $item)
            <option value="{{ $item->id }}" {{ $item->id == request('sekolah') ? 'selected' : '' }}>{{ $item->nama }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>