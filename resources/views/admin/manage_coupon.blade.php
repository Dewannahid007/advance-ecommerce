@extends('admin/layout')
    @section('page_title','Manage Coupon')
    @section('content')
    <h3>Manage Coupon</h3><Br>
    <a href="{{url('admin/coupon')}}">
    <button type="button"  class="btn btn-success"> Back</button>
    </a>
    <br><br>
    <div class="form-group">
    <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                 <form action="{{route('coupon.manage_coupon_process')}}" method="post">
                 @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4">
                            <label for="title" class="control-label mb-1">Title</label>
                        <input id="title" value="{{$title}} " name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('title')
                        {{$message}}
                        @enderror
                      </div>
                    
                            <div class="col-lg-4">
                            <label for="code" class="control-label mb-1">Code</label>
                        <input id="code" value="{{$code}}" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('code')
                        {{$message}}
                        @enderror

                            </div>
                        
                    
                    
                        
                            <div class="col-lg-4">
                        <label for="value" class="control-label mb-1">Value</label>
                        <input id="value" value="{{$value}}" name="value" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('value')
                        {{$message}}
                        @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4">
                            <label for="type" class="control-label mb-1">Type</label>
                            <select id="type" name="type"  class="form-control">
                             @if($type=='value')  
                           <option value="value" selected>Value</option>
                                 <option value="Per">Per</option>
                                 @elseif($type=='Per')
                                 <option value="value" selected>Value </option>
                                 <option value="Per" selected>Per</option>
                                 @else
                                 <option value="value">Value </option>
                                 <option value="Per">Per</option>

                                 @endif
                           </select>
                            </div>
                            <div class="col-lg-4">
                            <label for="min_order_amt" class="control-label mb-1">Minimum Order Amount</label>
                        <input id="min_order_amt" value="{{$min_order_amt}}" name="min_order_amt" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('min_order_amt')
                        {{$message}}
                        @enderror

                            </div>

                            <div class="col-lg-4">
                            <label for="is_one_time" class="control-label mb-1">Is OneTime</label>
                           <select id="is_one_time" name="is_one_time"  class="form-control" required>
                             @if($is_one_time=='1')  
                           <option value="1" selected>Yes</option>
                                 <option value="0">No </option>
                                 @else
                                 <option value="1" selected>Yes </option>
                                 <option value="0" selected>No</option>

                                 @endif
                           </select>
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
        </div>              
                            
    </div>
    </div>

 @endsection