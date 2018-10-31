<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Sekolah;
use App\Models\Kecamatan;
use App\Models\Pendidikan;

class SekolahController extends Controller
{
    public function __construct(Request $request, Sekolah $sekolah, Kecamatan $kecamatan, Pendidikan $pendidikan){
        $this->request      = $request;
        $this->sekolah      = $sekolah;
        $this->kecamatan    = $kecamatan;
        $this->pendidikan   = $pendidikan;

         view()->share([
            'active' => 'sekolah'
        ]);
    }

    public function index(){
        $sekolah        = $this->sekolah;
        $filterSekolah  = $this->sekolah;
        $pendidikan     = $this->pendidikan->all();
        $kecamatan      = $this->kecamatan->all();
        $dataSekolah    = $sekolah->kondisi()->paginate(10);

        if(request('sekolah')){
            $filterSekolah = $sekolah->kondisi('kuisioner');
        }

        return view('sekolah.index',compact('pendidikan', 'kecamatan', 'dataSekolah', 'filterSekolah'));
    }

    public function create(){
        return $this->form();
    }

    public function edit($id){
        return $this->form($id);
    }

    public function form($id = null){
        $sekolahFind = Sekolah::find($id);

        if ($sekolahFind) {
            session()->flashInput($sekolahFind->toArray());
            $action = route('sekolah.update',$id) ;
            $method = 'PUT';
        }else{
            $action = route('sekolah.store');
            $method = 'POST';
        }

        $pendidikan = Pendidikan::all();
        $kecamatan  = Kecamatan::all();
        $sekolah    = Sekolah::paginate(10);

        return view('sekolah.form',compact(
            'action','method','pendidikan','kecamatan','sekolah'
          ));
    }

    public function store(){
        return $this->save();
    }

    public function update($id){
        return $this->save($id);
    }

    public function save($id = null){
        if ($id) {
            $sekolah = Sekolah::find($id);
        }else{
            $sekolah = new Sekolah;
        }

        $this->validate(request(),[
          'kecamatan_id'  => 'required',
          'pendidikan_id' => 'required',
          'hp'            => 'required',
          'operator'      => 'required',
          'alamat'        => 'required',
          'nama'          => 'required'
        ]);

        $sekolah->kecamatan_id  = request('kecamatan_id');
        $sekolah->pendidikan_id = request('pendidikan_id');
        $sekolah->hp            = request('hp');
        $sekolah->operator      = request('operator');
        $sekolah->alamat        = request('alamat');
        $sekolah->nama          = request('nama');
        $sekolah->save();

        return redirect()->route('sekolah.index');
    }

    public function baca(){
        return Sekolah::kondisi()->get();
    }
}
