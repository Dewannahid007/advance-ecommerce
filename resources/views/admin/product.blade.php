
@extends('admin/layout')
@section('page_title','Product')
@section('product_select','active')
@section('content')
@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
{{session('message')}}
<button type="button" class="close" data-dismiss="alert" aria-label="close">
  <span aria-hidden="true">x</span>
</button>
</div>
@endif
<h3>Product Lists</h3><Br>
<a href="{{url('admin/product/manage_product ')}}">
<button type="button"  class="btn btn-success">Add Product</button>
</a>
<br><br>
<div class="row">
<div class="col-lg-12">
    <div class="table-responsive m-b-40">
     <table class="table table-borderless table-data3">
       <thead>
          <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Image</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Warranty</th>
            <th>Action</th>

          </tr>
       </thead>

       <tbody>
           @foreach($data as $list)
         <tr>
            <td>{{$list->name}}</td>
            <td> {{$list->slug}}</td>
            <td>
              @if($list->image!='')
               <img width="100px" height="20px" 
               src="{{asset('storage/media/'.$list->image)}}"/>
              @endif
              </td>
            <td> {{$list->category_id}}</td>
            <td> {{$list->brand}}</td>
            <td> {{$list->model}}</td>
            <td> {{$list->warranty}}</td>

            <td>
            <a href="{{url('admin/product/manage_product')}}/ {{$list->id}} "> <button type="button" class="btn btn-success">Edit</button></a> 
              @if($list->status==1)
                <a href="{{url('admin/product/status/0')}}/{{$list->id}}"> <button type="button" class="btn btn-primary">Active</button></a>
                @elseif($list->status==0)
                <a href="{{url('admin/product/status/1')}}/{{$list->id}}"> <button type="button" class="btn btn-warning">Deactive</button></a>
                @endif
                <a href="{{url('admin/product/delete/')}}/ {{$list->id}}"> <button type="button" class="btn btn-danger">Delete</button></a>
            </td>

         </tr>
         @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
@endsection