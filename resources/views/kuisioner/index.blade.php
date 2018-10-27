@extends('_layouts.default')
@section('script-bottom')
<script>
  $(function(){
    var href = $('#paginate ul li a');
    href.each(function(){
      var changeHref = $(this).attr('href') + '&tab=1';
      // console.log($(this).attr('href', changeHref));
    });
  });

  function filter()
  {
    var filter = $('#filter').serialize();

    console.log(filter);
  }

  function kondisi()
  {
    var kecamatan   = $('#kecamatan').val();
    var pendidikan  = $('#pendidikan').val();

    if(kecamatan && pendidikan){
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
    }else{
      manageDataDropdownSekolah(false)
    }
  }

  function manageDataDropdownSekolah(data)
  {
    var rows = '';

    if(data){
      rows += '<option value="">Semua Sekolah</option>';
      $.each(data, function(index, item){
        rows += '<option value="'+item.id+'">'+item.nama+'</option>';
      });
      // $('#oke').removeAttr('disabled')
    }else{
      rows += '<option>Data Kosong</option>';
      $('#oke').attr('disabled', 'true')
    }

    $('#sekolah').html(rows);
  }

  function changeSekolah(){
    var sekolah = $('#sekolah').val()
    if(sekolah){
      $('#oke').prop('disabled', false)
    }else{
      $('#oke').prop('disabled', true)
    }
  }
</script>
@endsection
@section('konten')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Input Data</h1>
      </div>
    </div>
    <hr class="dashed mt20 mb20">
    {{-- @include('kuisioner.info') --}}
    <br>
    {{-- <kuisioner></kuisioner> --}}
    @include('kuisioner.filter')
    @include('kuisioner.form')
  </div>
@endsection
