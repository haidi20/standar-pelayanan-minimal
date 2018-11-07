<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Jawaban;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use App\Models\Pendidikan;

use App\Supports\IndikatorPencapaian;
use App\Supports\Rumus;

use Carbon\Carbon;

class DashboardController extends Controller
{
    function __construct(
                          IndikatorPencapaian $ip, 
                          Jawaban $jawaban, 
                          Sekolah $sekolah,
                          Kecamatan $kecamatan,
                          Pendidikan $pendidikan,
                          Rumus $rumus,
                          Request $request
                        ){
        $this->ip           = $ip;
        $this->jawaban      = $jawaban;
        $this->sekolah      = $sekolah;
        $this->kecamatan    = $kecamatan;
        $this->pendidikan   = $pendidikan;
        $this->rumus        = $rumus;
        $this->request      = $request;

        view()->share([
            'active' => 'dashboard'
        ]);
    }

    public function index()
    {
        $sekolah      = $this->sekolah->kondisi()->get();
        $kecamatan    = $this->kecamatan->kondisi()->get();
        $pendidikan   = $this->pendidikan->get();
        $ip           = config('library.IP');
        $tahun        = $this->tahun();

        return view('dashboard.index', compact('ip', 'sekolah', 'kecamatan', 'pendidikan', 'tahun'));
    }

    public function tahun()
    {
        $tahunSekarang= Carbon::now()->format('Y');
        $tahunLalu    = Carbon::now()->subYears(10)->format('Y');

        return range($tahunSekarang, $tahunLalu);
    }

    /* INFORMASI */
    /*
      1. kondisi == looping, maka $nilai = sekolah_id
      2. kondisi == hasil, maka $nilai = hasil akhir bentuk persen  
    */

    public function IPDua($nilai, $kondisi, $jawSatu = null, $jawDua = null)
    {
        $jawaban = '';

        if($kondisi == 'looping'){
            $jawSatu  = kondisi_kosong($this->jawaban->kondisi($jawSatu, $nilai)->value('isi'));
            $jawDua   = kondisi_kosong($this->jawaban->kondisi($jawDua, $nilai)->value('isi'));

            $jawaban  = number_format($this->rumus->dua($jawSatu,$jawDua));
            return $jawaban;
        }elseif($kondisi == 'hasil'){
            $jawaban      = kondisi_jumlah_data($nilai);
            return $jawaban;
        }
    }

    // $batas = jika nilai mencapai $batas tersebut
    public function IPEmpatLimaTujuh($nilai, $kondisi, $batas = null, $jawSatu = null)
    {
        $jawaban = '';

        if($kondisi == 'looping'){
            $jawSatu  = kondisi_kosong($this->jawaban->kondisi($jawSatu, $nilai)->value('isi'));

            $jawaban  = number_format($this->rumus->empatLimaTujuh($jawSatu, $batas));
            return $jawaban;
        }elseif($kondisi == 'hasil'){
            $jawaban      = kondisi_jumlah_data($nilai);
            return $jawaban;
        }
    }

    public function IPSepuluh($nilai, $kondisi, $jawSatu = null, $jawDua = null)
    {
        $jawaban = '';

        if($kondisi == 'looping'){
            $jawSatu  = kondisi_kosong($this->jawaban->kondisi($jawSatu, $nilai)->value('isi'));
            $jawDua   = kondisi_kosong($this->jawaban->kondisi($jawDua, $nilai)->value('isi'));

            $jawaban  = number_format($this->rumus->sepuluh($jawSatu,$jawDua));
            return $jawaban;
        }elseif($kondisi == 'hasil'){
            $jawaban      = kondisi_jumlah_data($nilai);
            return $jawaban;
        }
    }

    public function IPEmpatBelas($nilai, $kondisi, $jawSatu = null, $jawDua = null)
    {
        if($kondisi == 'looping'){
            $jawSatu  = kondisi_kosong($this->jawaban->kondisi($jawSatu, $nilai)->value('isi'));
            $jawDua   = kondisi_kosong($this->jawaban->kondisi($jawDua, $nilai)->value('isi'));

            $jawaban  = number_format($this->rumus->empatBelas($jawSatu,$jawDua));
            return $jawaban;
        }elseif($kondisi == 'hasil'){
            $jawaban      = kondisi_jumlah_data($nilai);
            return $jawaban;
        }
    }

    public function IPLimaBelas($nilai, $kondisi)
    {
        if($kondisi == 'looping'){
            for($i = 0; $i <= 29; $i++){
                $jawBanyak = $i + 27;

                $data[$nilai][$i]   = $this->jawaban->kondisi($jawBanyak,$nilai)->value('isi');
            }

            return kondisi_jumlah_data($this->rumus->limaBelas($data));
        }else{
            return kondisi_jumlah_data($nilai);
        }
    }

    public function IPTujuhBelas($nilai, $kondisi)
    {
        if($kondisi == 'looping'){
            for($i = 0; $i <= 5; $i++){
                $jawBanyak = $i + 58;

                $data[$nilai][$i]   = $this->jawaban->kondisi($jawBanyak,$nilai)->value('isi');
            }

            return kondisi_jumlah_data($this->rumus->tujuhBelas($data));
        }else{
            return kondisi_jumlah_data($nilai);
        }
    }

    public function IPDelapanBelas($nilai, $kondisi, $jawSatu = null, $jawDua = null)
    {
        if($kondisi == 'looping'){
            $jawSatu  = kondisi_kosong($this->jawaban->kondisi($jawSatu, $nilai)->value('isi'));
            $jawDua   = kondisi_kosong($this->jawaban->kondisi($jawDua, $nilai)->value('isi'));

            $jawaban  = number_format($this->rumus->DelapanBelas($jawSatu,$jawDua));
            return $jawaban;
        }elseif($kondisi == 'hasil'){
            $jawaban      = kondisi_jumlah_data($nilai);
            return $jawaban;
        }
    }

