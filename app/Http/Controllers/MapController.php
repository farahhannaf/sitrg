<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\PdfModel;
use App\Models\UserModel;
use File;
use Session;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
    	$result = $this->listMaps();
        return view('backend.map.index', compact('result'));
    }

    public function listMaps(){
        $kode_wil = Session::get('activeUser')->kode_wil;
	    $zipPath = public_path('uploaded-File/'.$kode_wil.'/Zip/');

	    $dataMaps = [];
	    foreach (glob($zipPath . "*.zip") as $filename) {
            $temp = str_replace("/", "\\", $filename);
            $temp = explode("\\", $temp);
            $temp= str_replace(".zip", "", end($temp));

            $dataMaps[] = explode("_", $temp);
        }

        $result = [];
        foreach ($dataMaps as $d) {
        	$data = new \StdClass();
        	$data->tanggal = $d[0];
        	$data->kode_wil = $d[1];
        	$data->nama = implode(" ", array_slice($d, 2));
        	$result[] = $data;
        }
    	return $result;
    }
}
