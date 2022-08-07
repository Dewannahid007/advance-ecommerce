
@extends('admin/layout')
@section('page_title','Color')
@section('color_select','active')
@section('content')
@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
{{session('message')}}
<button type="button" class="close" data-dismiss="alert" aria-label="close">
  <span aria-hidden="true">x</span>
</button>
</div>
@endif
<h3>Color</h3><Br>
<a href="{{url('admin/color/manage_color')}}">
<button type="button"  class="btn btn-success">Add Color</button>
</a>
<br><br>
<div class="row">
<div class="col-lg-12">
    <div class="table-responsive m-b-40">
     <table class="table table-borderless table-data3">
       <thead>
          <tr>
            <th>SL No:</th>
            <th>color</th>
            <th>Action</th>
          </tr>
       </thead>

       <tbody>
           @foreach($data as $list)
         <tr>
            <td>{{$list->id}}</td>
            <td>{{$list->color}}</td>
            <td>
            <a href="{{url('admin/color/manage_color')}}/ {{$list->id}} "> <button type="button" class="btn btn-success">Edit</button></a> 
              @if($list->status==1)
                <a href="{{url('admin/color/status/0')}}/{{$list->id}}"> <button type="button" class="btn btn-primary">Active</button></a>
                @elseif($list->status==0)
                <a href="{{url('admin/color/status/1')}}/{{$list->id}}"> <button type="button" class="btn btn-warning">Deactive</button></a>
                @endif

                <a href="{{url('admin/color/delete/')}}/ {{$list->id}}"> <button type="button" class="btn btn-danger">Delete</button></a>

            </td>

         </tr>
         @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
@endsection