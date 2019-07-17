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
    	$result = $this->getMapByUser(Session::get('activeUser')->role_id);
        return view('backend.map.index', compact('result'));
    }

    public function getMapByUser($role){
        if($role == 1){
            $user = UserModel::all();
        }else{
            $user = UserModel::where('user_id', Session::get('activeUser')->user_id)->get();
        }

        $dataMaps = [];
        foreach ($user as $usr) {
            $zipPath = public_path('uploaded-File/'.$usr['kode_wil'].'/Zip/');

            foreach (glob($zipPath . "*.zip") as $filename) {
                $temp = str_replace("/", "\\", $filename);
                $temp = explode("\\", $temp);
                $temp= str_replace(".zip", "", end($temp));

                $dataMaps[] = explode("_", $temp);
            }
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
