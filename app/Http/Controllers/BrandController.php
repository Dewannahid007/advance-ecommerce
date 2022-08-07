<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function brand(Request $request)
    {
        $result['data']=Brand::all();
    
        return view('admin/brand',$result);

    }
    function manage_brand(Request $request, $id=''){
        if($id>0){
 
            $arr=Brand::where(['id'=>$id])->get();
            $result['name']= $arr['0']->name;
            $result['image']= $arr['0']->image;
            $result['status']= $arr['0']->status;
            $result['id']= $arr['0']->id;
 
        }
        else{
            $result['name']='';
            $result['image']='';
            $result['status']='';
            $result['id']='0';
        }
         
        return view('admin/manage_brand',$result);
    }

    public function manage_brand_process(Request $request){  

        $request->validate([
            'name'=>'required | unique:brands,name,'. $request->post('id'),
            'image'=>'mimes:jpeg,jpg,png'
        ]);

        if($request->post('id')>0){
            $data=Brand::find($request->post('id'));
            $msg='Brand Updated';
        }
        else{
            $data=new Brand();
            $msg='Brand Inserted';
        }
        if($request->hasfile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'. $ext;
            $image->storeAs('public/media/brand',$image_name);
            $data->image=$image_name;

        }
        
        $data->name=$request->post('name');
        $data->status=1;
        $data->save();
         $request->session()->Flash('message',$msg);
        return redirect('admin/brand');
 
    }
    public function delete(Request $request,$id){
        $data_delete=Brand::find($id);
        $data_delete->delete();
        $request->session()->flash('message','Brand Deleted');
        return redirect('admin/brand');

    }
    public function status(Request $request,$status,$id){
        $action=Brand::find($id);
        $action->status=$status;
        $action->save();
        $request->session()->flash('message','Brand Status Updated');
        return redirect('admin/brand');

    }

}
