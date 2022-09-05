@extends('admin/layout')
@section('page_title','home Banner')
@section('home_banner_select','active') 
@section('content')
@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
{{session('message')}}
<button type="button" class="close" data-dismiss="alert" aria-label="close">
  <span aria-hidden="true">x</span>
</button>
</div>
@endif
<h3>Home Banner</h3><Br>
<a href="{{url('admin/home_banner/manage_home_banner')}}">
<button type="button"  class="btn btn-success">Add Home Banner</button>
</a>
<br> <br>
<div class="row">
<div class="col-lg-12">
    <div class="table-responsive m-b-40">
     <table class="table table-borderless table-data3">
       <thead>
          <tr>
            <th>SL No:</th>
            <th>Btn Text</th>
            <th>Btn Link</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
       </thead>
       <tbody>
           @foreach($data as $list)
         <tr>
            <td>{{$list->id}}</td>
            <td>{{$list->btn_txt}}</td>
            <td> {{$list->btn_link}} </td>
            <td>
                <img width="100px" src="{{asset('storage/media/banner/'.$list->image)}}">
            </td>

            <td> 
            <a href="{{url('admin/home_banner/manage_home_banner/')}}/ {{$list->id}} "> <button type="button" class="btn btn-success">Edit</button></a>
              @if($list->status==1)
                <a href="{{url('admin/home_banner/status/0')}}/ {{$list->id}} "> <button type="button" class="btn btn-primary">Active</button></a>
                @elseif($list->status==0)
                <a href="{{url('admin/home_banner/status/1')}}/ {{$list->id}} "> <button type="button" class="btn btn-warning">Deactive</button></a>
                @endif

                <a href="{{url('admin/home_banner/delete/')}}/ {{$list->id}} "> <button type="button" class="btn btn-danger">Delete</button></a>

            </td>

         </tr>
         @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
@endsection