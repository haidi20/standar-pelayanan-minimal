<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Jawaban;
use App\Models\Sekolah;

use App\Supports\IndikatorPencapaian;
use App\Supports\Rumus;

class DashboardController extends Controller
{
    function __construct(
                          IndikatorPencapaian $ip, 
                          Jawaban $jawaban, 
                          Sekolah $sekolah,
                          Rumus $rumus
                        ){
        $this->ip       = $ip;
        $this->jawaban  = $jawaban;
        $this->sekolah  = $sekolah;
        $this->rumus    = $rumus;
    }

    public function index()
    {
        $sekolah      = $this->sekolah->get();
        $ip           = config('library.IP');

        return view('dashboard.index', compact('ip', 'sekolah'));
    }

    public function persen()
    {
        $ip           = config('library.IP');
        $sekolah = $this->sekolah->kondisi()->get();

        foreach ($sekolah as $index => $item) {
            $duaSatu[$item->id]       = $this->IpDua($item->id, 'looping', 2, 3);
            $duaDua[$item->id]       = $this->IpDua($item->id, 'looping', 9, 10);
        }

        $jawaban = [
            ['name' => $ip[0], 'isi' => $this->IpDua($duaSatu, 'hasil')],
            ['name' => $ip[1], 'isi' => $this->IpDua($duaDua, 'hasil')],
            ['name' => $ip[2], 'isi' => 0],
            ['name' => $ip[3], 'isi' => 0],
            ['name' => $ip[4], 'isi' => 0],
            ['name' => $ip[5], 'isi' => 0],
            ['name' => $ip[6], 'isi' => 0],
            ['name' => $ip[7], 'isi' => 0],
            ['name' => $ip[8], 'isi' => 0],
            ['name' => $ip[9], 'isi' => 0],
            ['name' => $ip[10], 'isi' => 0],
            ['name' => $ip[11], 'isi' => 0],
            ['name' => $ip[12], 'isi' => 0],
            ['name' => $ip[13], 'isi' => 0],
            ['name' => $ip[14], 'isi' => 0],
        ];

        return response()->json($jawaban);
    }

    public function IpDua($value, $kondisi, $jawSatu = null, $jawDua = null)
    {
        $jawaban = '';

        if($kondisi == 'looping'){
            $jawSatu  = kondisi_null($this->jawaban->kondisiJawaban($jawSatu, $value)->value('isi'));
            $jawDua   = kondisi_null($this->jawaban->kondisiJawaban($jawDua, $value)->value('isi'));

            $jawaban  = number_format($this->rumus->duaSatu($jawSatu,$jawDua));
            return $jawaban;
        }elseif($kondisi == 'hasil'){
            $jawaban      = kondisi_jumlah_data($value);
            return $jawaban;
        }
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

    // public function persen(){
    //     $duaSatu        = $this->ip->duaSatu(1);
    //     $duaDua         = $this->ip->duaDua(1);
    //     $empat          = $this->ip->empat(1);
    //     $limaSatu       = $this->ip->limaSatu(1);
    //     $limaDua        = $this->ip->limaDua(1);
    //     $tujuhSatu      = $this->ip->tujuhSatu(1);
    //     $tujuhDua       = $this->ip->tujuhDua(1);
    //     $sepuluh        = $this->ip->sepuluh(1);
    //     $empatBelas     = $this->ip->empatBelas(1);
    //     $limaBelas      = $this->ip->limaBelas(1);
    //     $tujuhBelas     = $this->ip->tujuhBelas(1);
    //     $delapanBelas    = $this->ip->delapanBelas(1);
    //     $sembilanBelas  = $this->ip->sembilanBelas(1);
    //     $duaPuluh       = $this->ip->duaPuluh(1);
    //     $duaPuluhSatu   = $this->ip->duaPuluhSatu(1);

    //     $data = [
    //         ['nama' =>'IP 2.1','isi'    => $duaSatu],
    //         ['nama' => 'IP 2.2','isi'   => $duaDua],
    //         ['nama' =>'IP 4.1','isi'    => $empat],
    //         ['nama' => 'IP 5.1','isi'   => $limaSatu],
    //         ['nama' =>'IP 5.2','isi'    => $limaDua],
    //         ['nama' => 'IP 7.1','isi'   => $tujuhSatu],
    //         ['nama' =>'IP 7.2','isi'    => $tujuhDua],
    //         ['nama' => 'IP 10.1','isi'  => $sepuluh],
    //         ['nama' => 'IP 14.1','isi'  => $empatBelas],
    //         ['nama' => 'IP 15.1','isi'  => $limaBelas],
    //         ['nama' => 'IP 17.1','isi'  => $tujuhBelas],
    //         ['nama' => 'IP 18.1','isi'  => $delapanBelas],
    //         ['nama' => 'IP 19.1','isi'  => $sembilanBelas],
    //         ['nama' => 'IP 20.1','isi'  => $duaPuluh],
    //         ['nama' => 'IP 21.1','isi'  => $duaPuluhSatu]
    //     ];

    //     return response()->json($data);
    // }
}
