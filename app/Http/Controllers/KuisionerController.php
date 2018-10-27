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
                                Pendidikan $pendidikan
                            )
    {
        $this->pertanyaan   = $pertanyaan;
        $this->jawaban      = $jawaban;
        $this->sekolah      = $sekolah;
        $this->kecamatan    = $kecamatan;
        $this->pendidikan   = $pendidikan;
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
        if(request('sekolah')){
            $sekolah = $this->sekolah->kondisi('kuisioner')->get();
        }

        foreach ($pertanyaan->get() as $index => $item) {
            $isi[$item->id] = $jawaban->kondisiJawaban($item->id, request('sekolah'))->value('isi');
        }

        $pertanyaan = $pertanyaan->kondisi()->paginate(10);

        return view('kuisioner.index',compact('pertanyaan', 'kecamatan', 'pendidikan', 'sekolah', 'isi', 'baseUrl'));
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
