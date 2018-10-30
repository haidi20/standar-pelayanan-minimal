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
        $nomorSatu  = $this->nomor();
        $nomorDua   = $this->nomor();
        $baseUrl    = 'kuisioner';
        $sekolah    = [];
        $isi        = [];
        
        if(request('sekolah')){
            $sekolah = $this->sekolah->kondisi('kuisioner')->get();
        }

        foreach ($pertanyaan->get() as $index => $item) {
            $isi[$item->id] = $jawaban->kondisi($item->id, request('sekolah'))->value('isi');
        }

        $pertanyaanSatu = $pertanyaan->kondisi(1)->paginate(10);
        $pertanyaanDua = $pertanyaan->kondisi(2)->paginate(10);

        return view('kuisioner.index',compact('pertanyaanSatu', 'pertanyaanDua', 'kecamatan', 'pendidikan', 'sekolah', 'isi', 'baseUrl', 'nomorSatu', 'nomorDua'));
    }

    public function tableSatu($kondisi)
    {
        $pertanyaan     = $this->pertanyaan;
        $jawaban        = $this->jawaban->kondisi(request('pertanyaan'), request('sekolah'))->value('isi');
        $pertanyaan     = $pertanyaan->kondisi(1)->limit(10)->get();

         if($kondisi == 'pertanyaan'){
            return $pertanyaan;
         }else{
            return $jawaban;
         }
    }

    public function info()
    {
        $info       = Sekolah::kondisi()->with('kecamatan')->get();

        return $info;
    }

    public function store()
    {
        $input = $this->request->except('_token');

        for($i = 0; $i < count($input['isi']); $i++) {
            $isi              = $input['isi'][$i];
            $pertanyaan_id    = $input['pertanyaan'][$i];
            $sekolah_id       = $input['sekolah'][$i];
            $jawaban          = $this->jawaban->updateOrCreate(compact('sekolah_id', 'pertanyaan_id'));
            $jawaban->isi     = $isi;
            $jawaban->created_at = Carbon::now();
            $jawaban->save();
        }

        return $jawaban;
    }

    public function nomor()
    {
        $no     = 0;
        $page   = request('page');

        if(request('page') > 1){
            if($page == 5){
                return $no = $no - 2;
            }elseif($page == 6){
                return $no = $no - 4;
            }else{
                return $no = $no - 1;
            }
        }else{
            return 0;
        }
    }
}
