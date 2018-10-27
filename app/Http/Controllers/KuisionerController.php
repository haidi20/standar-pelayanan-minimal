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
        $pertanyaan = $this->pertanyaan->kondisi()->paginate();

        return view('kuisioner.index',compact('pertanyaan', 'kecamatan', 'pendidikan'));
    }

    public function info()
    {
        $info       = Sekolah::kondisi()
                             ->with('kecamatan')
                             ->get();
        return $info;
    }

    public function pertanyaan()
    {
        $pertanyaan = Pertanyaan::kondisi()
                                ->with('jawaban')
                                ->paginate(10);

        return $pertanyaan ;
    }

    public function jawaban()
    {
        $jawaban = pertanyaan::kondisiJawaban()
                             ->get();
        return $jawaban;
    }

    public function store()
    {
        $nampung = [];
        $jawaban = request()->input('jawaban');

        foreach ($jawaban as $index => $item) {
            // $nampung[$index] = 'isi = '.$item['isi']. ' pertanyaan = '. $item['pertanyaan'];
            $pertanyaan_id                  = $item['pertanyaan'];
            $sekolah_id                     = $item['sekolah'];
            $isi                            = $item['isi'];
            
            $inputJawaban                   = Jawaban::updateOrCreate(compact('sekolah_id', 'pertanyaan_id'));
            $inputJawaban->isi              = $item['isi'];
            $inputJawaban->created_at       = Carbon::now();
            $inputJawaban->save();
        }
        // return $nampung;
    }
}
