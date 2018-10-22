@extends('_layouts.default')
@section('script-bottom')
  <script>
    function kirim(){
      var tahun       = $('#tahun').val();
      var sekolah     = $('#sekolah').val();
      var kecamatan   = $('#kecamatan').val();
      var pendidikan  = $('#pendidikan').val();


      var urlParameter = '?sekolah='+sekolah+'&kecamatan='+kecamatan+'&pendidikan='+pendidikan+'&tahun='+tahun;

      $.ajax({
        url: '{{ url('dashboard/persen') }}'+urlParameter,
        type: 'GET',
        cache: false,
        beforeSend:function(){
          $('#proses').modal('show');
          // console.log('sedang berjalan');
        },
        complete:function(){
         $('#proses').modal('hide');
         // console.log('selesai');
        },
        success:function(data){   
          // console.log(data);
          manageData(data);
        },
        error:function(xhr, ajaxOptions, thrownError){
          if(thrownError === 'Unauthorized'){
            window.location.href = '{{ url('logout') }}';
          }
        }
      });
    }

    function manageData(data){
      var rows = '';

      // console.log(data);

      $.each(data, function(index, item){
        rows += '<tr>'+
                      '<td >'+manage_row(index)+'</td>'+
                      '<td align="center">'+item.name+'</td>'+
                      '<td align="center">'+item.value+' %</td>'+
                    '</tr>';
        // console.log(item);
      });

      $('#tablePersen').html(rows);
    }

    function manage_row(index)
    {
        return index + 1;
    }
  </script>
@endsection
@section('konten')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Dashboard Admin</h1>
      </div>
    </div>
    <hr class="dashed mb20 mt20">
    <div class="row">
      <div class="col-md-3">
        <a href="#">Download Panduan Aplikasi</a>
      </div>
      <div class="col-md-3">
        <a href="#">Penjelasan Indikator Pencapaian</a>
      </div>
      <div class="col-md-4">
        <p><a href="#">Jumlah Sekolah</a> 36</p>
      </div>
    </div>
    <br>
    @include('dashboard.table')
    @include('dashboard.modal')
  </div>
@endsection
