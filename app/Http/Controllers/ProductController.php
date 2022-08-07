<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function product(Request $request)
    {
        $result['data']=Product::all();
    
        return view('admin/product',$result);

    }
    function manage_product(Request $request, $id=''){
        if($id>0){
 
            $arr=Product::where(['id'=>$id])->get();

            $result['category_id']= $arr['0']->category_id;
            $result['name']= $arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['slug']= $arr['0']->slug;
            $result['brand']= $arr['0']->brand;
            $result['model']= $arr['0']->model;
            $result['short_desc']= $arr['0']->short_desc;
            $result['desc']= $arr['0']->desc;
            $result['keywords']= $arr['0']->keywords;
            $result['technical_specification']= $arr['0']->technical_specification;
            $result['uses']= $arr['0']->uses;
            $result['warranty']= $arr['0']->warranty;
            $result['status']= $arr['0']->status;
            $result['id']= $arr['0']->id;

            $result['productAttrArr']=DB::table('products_attr')->where(['products_id'=>$id])->get();

            $productImagesArr=DB::table('product_images')->where(['products_id'=>$id])->get();
            
            if(!isset($productImagesArr[0])){
            $result['productImagesArr'][0]['id']='';
            $result['productImagesArr'][0]['images']='';

            }
            else{
                $result['productImagesArr']=$productImagesArr;
            }
 
        }
        else{

            $result['category_id']='';
            $result['name']='';
            $result['image']='';
            $result['slug']='';
            $result['brand']='';
            $result['model']='';
            $result['short_desc']='';
            $result['desc']='';
            $result['keywords']='';
            $result['technical_specification']='';
            $result['uses']='';
            $result['warranty']='';
            $result['status']='';
            $result['id']='0';


            $result['productAttrArr'][0]['id']='';
            $result['productAttrArr'][0]['product_id']='';
            $result['productAttrArr'][0]['sku']='';
            $result['productAttrArr'][0]['image_attr']='';
            $result['productAttrArr'][0]['mrp']='';
            $result['productAttrArr'][0]['price']='';
            $result['productAttrArr'][0]['qty']='';
            $result['productAttrArr'][0]['size_id']='';
            $result['productAttrArr'][0]['color_id']='';
            $result['productImagesArr'][0]['id']='';
            $result['productImagesArr'][0]['images']='';


        }
        $result['category']=DB::table('categories')->where(
            ['status'=>1])->get();

            $result['brands']=DB::table('brands')->where(
                ['status'=>1])->get();

            $result['sizes']=DB::table('sizes')->where(
                ['status'=>'1'])->get();
                $result['colors']=DB::table('colors')->where(
                    ['status'=>1])->get();

    
        return view('admin/manage_product',$result);
    }

    public function manage_product_process(Request $request){
        if($request->post('id')>0){
            $image_validation="mimes:jpeg,jpg,png";
        }
        else{
            $image_validation="required | mimes:jpeg,jpg,png";
        }

        $request->validate([
            'name'=>'required',
            'image'=>$image_validation,
            'slug'=>'required | unique:products,slug,'.$request->post('id'),
            'image_attr.*' =>'mimes:jpg,jpeg,png'

        ]);
        $paidArr=$request->post('paid');
        $skuArr=$request->post('sku');
        $mrpArr=$request->post('mrp');
        $priceArr=$request->post('price');
        $qtyArr=$request->post('qty');
        $size_idArr=$request->post('size_id');
        $color_idArr=$request->post('color_id');
        foreach($skuArr as $key=>$val){
           $check= DB::table('products_attr')->
           where('sku','=',$skuArr[$key])->
           where('id','!=',$paidArr[$key])->
           get();

           if(isset($check[0])){
            $request->session()->flash('sku_error',$skuArr[$key].'SKU alreday Used');
               return redirect(request()->headers->get('referer'));

           }


        }

 
        if($request->post('id')>0){
            $data=Product::find($request->post('id'));
            $msg='Product Updated';
        }
        else{
            $data=new Product();
            $msg='Product Inserted';
        }
         if($request->hasfile('image')){
             $image=$request->file('image');
             $ext=$image->extension();
             $image_name=time().'.'. $ext;
             $image->storeAs('public/media',$image_name);
             $data->image=$image_name;

         }
        
        $data->category_id=$request->post('category_id');
        $data->name=$request->post('name');
        $data->slug=$request->post('slug');
        $data->brand=$request->post('brand');
        $data->model=$request->post('model');
        $data->short_desc=$request->post('short_desc');
        $data->desc=$request->post('desc');
        $data->keywords=$request->post('keywords');
        $data->technical_specification=$request->post('technical_specification');
        $data->uses=$request->post('uses');
        $data->warranty=$request->post('warranty');
        $data->status=1;
        $data->save();
        $pid=$data->id;
        /* Product Attributes Start*/
        foreach($skuArr as $key=>$val){

            $productAttrArr['products_id']=$pid;
            $productAttrArr['sku']=$skuArr[$key]; 
            $productAttrArr['mrp']=$mrpArr[$key];
            $productAttrArr['price']=$priceArr[$key];
            $productAttrArr['qty']=$qtyArr[$key];
             if($size_idArr[$key]==''){
                $productAttrArr['size_id']=0;

             }
             else{
                $productAttrArr['size_id']=$size_idArr[$key];

             }
             if($color_idArr[$key]==''){
                $productAttrArr['color_id']=0;

             }else{
                $productAttrArr['color_id']=$color_idArr[$key];

             }

             if($request->hasFile("image_attr.$key")){
                 $image_attr=$request->file("image_attr.$key");
                 $ext=$image_attr->extension();
                 $image_name=time().'.'.$ext;
                 $request->file("image_attr.$key")->storeAs('public/media',$image_name);
                 $productAttrArr['image_attr']=$image_name;
                 
             }
             else{
                $productAttrArr['image_attr']='';

             }
             if($paidArr[$key]!=''){
                DB::table('products_attr')->where(['id'=>$paidArr[$key]])->update($productAttrArr);
             }
             else{
                DB::table('products_attr')->insert($productAttrArr);

             }

        }


        /* Product Attributes Ends*/




         $request->session()->Flash('message',$msg);
        return redirect('admin/product');
 
    }
    public function delete(Request $request,$id){
        $data_delete=Product::find($id);
        $data_delete->delete();
        $request->session()->flash('message','Product Deleted');
        return redirect('admin/product');

    }
    public function product_attr_delete(Request $request,$paid,$pid){
        DB::table('products_attr')->where(['id'=>$paid])->delete();

        return redirect('admin/product/manage_product/'.$pid);

    }
    public function product_images_delete(Request $request,$piid,$pid){
        DB::table('product_images')->where(['id'=>$piid])->delete();

        return redirect('admin/product/manage_product/'.$pid);

    }


    public function status(Request $request,$status,$id){
        $action=Product::find($id);
        $action->status=$status;
        $action->save();
        $request->session()->flash('message','Product Status Updated');
        return redirect('admin/product');

    }

}
