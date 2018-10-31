@extends('_layouts.default')

@section('script-bottom')
<script>
  function kondisi()
  {
    var kecamatan   = $('#kecamatan').val()
    var pendidikan  = $('#pendidikan').val()

    $.ajax({
      url: '{{ url('sekolah/vue') }}',
      type: 'GET',
      cache: false,
      data: {kecamatan:kecamatan, pendidikan:pendidikan},
      success:function(data){ 
        manageDataDropdownSekolah(data);
      },
      error:function(xhr, ajaxOptions, thrownError){
        if(thrownError === 'Unauthorized'){
          window.location.href = '{{ url('logout') }}';
        }
      }
    });
  }

  function manageDataDropdownSekolah(data)
  {
    var rows = '';

    rows += '<option value="">Semua Sekolah</option>';
    
    $.each(data, function(index, item){
      rows += '<option value="'+item.id+'">'+item.nama+'</option>';
    });

    $('#sekolah').html(rows);
  }
</script>
@endsection

@section('konten')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>Daftar Sekolah</h1>
      </div>
      <div class="col-md-6 text-right tombol-atas">
        <a href="{{route('sekolah.create')}}" class="btn btn-success btn-md">Tambah</a>
      </div>
    </div>
    <hr class="dashed mt20 mb20">
    <div class="row">
      <form action="{{route('sekolah.index')}}" method="get">
        @include('sekolah.kondisi')
        <div class="col-md-1 oke">
          <button type="submit" class="btn btn-success btn-md">Oke</button>
        </div>
      </form>
    </div>
    <br>
    @include('sekolah.table')
  </div>
@endsection
