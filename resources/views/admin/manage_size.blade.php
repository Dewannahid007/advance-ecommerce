@extends('admin/layout')
    @section('page_title','Manage Size')
    @section('size_select','active')
    @section('content')
    <h3>Manage Size</h3><Br>
    <a href="{{url('admin/size')}}">
    <button type="button"  class="btn btn-success"> Back</button>
    </a>
    <br><br>
    <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                 <form action="{{route('size.manage_size_process')}}" method="post">
                 @csrf
                    <div class="form-group"> 
                        <label for="size" class="control-label mb-1">Size</label>
                        <input id="size" value="{{$size}} " name="size" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('size')
                        {{$message}}
                        @enderror
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