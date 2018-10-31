@extends('_layouts.default')
@section('script-bottom')
<script>  
  $(function(){
    var href = $('#paginate ul li a');
    href.each(function(){
      page = $(this).html()
      var tab = $('#tab').val()
      $(this).attr("href", 'javascript:void(0)')
      $(this).attr('onClick', 'store('+page+' , '+tab+')')
    });
    
    // tab di dapatkan dari input yang terhidden //
    var tab = $('#tab').val()
    if (tab == 1){
      $('#satu').addClass('active')
      $('#linkSatu').addClass('active')
    }else{
      $('#dua').addClass('active')
      $('#linkDua').addClass('active')
    }

    var page = {{ request('page') ? request('page') : 0 }}
    if(page > 2){
      changeTableSatu(page)
    }
  });

  function changeTableSatu(page)
  {
    $.ajax({
        url: '{{ url('kuisioner/table-satu/pertanyaan') }}',
        type: 'GET',  
        cache: false,
        success:function(data){          
          manageDataTableSatu(data);
        },
        error:function(xhr, ajaxOptions, thrownError){
          if(thrownError === 'Unauthorized'){

          }
        }
      });
  }

  // setiap pindah paginate dan tombol kirim akan ke fungsi store //  
  function store(page, tab = null)
  {
    var kecamatan  = $('#kecamatan').val();
    var pendidikan = $('#pendidikan').val();
    var sekolah    = $('#sekolah').val();
    var kuisioner  = $('#kuisioner').serialize();

    var urlParameter  = '?sekolah='+sekolah+'&kecamatan='+kecamatan+'&pendidikan='+pendidikan+'&page='+page+'&tab='+tab

    console.log(urlParameter)

    $.ajax({
      url: '{{ url('kuisioner/store') }}',
      type: 'POST',
      cache: false,
      data: kuisioner,
      success:function(data){ 
        window.location.href = '{{url($baseUrl)}}'+urlParameter;
      },
      error:function(xhr, ajaxOptions, thrownError){
        window.location.href = '{{url($baseUrl)}}'+urlParameter;
      }
    });
  }

  // filtering data  //
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
        success:function(data){ 
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

  // memunculkan pilihan sekolah jika pendidikan dan kecamatan sudah di pilih //
  function manageDataDropdownSekolah(data)
  {
    var rows = '';

    if(data){
      rows += '<option value="">Semua Sekolah</option>';
      $.each(data, function(index, item){
        rows += '<option value="'+item.id+'">'+item.nama+'</option>';
      });
    }else{
      rows += '<option>Data Kosong</option>';
      $('#oke').attr('disabled', 'true')
    }

    $('#sekolah').html(rows);
  }

  // kalo di tab 2 berada di page > 2 maka di tab 1 automatis di page 1 //
  function manageDataTableSatu(data)
  {
    var rows = '';
    var nomor = 0;

    $.each(data, function(index, item){
      if(item.tanya == 1){
         rows += '<tr>'+
                    '<td>'+manage_row(nomor)+'</td>'+
                    '<td>'+item.keterangan+'</td>'+
                    '<td> <input type="text" id="pertanyaan_'+item.id+'" class="form-control form"'+
                         'data-pertanyaan="'+item.id+'" data-sekolah="{{ request('sekolah') }}"'+
                         'name="isi[]" value=""></td>'+
                  '</tr>';
        nomor++;
      }else{
        rows += '<tr>'+
                  '<td colspan="3">'+item.keterangan+'</td>'+
                '</tr>';
      }

      fetchIsi(item.id)

    });

    $('#tableSatu').html(rows);
  }

  // memasukkan nilai berdasarkan pertanyaan *berhubungan dengan fungsi manageDataTableSatu //
  function fetchIsi(pertanyaan)
  {
    var sekolah = {{request('sekolah') ? request('sekolah') : 0}} ;
    var isi;
    $.ajax({
        url: '{{ url('kuisioner/table-satu/jawaban') }}',
        type: 'GET',  
        cache: false,
        data: {pertanyaan:pertanyaan, sekolah:sekolah},
        success:function(data){
          isi = data != null ? data : 0 ;
          $('#pertanyaan_'+pertanyaan).val(isi)
        },
      });
  }

  // kondisi dropdown sekolah kalo ada nilai maka disabled hilang //
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
    $('#tab').val(tab)
    var tab = $('#tab').val()

    var href = $('#paginate ul li a');
    href.each(function(){
      page = $(this).html()
      $(this).attr("href", 'javascript:void(0)')
      $(this).attr('onClick', 'store('+page+' , '+tab+')')
    });
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
