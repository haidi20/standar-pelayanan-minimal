@extends('_layouts.default')
@section('script-bottom')
  <script>

    function kondisi(){
      var filter = $('#filter').serialize();

      $.ajax({
        url: '{{ url('sekolah/vue') }}',
        type: 'GET',
        cache: false,
        data: filter,
        beforeSend:function(){
          // $('#proses').modal('show');
          // console.log('sedang berjalan');
        },
        complete:function(){
         // $('#proses').modal('hide');
         // console.log('selesai');
        },
        success:function(data){   
          // console.log(data);
          manageDataDropdownSekolah(data);
        },
        error:function(xhr, ajaxOptions, thrownError){
          if(thrownError === 'Unauthorized'){
            window.location.href = '{{ url('logout') }}';
          }
        }
      });
    }
    
    function kirim(){
      var tahun       = $('#tahun').val();
      var periode     = $('#periode').val();
      var sekolah     = $('#sekolah').val();
      var kecamatan   = $('#kecamatan').val();
      var pendidikan  = $('#pendidikan').val();

      var urlParameter = '?sekolah='+sekolah+'&kecamatan='+kecamatan+'&pendidikan='+pendidikan+'&tahun='+tahun+'&periode='+periode;

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
          manageDataTablePersen(data);
        },
        error:function(xhr, ajaxOptions, thrownError){
          if(thrownError === 'Unauthorized'){
            window.location.href = '{{ url('logout') }}';
          }
        }
      });
    }

    function manageDataTablePersen(data){
      var rows = '';
      // console.log(data);
      $.each(data, function(index, item){
        rows += '<tr>'+
                  '<td >'+manage_row(index)+'</td>'+
                  '<td align="center">'+item.name+'</td>'+
                  '<td align="center">'+item.value+' %</td>'+
                '</tr>';
      });

      $('#tablePersen').html(rows);
    }

    function manageDataDropdownSekolah(data){
      var rows = '';

      rows += '<option value="">Semua Sekolah</option>';
      $.each(data, function(index, item){
        rows += '<option value="'+item.id+'">'+item.nama+'</option>';
      });

      $('#sekolah').html(rows);
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
