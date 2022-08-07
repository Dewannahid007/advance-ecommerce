@extends('admin/layout')
    @section('page_title','Manage Brand')
    @section('brand_select','active')
    @section('content')
    @if($id>0)
{{$image_required= ""}}
@else
{{$image_required="required"}} 
@endif

@error('image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
{{$message}}
<button type="button" class="close" data-dismiss="alert" aria-label="close">
  <span aria-hidden="true">x</span>
</button>
</div>
@enderror

    <h3>Manage Brand</h3><Br>
    <a href="{{url('admin/brand')}}">
    <button type="button"  class="btn btn-success"> Back</button>
    </a>
    <br><br>
    <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                 <form action="{{route('brand.manage_brand_process')}}" method="post" enctype="multipart/form-data">
                 @csrf
                    <div class="form-group"> 
                        <label for="brand" class="control-label mb-1">Brand</label>
                        <input id="brand" value="{{$name}} " name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('name')
                        {{$message}}
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" class="control-label mb-1">Image</label>
                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}} >
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}
                        </div>
                        @enderror
                        <td>
              @if($image!='')
               <img width="100px" height="20px" 
               src="{{asset('storage/media/brand/'.$image)}}"/>
              @endif
              </td>
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
        </div>              
                            
    </div>

 @endsection