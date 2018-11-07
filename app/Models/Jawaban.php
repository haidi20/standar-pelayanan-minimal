<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    public $fillable = ['pertanyaan_id','sekolah_id','isi'];

    public function sekolah()
    {
        return $this->belongsTo('App\Models\Sekolah');
    }

    public function pertanyaan()
    {
        return $this->belongsTo('App\Models\Pertanyaan');
    }

    public function scopeKondisi($query,$pertanyaan,$sekolah)
    {
    	$bulanPeriode	= $this->periodeBulan();
    	$dariPeriode	= $this->periodeTahun($bulanPeriode->dari);
    	$kePeriode 		= $this->periodeTahun($bulanPeriode->ke);
        $kondisi 		= $query->where('pertanyaan_id',$pertanyaan)->where('sekolah_id',$sekolah);

        if(request('tahun')){
        	$kondisi = $kondisi->whereYear('created_at', request('tahun'));
        }
        if(request('periode')){
        	$kondisi = $kondisi->whereBetWeen('created_at', [$dariPeriode, $kePeriode]);
        }

        return $kondisi;
    }

    public function periodeTahun($bulan)
    {
    	$tahun 		= request('tahun') ? request('tahun') : Carbon::now()->format('Y');

    	return Carbon::createFromDate($tahun, $bulan, 1)->format('Y-m-d');
    }

    public function periodeBulan()
    {
    	if(request('periode') == 1){
    		$dari 	= 1;
    		$ke 	= 6;
    	}else{
    		$dari 	= 7;
    		$ke 	= 12;
    	}

    	return (object) compact('dari', 'ke');
    }
}
