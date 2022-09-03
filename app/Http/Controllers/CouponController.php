<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function coupon(Request $request)
    {
        $result['data']=Coupon::all();
    
        return view('admin/coupon',$result);

    }
    function manage_coupon(Request $request, $id=''){
        if($id>0){
 
            $arr=Coupon::where(['id'=>$id])->get();
            $result['title']= $arr['0']->title;
            $result['code']= $arr['0']->code;
            $result['value']= $arr['0']->value;
            $result['type']= $arr['0']->type;
            $result['min_order_amt']= $arr['0']->min_order_amt;
            $result['is_one_time']= $arr['0']->is_one_time;
            $result['id']= $arr['0']->id;
 
        }
        else{
            $result['title']='';
            $result['code']='';
            $result['value']='';
            $result['type']='';
            $result['min_order_amt']='';
            $result['is_one_time']='';
            $result['id']='0';
        }
         
        return view('admin/manage_coupon',$result);
    }

    public function manage_coupon_process(Request $request){

        $request->validate([
         'title'=>'required',
         'code'=>'required | unique:coupons,code,'.$request->post('id'),
         'value'=>'required',
        ]);
 
        if($request->post('id')>0){
            $data=Coupon::find($request->post('id'));
            $msg='Coupon Updated';
        }
        else{
            $data=new Coupon();
            $msg='Coupon Inserted';
            $data->status=1;

        }
        
        $data->title=$request->post('title');
        $data->code=$request->post('code');
        $data->value=$request->post('value');
        $data->type=$request->post('type');
        $data->min_order_amt=$request->post('min_order_amt');
        $data->is_one_time=$request->post('is_one_time');

        $data->save();
        $request->session()->Flash('message',$msg);
        return redirect('admin/coupon');
 
    }
    public function delete(Request $request,$id){
        $data_delete=Coupon::find($id);
        $data_delete->delete();
        $request->session()->flash('message','Coupon Deleted');
        return redirect('admin/coupon');


    }
   
    public function status(Request $request,$status,$id){
        $action=Coupon::find($id);
        $action->status=$status;
        $action->save();
        $request->session()->flash('message','Coupon Status Updated');
        return redirect('admin/coupon');

    }
}
