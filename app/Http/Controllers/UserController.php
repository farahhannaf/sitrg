<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UserModel;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=User::all();
        return view('backend.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function back(){
        return redirect ('/');
    }

    public function create(Request $request)
    {   
        if(UserModel::create($request->all())){       
            $kode_wil = User::get()->pluck('kode_wil');
            foreach ($kode_wil as $key => $value) {
                $path = public_path('/uploaded File/'.$value);
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
            }

            return redirect('/user')->with('sukses','Data berhasil diinput');
        }
        return back();
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
    public function edit($user_id)
    {
        $data = UserModel::find($user_id);
        return view('backend.users.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $data=UserModel::find($user_id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->save();

        return redirect ('/user')->with('alert-success','Data berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($user_id){
     $data=UserModel::find($user_id);
        $data->delete();
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
