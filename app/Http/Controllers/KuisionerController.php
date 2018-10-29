<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Pertanyaan;
use App\Models\Jawaban;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use App\Models\Pendidikan;

use Carbon\Carbon;
use Session;

class KuisionerController extends Controller
{
    public function __construct(Pertanyaan $pertanyaan, 
                                Jawaban $jawaban, 
                                Sekolah $sekolah,
                                Kecamatan $kecamatan,
                                Pendidikan $pendidikan,
                                Request $request
                            )
    {
        $this->pertanyaan   = $pertanyaan;
        $this->jawaban      = $jawaban;
        $this->sekolah      = $sekolah;
        $this->kecamatan    = $kecamatan;
        $this->pendidikan   = $pendidikan;
        $this->request      = $request;
    }

    public function index()
    {
        $kecamatan  = $this->kecamatan->get();
        $pendidikan = $this->pendidikan->get();
        $jawaban    = $this->jawaban;
        $pertanyaan = $this->pertanyaan;
        $baseUrl    = 'kuisioner';
        $sekolah    = [];
        $isi        = [];

        // return $this->request->merge(['page' => 10]);
        if(request('sekolah')){
            $sekolah = $this->sekolah->kondisi('kuisioner')->get();
        }

        foreach ($pertanyaan->get() as $index => $item) {
            $isi[$item->id] = $jawaban->kondisi($item->id, request('sekolah'))->value('isi');
        }

        $pertanyaanSatu = $pertanyaan->kondisi(1)->paginate(10);
        $pertanyaanDua = $pertanyaan->kondisi(2)->paginate(10);

        return view('kuisioner.index',compact('pertanyaanSatu', 'pertanyaanDua', 'kecamatan', 'pendidikan', 'sekolah', 'isi', 'baseUrl'));
    }

    public function tableSatu($kondisi)
    {
         $pertanyaan = $this->pertanyaan;

         // foreach ($pertanyaan->get() as $index => $item) {
            $jawaban = $this->jawaban->kondisi(request('pertanyaan'), request('sekolah'))->value('isi');
         // }
         
         $pertanyaan = $pertanyaan->kondisi(1)->limit(10)->get();

         if($kondisi == 'pertanyaan'){
            return $pertanyaan;
         }else{
            return $jawaban;
         }
    }

    public function info()
    {
        $info       = Sekolah::kondisi()
                             ->with('kecamatan')
                             ->get();
        return $info;
    }

    public function store()
    {
        $nilai          = request('nilai');
        $pertanyaan_id  = request('pertanyaan');
        $sekolah_id     = request('sekolah');
        $jawaban        = $this->jawaban->updateOrCreate(compact('sekolah_id', 'pertanyaan_id'));
        $jawaban->isi   = $nilai;
        $jawaban->created_at = Carbon::now();
        $jawaban->save();
        return $jawaban;

        // $jawaban->pertanyaan_id = $pertanyaan;  
        // $jawaban->sekolah_id    = $sekolah;
        // $
        // foreach ($jawaban as $index => $item) {
        //     // $nampung[$index] = 'isi = '.$item['isi']. ' pertanyaan = '. $item['pertanyaan'];
        //     $pertanyaan_id                  = $item['pertanyaan'];
        //     $sekolah_id                     = $item['sekolah'];
        //     $isi                            = $item['isi'];
            
        //     $inputJawaban                   = Jawaban::updateOrCreate(compact('sekolah_id', 'pertanyaan_id'));
        //     $inputJawaban->isi              = $item['isi'];
        //     $inputJawaban->created_at       = Carbon::now();
        //     $inputJawaban->save();
        // }
        // return $nampung;
    }
}
