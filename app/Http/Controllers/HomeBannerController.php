<?php

namespace App\Http\Controllers;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    
   function home_banner(Request $request){
    $result['data']=HomeBanner::all();

    return view('admin/home_banner',$result);
}


function manage_home_banner(Request $request, $id=''){
    if($id>0){

        $arr=HomeBanner::where(['id'=>$id])->get();
        $result['image']= $arr['0']->image;
        $result['btn_txt']= $arr['0']->btn_txt;
        $result['btn_link']=$arr['0']->btn_link;
        $result['id']= $arr['0']->id;

    }
    else{
        $result['image']='';
        $result['btn_txt']='';
        $result['btn_link']='';
        $result['id']='0';
    }

    return view('admin/manage_home_banner',$result);
}


public function manage_home_banner_process(Request $request){

    $request->validate([
     'image'=>'mimes:jpeg,jpg,png'
    ]);

    if($request->post('id')>0){
        $data=HomeBanner::find($request->post('id'));
        $msg='Home Banner Updated';
    }
    else{
        $data=new HomeBanner();
        $msg='Home Banner Inserted';
    }
    if($request->hasFile('image')){
        if($request->post('id')>0){
            $arrImage=DB::table('home_banners')->where(['id'=>$request->post('id')])->get();
            if(Storage::exists('public/media/banner/'.$arrImage[0]->image)){
                Storage::delete('public/media/banner/'.$arrImage[0]->image);
            }
        }
     $image=$request->file('image');
     $ext=$image->extension();
     $image_name=time().".".$ext;
     $image->storeAs('public/media/banner',$image_name);
     $data->image=$image_name;
    }
    
    $data->btn_txt=$request->post('btn_txt');
    $data->btn_link=$request->post('btn_link');
    $data->status=1;
    $data->save();
    $request->session()->Flash('message',$msg);
    return redirect('admin/home_banner');

}
public function delete(Request $request,$id){
    $home_banner_delete=HomeBanner::find($id);
    $home_banner_delete->delete();
    $request->session()->Flash('message','Banner Deleted');
    return redirect('admin/home_banner'); 

}
public function status(Request $request,$status,$id){
 $action=HomeBanner::find($id);
 $action->status=$status;
 $action->save();
 $request->session()->Flash('message','Banner Status Updated');
 return redirect('admin/home_banner');
  
}
    
}
