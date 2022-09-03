@extends('admin/layout')
    @section('page_title','Manage Tax')
    @section('tax_select','active')
    @section('content')
    <h3>Manage Tax</h3><Br>
    <a href="{{url('admin/tax')}}">
    <button type="button"  class="btn btn-success"> Back</button>
    </a>
    <br><br>
    <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                 <form action="{{route('tax.manage_tax_process')}}" method="post">
                 @csrf
                    <div class="form-group"> 
                        <label for="tax_desc" class="control-label mb-1">Tax Description</label>
                        <input id="tax_desc" value="{{$tax_desc}} " name="tax_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('tax_desc')
                        {{$message}}
                        @enderror
                    </div>
                    <div class="form-group"> 
                        <label for="tax_value" class="control-label mb-1">Tax Value</label>
                        <input id="tax_value" value="{{$tax_value}} " name="tax_value" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('tax_value')
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