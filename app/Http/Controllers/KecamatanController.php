<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kecamatan;
use App\API\Kecamatan as ApiKecamatan;

class KecamatanController extends Controller
{
	public function __construct(ApiKecamatan $apiKecamatan)
	{
		$this->apiKecamatan = $apiKecamatan;
	}

    public function index()
    {
        return Kecamatan::all();
    }

    public function kecamatan()
    {
    	$kecamatan = $this->apiKecamatan->data();
    	return $kecamatan;
    }
}
