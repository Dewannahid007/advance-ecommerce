<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    

 public function color(Request $request)
    {
        $result['data']=Color::all();
    
        return view('admin/color',$result);

    }
    function manage_color(Request $request, $id=''){
        if($id>0){
 
            $arr=Color::where(['id'=>$id])->get();
            $result['color']= $arr['0']->color;
            $result['status']= $arr['0']->status;
            $result['id']= $arr['0']->id;
 
        }
        else{
            $result['color']='';
            $result['status']='';
            $result['id']='0';
        }
         
        return view('admin/manage_color',$result);
    }

    public function manage_color_process(Request $request){

        $request->validate([
         'color'=>'required | unique:colors,color,'.$request->post('id'),
        ]);
 
        if($request->post('id')>0){
            $data=Color::find($request->post('id'));
            $msg='Color Updated';
        }
        else{
            $data=new Color();
            $msg='Color Inserted';
        }
        
        $data->color=$request->post('color');
        $data->status=1;
        $data->save();
         $request->session()->Flash('message',$msg);
        return redirect('admin/color');
 
    }
    public function delete(Request $request,$id){
        $data_delete=Color::find($id);
        $data_delete->delete();
        $request->session()->flash('message','Color Deleted');
        return redirect('admin/color');

    }
    public function status(Request $request,$status,$id){
        $action=Color::find($id);
        $action->status=$status;
        $action->save();
        $request->session()->flash('message','Color Status Updated');
        return redirect('admin/color');

    }
}
