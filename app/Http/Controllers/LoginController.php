<?php
namespace App\Http\Controllers;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
class LoginController extends Controller
{
    public function index(Request $request){
        // $request->session()->flash('$activeUser',null);
        // Session::flush();
        // return redirect('login');
        if($request->session()->exists('activeUser')){
                return redirect('/home');
        }
        return view('login/index');
    }

    public function cekLogin(Request $request){
        // return $request->all();
//        $email = $request->input('email');
        $kode_wil = $request->input('kode_wil');
        $password = $request->input('password');
        $activeUser = UserModel::where('kode_wil','=', $kode_wil)->first();
        if(is_null($activeUser)){
            //data gak ada
            return back();
            $params = [
                'message' => 'Login Gagal, Data tidak ditemukan'
            ];
            $this->loginMenu();
        }else{
            if($activeUser->password == sha1($password)){
                $request->session()->put('activeUser',$activeUser); // activeuser diambil session ke home.
               // dd($activeUser);

                $activeUser->remember_token=sha1($activeUser->user_id.date('YmdHis'));
                $activeUser->save();

                Session::put('activeUser', $activeUser);
                return redirect('/home');
            }
            $params = [
                'message' => 'Login Gagal, Password tidak sesuai'
            ];
            return 'error';
            $this->loginMenu();
        }
        return view('login.index', $params);
    }
    public function loginMenu(){
        return view('/home');
    }
    public function cekLogout(Request $request){
        $request->session()->flash('$activeUser',null);
        Session::flush();
        return redirect('login');
    }
}