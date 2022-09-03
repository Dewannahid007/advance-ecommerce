<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use LDAP\Result;

class AdminController extends Controller
{
    function index(Request $request){
        if($request->session()->has('Admin_Login')){
            return redirect('admin/dashboard');

        }
        else{

                return view('admin.login');
 
        }
  
    }
    function auth(Request $request){
        $email=$request->post('email');
        $password=$request->post('password');

       // $result=Admin::where(['email'=>$email , 'password'=>$password])->get();
        $result=Admin::where(['email'=>$email])->first();

        if($result){
            if(Hash::check($request->post('password'),$result->password)){

            $request->session()->put('Admin_Login',true);
            $request->session()->put('Admin_Id',$result->id); 
            return redirect('admin/dashboard');
            }
            else{
                $request->session()->flash('error','Please Enter Valid Password');
                return redirect('admin');

            }

        }
       
    }
    
    function dashboard(){
        return view('admin.dashboard');
    }
   
} 
