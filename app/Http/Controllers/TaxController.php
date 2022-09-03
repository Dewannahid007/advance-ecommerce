<?php

namespace App\Http\Controllers;

use App\Models\tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function tax(Request $request)
    {
        $result['data']=Tax::all();
    
        return view('admin/tax',$result);

    }
    function manage_tax(Request $request, $id=''){
        if($id>0){
 
            $arr=Tax::where(['id'=>$id])->get();
            $result['tax_desc']= $arr['0']->tax_desc;
            $result['tax_value']= $arr['0']->tax_value;
            $result['status']= $arr['0']->status;
            $result['id']= $arr['0']->id;
 
        }
        else{
            $result['tax_desc']='';
            $result['tax_value']='';
            $result['status']='';
            $result['id']='0';
        }
         
        return view('admin/manage_tax',$result);
    }

    public function manage_tax_process(Request $request){

        $request->validate([
         'tax_value'=>'required | unique:taxes,tax_value,'.$request->post('id'),
        ]);
 
        if($request->post('id')>0){
            $data=Tax::find($request->post('id'));
            $msg='Tax Updated';
        }
        else{
            $data=new Tax();
            $msg='Tax Inserted';
        }
        
        $data->tax_desc=$request->post('tax_desc');
        $data->tax_value=$request->post('tax_value');
        $data->status=1;
        $data->save();
         $request->session()->Flash('message',$msg);
        return redirect('admin/tax');
 
    }
    public function delete(Request $request,$id){
        $data_delete=Tax::find($id);
        $data_delete->delete();
        $request->session()->flash('message','Tax Deleted');
        return redirect('admin/tax');

    }
    public function status(Request $request,$status,$id){
        $action=Tax::find($id);
        $action->status=$status;
        $action->save();
        $request->session()->flash('message','Tax Status Updated');
        return redirect('admin/tax');

    }
}
