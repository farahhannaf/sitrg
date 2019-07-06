<?php

namespace App\Http\Controllers\Backend;
use App\Models\PdfModel;

use Illuminate\Http\Request;

class HomeController extends BackendController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 	    $pdf=PdfModel::all();
        $kode_wil = $request->session()->get('activeUser')['kode_wil'];
        $pdf_sum = $pdf->where('kode_wil',$kode_wil)->count();

    	$count = 20;
        return view('backend.home', compact('pdf_sum'));
    }
}