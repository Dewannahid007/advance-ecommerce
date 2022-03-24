<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }


    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');
        $result=Admin::where(['email'=>$email ,'password'=>$password])->get();
        if(isset($result['0']->id)){
            $request->session()->put('admin_login',true);
            $request->session()->put('admin_id',($result['0']->id));
            return Redirect('Dashboard');

        }
        else{
            $request->session()->flash('error','Please Enter Valid Login Information');
            return redirect('admin');

        }

       // return $request->post();


    }

   
}
