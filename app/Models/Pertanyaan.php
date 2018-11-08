<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';

    public function jawaban(){
        return $this->hasOne('App\Models\Jawaban', 'pertanyaan_id');
    }

    // scope
    public function scopeKondisi($query, $tab){
        $query->where('penyedia_id', $tab);

        if(request('pendidikan')){
            $query->where('pendidikan_id', request('pendidikan'))->orWhere('pendidikan_id', 3)->where('penyedia_id', $tab);
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

    public function getJawabanKunciAttribute()
    {
        if($this->jawaban){
            return $this->jawaban->id;
        }
    }

    public function getBukanTanyaAttribute()
    {
        if($this->tanya == 0){
            return count($this->tanya);
        }
    }
}
