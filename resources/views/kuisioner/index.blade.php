@extends('_layouts.default')
@section('script-bottom')
<script>  
  $(function(){
    var href = $('#paginate ul li a');
    href.each(function(){
      no = $(this).html()
      // console.log(no)
      $(this).attr('href', '#')
      $(this).attr('onClick', 'changePaginate('+no+')')
    });
    
    var tab = $.session.get('tab')
    if (tab == 1){
      $('#satu').addClass('active')
      $('#linkSatu').addClass('active')
    }else{
      $('#dua').addClass('active')
      $('#linkDua').addClass('active')
    }
  });

  function changePaginate(id, tab = null)
  {
    var kecamatan     = $('#kecamatan').val();
    var pendidikan    = $('#pendidikan').val();
    var sekolah       = $('#sekolah').val();
    var urlParameter  = '?sekolah='+sekolah+'&kecamatan='+kecamatan+'&pendidikan='+pendidikan+'&page='+id;
    
    console.log(id)
    $('input[name="isi[]"]').map(function(){
      var pertanyaan  = $(this).attr('data-pertanyaan')
      var nilai       = this.value
      var sekolah     = $(this).attr('data-sekolah')

      // console.log('id = ' + id + ' nilai = '+nilai + ' pertanyaan = '+pertanyaan+ ' sekolah = '+ sekolah );

      $.ajax({
        url: '{{ url('kuisioner/store') }}',
        type: 'GET',
        cache: false,
        data: {nilai:nilai, pertanyaan:pertanyaan, sekolah:sekolah},
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
          // manageDataDropdownSekolah(data);
          window.location.href='{{url($baseUrl)}}'+urlParameter;
        },
        error:function(xhr, ajaxOptions, thrownError){
          window.location.href='{{url($baseUrl)}}'+urlParameter;
          if(thrownError === 'Unauthorized'){

          }
        }
      });
    }).get();
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
        data: {kecamatan:kecamatan, pendidikan:pendidikan},
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

  function changeSekolah()
  {
    var sekolah = $('#sekolah').val();

    if(sekolah){
      $('#oke').prop('disabled', false)
    }else{
      $('#oke').prop('disabled', true)
    }
  }

  function changeTab(tab)
  {
    var nomor = $.session.set('tab', tab);
    // console.log($.session.get('tab'));
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
