<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\PdfModel;
use App\Models\UserModel;
use File;
use PDF;
use Session;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = Session::get('activeUser')->role_id;
        if($role == 1){
            $pdf=PdfModel::all();
        }else{
            $pdf=PdfModel::all();
            $kode_wil = $request->session()->get('activeUser')['kode_wil'];
            $pdf = $pdf->where('kode_wil',$kode_wil);
        }
        return view('backend.pdf.index',compact('pdf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // public function pdfStream(Request $request){
    //    $pdf=PdfModel::all();
    //   $kode_wil = $request->session()->get('activeUser')['kode_wil'];
    //   $pdf = $pdf->where('kode_wil',$kode_wil);
    //   $user = PdfModel::find($user->id_pdf);
    //   $data["info"] = $user;
    //   $pdf = PDF::loadView('file_pdf', $data);
    //   return $pdf->stream('file_pdf');
    // }
    public function back(){
        return redirect ('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show($id_pdf){
        $path=PdfModel::find($id_pdf)->first();
        $path=$path->file_pdf;
        $path = str_replace("\\", "/", $path);
        return view ('backend.pdf.open',compact('path'));
    }

  
    public function delete($id_pdf){
     $pdf=PdfModel::find($id_pdf);
        $pdf->delete();
        return back();
    }


}