    public function IPSembilanBelas($nilai, $kondisi, $jawSatu = null, $jawDua = null)
    {
        if($kondisi == 'looping'){
            $jawSatu  = kondisi_kosong($this->jawaban->kondisi($jawSatu, $nilai)->value('isi'));
            $jawDua   = kondisi_kosong($this->jawaban->kondisi($jawDua, $nilai)->value('isi'));

            $jawaban  = number_format($this->rumus->SembilanBelas($jawSatu,$jawDua));
            return $jawaban;
        }elseif($kondisi == 'hasil'){
            $jawaban      = kondisi_jumlah_data($nilai);
            return $jawaban;
        }
    }

    public function IPDuaPuluh($nilai, $kondisi)
    {
        if($kondisi == 'looping'){
            for($i = 0; $i <= 5; $i++){
                $jawBanyak = $i + 72;

                $data[$nilai][$i]   = $this->jawaban->kondisi($jawBanyak,$nilai)->value('isi');
            }

            return kondisi_jumlah_data($this->rumus->duaPuluh($data));
        }else{
            return kondisi_jumlah_data($nilai);
        }
    }

    public function IPDuaPuluhSatu($nilai, $kondisi, $jawSatu = null)
    {
        if($kondisi == 'looping'){
            $jawSatu  = kondisi_kosong($this->jawaban->kondisi($jawSatu, $nilai)->value('isi'));

            $jawaban  = number_format($this->rumus->duaPuluhSatu($jawSatu));
            return $jawaban;
        }elseif($kondisi == 'hasil'){
            $jawaban      = kondisi_jumlah_data($nilai);
            return $jawaban;
        }
    }

    public function persen()
    {
        $ip         = config('library.IP');
        $sekolah    = $this->sekolah->kondisi()->get();

        foreach ($sekolah as $index => $item) {
            $duaSatu[$item->id]         = $this->IPDua($item->id, 'looping', 2, 3);
            $duaDua[$item->id]          = $this->IPDua($item->id, 'looping', 9, 10);
            $empat[$item->id]           = $this->IPEmpatLimaTujuh($item->id, 'looping', 1, 11);
            $limaSatu[$item->id]        = $this->IPEmpatLimaTujuh($item->id, 'looping', 1, 12);
            $limaDua[$item->id]         = $this->IPEmpatLimaTujuh($item->id, 'looping', 6, 13);
            $tujuhSatu[$item->id]       = $this->IPEmpatLimaTujuh($item->id, 'looping', 2, 14);
            $tujuhDua[$item->id]        = $this->IPEmpatLimaTujuh($item->id, 'looping', 2, 15);
            $sepuluh[$item->id]         = $this->IPSepuluh($item->id, 'looping', 16, 17);
            $empatBelas[$item->id]      = $this->IPSepuluh($item->id, 'looping', 18, 19);
            $limaBelas[$item->id]       = $this->IPLimaBelas($item->id, 'looping');
            $tujuhBelas[$item->id]      = $this->IPTujuhBelas($item->id, 'looping');
            $delapanBelas[$item->id]    = $this->IPDelapanBelas($item->id, 'looping');
            $sembilanBelas[$item->id]   = $this->IPSembilanBelas($item->id, 'looping');
            $duaPuluh[$item->id]        = $this->IPDuaPuluh($item->id, 'looping');
            $duaPuluhSatu[$item->id]    = $this->IPDuaPuluhSatu($item->id, 'looping', 78); 
        }

        $jawaban = [
            ['name' => $ip[0], 'value' => $this->IPDua($duaSatu, 'hasil')],
            ['name' => $ip[1], 'value' => $this->IPDua($duaDua, 'hasil')],
            ['name' => $ip[2], 'value' => $this->IPEmpatLimaTujuh($empat, 'hasil')],
            ['name' => $ip[3], 'value' => $this->IPEmpatLimaTujuh($limaSatu, 'hasil')],
            ['name' => $ip[4], 'value' => $this->IPEmpatLimaTujuh($limaDua, 'hasil')],
            ['name' => $ip[5], 'value' => $this->IPEmpatLimaTujuh($tujuhSatu, 'hasil')],
            ['name' => $ip[6], 'value' => $this->IPEmpatLimaTujuh($tujuhDua, 'hasil')],
            ['name' => $ip[7], 'value' => $this->IPSepuluh($sepuluh, 'hasil')],
            ['name' => $ip[8], 'value' => $this->IPEmpatBelas($empatBelas, 'hasil')],
            ['name' => $ip[9], 'value' => $this->IPLimaBelas($limaBelas, 'hasil')],
            ['name' => $ip[10], 'value' => $this->IPTujuhBelas($tujuhBelas, 'hasil')],
            ['name' => $ip[11], 'value' => $this->IPDelapanBelas($delapanBelas, 'hasil')],
            ['name' => $ip[12], 'value' => $this->IPSembilanBelas($sembilanBelas, 'hasil')],
            ['name' => $ip[13], 'value' => $this->IPDuaPuluh($duaPuluh, 'hasil')],
            ['name' => $ip[14], 'value' => $this->IPDuaPuluhSatu($duaPuluhSatu, 'hasil')],
        ];

        return response()->json($jawaban);
    }

    // public function pencapaian(){
    //     switch (request('ip')) {
    //       case 'IP 2.1':
    //         $data = $this->ip->duaSatu(2);
    //         break;

    //       default:
    //         $data = [];
    //         break;
    //     }

    //     return response()->json($data);
    // }
}
