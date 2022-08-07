<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   function category(Request $request){
       $result['data']=Category::all();

       return view('admin/category',$result);
   }


   function manage_category(Request $request, $id=''){
       if($id>0){

           $arr=Category::where(['id'=>$id])->get();
           $result['category_name']= $arr['0']->category_name;
           $result['category_slug']= $arr['0']->category_slug;
           $result['id']= $arr['0']->id;

       }
       else{
           $result['category_name']='';
           $result['category_slug']='';
           $result['id']='0';
       }
        
       return view('admin/manage_category',$result);
   }
   

   public function manage_category_process(Request $request){

       $request->validate([
        'category_name'=>'required',
        'category_slug'=>'required | unique:categories,category_slug,'.$request->post('id'),
       ]);

       if($request->post('id')>0){
           $data=Category::find($request->post('id'));
           $msg='Category Updated';
       }
       else{
           $data=new Category();
           $msg='Category Inserted';
       }
       
       $data->category_name=$request->post('category_name');
       $data->category_slug=$request->post('category_slug');
       $data->status=1;
       $data->save();
       $request->session()->Flash('message',$msg);
       return redirect('admin/category');

   }
   public function delete(Request $request,$id){
       $category_delete=Category::find($id);
       $category_delete->delete();
       $request->session()->Flash('message','Category Deleted');
       return redirect('admin/category'); 

   }
   public function status(Request $request,$status,$id){
       $action=Category::find($id);
       $action->status=$status;
       $action->save();
       $request->session()->Flash('message','Category Status Updated');
       return redirect('admin/category');



        
   }
}
