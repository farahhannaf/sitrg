<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\PdfModel;
use App\Models\UserModel;
use File;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $pdf=PdfModel::all();
        $kode_wil = $request->session()->get('activeUser')['kode_wil'];
        $pdf = $pdf->where('kode_wil',$kode_wil);
        return view('backend.pdf.index',compact('pdf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function back(){
        return redirect ('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function insert(Request $request){
     return redirect ('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pdf)
    {
        $pdf = PdfModel::find($id_pdf);
        return view('backend.pdf.edit',compact('pdf'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pdf)
    {
        $pdf=PdfModel::find($id_pdf);
        $pdf->file_pdf = $request->file_pdf;
        $pdf->save();

        return redirect ('/pdf')->with('alert-success','Data berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id_pdf){
     $pdf=PdfModel::find($id_pdf);
        $pdf->delete();
        return back();
    }

    public function read($user_id){
     $data=User::find($user_id);
     return view('backend.users.read',compact('data'));
    }

    public function destroy($id)
    {
        //
    }
}
