<div class="row">
  <div class="col-md-12">
    <table class="table table-bordered table-custom">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Sekolah</th>
          <th>jenjang</th>
          <th>Kecamatan</th>
          <th>Alamat</th>
          <th width="200px">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($dataSekolah as $index => $item)
            <tr align="center">
              <td>{{table_row_number($dataSekolah, $index)}}</td>
              <td>{{$item->nama}}</td>
              <td>{{$item->pendidikan_nama}}</td>
              <td>{{$item->kecamatan_nama}}</td>
              <td>{{$item->alamat}}</td>
              <td>
                <a href="#" class="btn btn-info btn-sm" id="modal" data-toggle="modal" data-target="#myIp2">Detail</a>
                <a href="{{route('sekolah.edit',$item->id)}}" class="btn btn-warning btn-sm">Edit</a>
                <a href="#" class="btn btn-danger btn-sm">Delete</a>
              </td>
            </tr>
        @empty
          <tr>
            <td align="center" colspan="6">Tidak Ada Data</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    {!! $dataSekolah->appends(Request::input()); !!}
  </div>
</div>
