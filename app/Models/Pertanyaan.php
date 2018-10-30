<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';

    public function jawaban(){
        return $this->hasOne('App\Models\Jawaban', 'pertanyaan_id');
    }

    public function getJawabanKunciAttribute()
    {
        if($this->jawaban){
            return $this->jawaban->id;
        }
    }

    // scope
    public function scopeKondisi($query, $tab){
        if ($tab) {
            $query->where('penyedia_id', $tab);
        }
    }

    public function scopeKondisiJawaban($query){
        $query->with(array('jawaban' => function($jawaban){
            $jawaban->where('sekolah_id',request('sekolah'));
        }));
    }

    public function getKondisiKeteranganAttribute()
    {
        if($this->tanya == 1){
            return true;
        }
    }

    public function getInputPertanyaanAttribute()
    {
        if($this->pilihan == 0 && $this->kondisi_keterangan){
            return true;
        }
    }

    public function getPilihanPertanyaanAttribute()
    {
         if($this->pilihan == 1 && $this->kondisi_keterangan){
            return true;
        }
    }
}
