@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_select','active')
@section('content')
@if($id>0)
{{$image_required= ""}}
@else
{{$image_required="required"}} 
@endif

@if(session()->has('sku_error'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
{{session('sku_error')}}
<button type="button" class="close" data-dismiss="alert" aria-label="close">
  <span aria-hidden="true">x</span>
</button>
</div>
@endif

@error('image_attr.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
{{$message}}
<button type="button" class="close" data-dismiss="alert" aria-label="close">
  <span aria-hidden="true">x</span>
</button>
</div>
@enderror
<h3>Manage Product</h3>
<Br>
<a href="{{url('admin/product')}}">
<button type="button"  class="btn btn-success"> Back</button>
</a>
<br><br>
<div class="row m-t-30">
   <div class="col-md-12">
      <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body">
                     @csrf
                     <div class="form-group"> 
                        <label for="name" class="control-label mb-1">Name</label>
                        <input id="name" value="{{$name}} " name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                     </div>
                     <div class="form-group"> 
                        <label for="slug" class="control-label mb-1">Slug</label>
                        <input id="slug" value="{{$slug}} " name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('slug')
                        {{$message}}
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="image" class="control-label mb-1">Image</label>
                        <input id="image" value="{{$image}} " name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}} >
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}
                        </div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                              <label for="category_id" class="control-label mb-1">Category</label>
                              <select id="category_id" name="category_id"  class="form-control" required>
                                 <option value="">Select Category</option>
                                 @foreach($category as $list)
                                 @if($category_id==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif 
                                    {{$list->category_name}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="brand" class="control-label mb-1">Brand</label>
                              <select id="brand" name="brand"  class="form-control" required>
                                 <option value="">Select Brand</option>
                                 @foreach($brands as $list)
                                 @if($brand==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif 
                                    {{$list->name}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="model" class="control-label mb-1">Model</label>
                              <input id="model" value="{{$model}} " name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                        </div>
                     </div>
                     <div class="form-group"> 
                        <label for="short_desc" class="control-label mb-1">Short Desc</label>
                        <textarea id="short_desc" name="short_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        {{$short_desc}}</textarea>
                     </div>
                     <div class="form-group"> 
                        <label for="desc" class="control-label mb-1">Description</label>
                        <textarea id="desc" name="desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        {{$desc}} </textarea>
                     </div>
                     <div class="form-group"> 
                        <label for="keywords" class="control-label mb-1">Keywords</label>
                        <textarea id="keywords" name="keywords" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        {{$keywords}} </textarea>
                     </div>
                     <div class="form-group"> 
                        <label for="technical_specification" class="control-label mb-1">Technical Specification</label>
                        <textarea id="technical_specification" name="technical_specification" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        {{$technical_specification}} </textarea>
                     </div>
                     <div class="form-group"> 
                        <label for="uses" class="control-label mb-1">Uses</label>
                        <textarea id="uses" name="uses" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        {{$uses}} </textarea>
                     </div>
                     <div class="form-group"> 
                        <label for="warranty" class="control-label mb-1">Warranty</label>
                        <textarea id="warranty" name="warranty" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        {{$warranty}} </textarea>
                     </div>
                  </div>
               </div>
            </div>
            <h2 class="mb10">&nbsp;&nbsp; Product Images</h2>

            <div class="col-lg-12" id="product_images_box">
                @php
                $loop_count_num=1;
                @endphp
                @foreach($productImagesArr as $key=>$val)
                @php
                $loop_count_prev=$loop_count_num;
                 $pIArr=(array)$val;
                 @endphp


                 <input id="pIArr" name="pIArr[]" type="hidden" value="{{$pIArr['id']}}">

               <div class="card">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row"id="product_images_box" >
                           <div class="col-md-3 product_images_{{$loop_count_num++}}" > 
                              <label for="images" class="control-label mb-1">Images</label>
                              <input id="images"  name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false">
                              @if($pIArr["images"]!='')<img width="100px" src="{{asset('storage/media/'.$pIArr['images'])}}"/> @endif
                           </div>
                           <div class="form-group">
                              <div class="col-md-2"> 
                                 <label for="images" class="control-label mb-1"></label>
                                 @if($loop_count_num==2)
                                 <button type="button" class="btn btn-success btn-lg" onclick="add_image_more()" >
                                 <i class="fa fa-plus"></i>
                                 &nbsp; Add </button>
                                 @else
                                 <a href="{{url('admin/product/product_images_delete/')}}/ {{$pIArr['id']}}/ {{$id}}"> 
                                 <button type="button" class="btn btn-danger btn-lg">
                                 <i class="fa fa-minus"></i>
                                 &nbsp; remove </button></a>
                                 @endif
                                 
                              </div>
                           </div>
                           
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach

            </div>


            <h2 class="mb10">&nbsp;&nbsp; Product Attributes</h2>
            <div class="col-lg-12" id="product_attr_box">
                @php
                $loop_count_num=1;
                @endphp
                @foreach($productAttrArr as $key=>$val)
                @php
                $loop_count_prev=$loop_count_num;
                 $pAArr=(array)$val;
                 @endphp
                 <input id="paid" name="paid[]" type="hidden" value="{{$pAArr['id']}}">

               <div class="card" id="product_attr_{{$loop_count_num++}}">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3">         
                              <label for="sku" class="control-label mb-1">SKU</label>
                              <input id="sku"  name="sku[]" type="text" value="{{$pAArr['sku']}}" class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                           <div class="col-md-2">         
                              <label for="mrp" class="control-label mb-1">MRP</label>
                              <input id="mrp"  name="mrp[]" type="text"value="{{$pAArr['mrp']}}"  class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                           <div class="col-md-2">
                              <label for="price" class="control-label mb-1">Price</label>
                              <input id="price"  name="price[]" type="text" value="{{$pAArr['price']}}" class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                           <div class="col-md-2">
                              <label for="size_id" class="control-label mb-1">Size</label>
                              <select id="size_id" name="size_id[]" class="form-control">
                                 <option value="">Select</option>
                                 @foreach($sizes as $list)
                                 @if($pAArr['size_id']==$list->id)
                                 <option value="{{$list->id}}" selected>{{$list->size}}</option>
                                   @else
                                   <option value="{{$list->id}}">{{$list->size}}</option>
                                   @endif
                                 @endforeach
                              </select>
                           </div>  
                           <div class="col-md-2">
                              <label for="color_id" class="control-label mb-1">Color</label>
                              <select id="color_id" name="color_id[]"  class="form-control">
                                 <option value="">Select</option>
                                 @foreach($colors as $list)
                                 @if($pAArr['color_id']==$list->id)
                                 <option value="{{$list->id}}"selected>{{$list->color}}</option>
                                   @else
                                   <option value="{{$list->id}}">{{$list->color}}</option>
                                   @endif
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-2">
                              <label for="qty" class="control-label mb-1">QTY</label>
                              <input id="qty"  name="qty[]" type="text" value="{{$pAArr['qty']}}" class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                           <div class="col-md-3"> 
                              <label for="image_attr" class="control-label mb-1">Image Attribute</label>
                              <input id="image_attr"  name="image_attr[]" type="file" class="form-control" aria-required="true" aria-invalid="false">
                              @if($pAArr["image_attr"]!='')<img width="100px" src="{{asset('storage/media/'.$pAArr['image_attr'])}}"/> @endif
                           </div>
                           <div class="form-group">
                              <div class="col-md-2"> 
                                 <label for="add" class="control-label mb-1"></label>
                                 @if($loop_count_num==2)
                                 <button type="button" class="btn btn-success btn-lg" onclick="add_more()" >
                                 <i class="fa fa-plus"></i> 
                                 &nbsp; Add </button>
                                 @else
                                 <a href="{{url('admin/product/product_attr_delete/')}}/ {{$pAArr['id']}}/ {{$id}}"> 
                                 <button type="button" class="btn btn-danger btn-lg" onclick="remove_more('{{$loop_count_prev}}' )">
                                 <i class="fa fa-plus"></i>
                                 &nbsp; remove </button></a>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach

            </div>
         </div>
         <div>
            <button id="submit" type="submit" class="btn btn-lg btn-info btn-block">
            Submit
            </button>
         </div>
         <input type="hidden" name="id" value="{{$id}}">
      </form>
   </div>
</div>
<script>
   var loop_count=1;
   function add_more(){
       loop_count++;
       var html='<input id="paid" name="paid[]" type="hidden"> <div class="card"id="product_attr_'+loop_count+'" > <div class="card-body"> <div class="form-group"> <div class="row">';
   
       html+='<div class="col-md-3"><label for="sku" class="control-label mb-1">SKU</label><input id="sku"  name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
   
       html+='<div class="col-md-2"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp"  name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
   
       html+='<div class="col-md-2"><label for="price" class="control-label mb-1">Price</label><input id="price"  name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
   
       var size_id_html=jQuery('#size_id').html();
       size_id_html=size_id_html.replace("selected",""); 

       html+='<div class="col-md-2"><label for="size_id" class="control-label mb-1">Size</label> <select id="size_id" name="size_id[]" class="form-control">'+size_id_html+'</select></div>';
   
       var color_id_html=jQuery('#color_id').html();
       color_id_html=color_id_html.replace("selected","");
       html+='<div class="col-md-2"><label for="color_id" class="control-label mb-1">Color</label> <select id="color_id" name="color_id[]" class="form-control">'+color_id_html+'</select></div>';
   
       html+='<div class="col-md-2"><label for="qty" class="control-label mb-1">Qty</label><input id="qty"  name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" requried></div>';

       html+='<div class="col-md-3"><label for="image_attr" class="control-label mb-1">Image</label><input id="image_attr"  name="image_attr[]" type="file" class="form-control" aria-required="true" aria-invalid="false"></div>';
   
       html+='<div class="form-group"> <div class="col-md-3"><label for="remove_attr" class="control-label mb-1"></label><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"> </i>Remove</button></div></div> ';
   
       html+='</div></div></div></div>';
   
        jQuery('#product_attr_box').append(html)
   }
   function remove_more(loop_count){
            jQuery('#product_attr_'+loop_count).remove();
        }

        var loop_image_count=1;
        function add_image_more(){
         loop_image_count++; 
          var html='<input id="pIArr" name="pIArr[]" type="hidden" value=""><div class="col-md-3 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1">Image</label><input id="images"  name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false"></div>';
   
         html+='<div class="col-md-3 product_images_'+loop_image_count+'"><label for="remove_attr" class="control-label mb-1"></label><button type="button" class="btn btn-danger btn-lg" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"> </i>Remove</button></div></div> ';
         jQuery('#product_images_box').append(html)
         

        }
        function remove_image_more(loop_image_count){

         jQuery('.product_images_'+loop_image_count).remove(); 
        }

  
</script>
@endsection
