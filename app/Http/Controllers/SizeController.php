<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    
    public function size(Request $request)
    {
        $result['data']=Size::all();
    
        return view('admin/size',$result);

    }
    function manage_size(Request $request, $id=''){
        if($id>0){
 
            $arr=Size::where(['id'=>$id])->get();
            $result['size']= $arr['0']->size;
            $result['status']= $arr['0']->status;
            $result['id']= $arr['0']->id;
 
        }
        else{
            $result['size']='';
            $result['status']='';
            $result['id']='0';
        }
         
        return view('admin/manage_size',$result);
    }

    public function manage_size_process(Request $request){

        $request->validate([
         'size'=>'required | unique:sizes,size,'.$request->post('id'),
        ]);
 
        if($request->post('id')>0){
            $data=Size::find($request->post('id'));
            $msg='Size Updated';
        }
        else{
            $data=new Size();
            $msg='Size Inserted';
        }
        
        $data->size=$request->post('size');
        $data->status=1;
        $data->save();
         $request->session()->Flash('message',$msg);
        return redirect('admin/size');
 
    }
    public function delete(Request $request,$id){
        $data_delete=Size::find($id);
        $data_delete->delete();
        $request->session()->flash('message','Size Deleted');
        return redirect('admin/size');

    }
    public function status(Request $request,$status,$id){
        $action=Size::find($id);
        $action->status=$status;
        $action->save();
        $request->session()->flash('message','Size Status Updated');
        return redirect('admin/size');

    }
    
}    
