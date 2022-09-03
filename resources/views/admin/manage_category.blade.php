@extends('admin/layout')
    @section('page_title','Manage Category')
    @section('content')
    <h3>Manage Category</h3><Br>
    <a href="{{url('admin/category')}}">
    <button type="button"  class="btn btn-success"> Back</button>
    </a>
    <br> <br>
    <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{route('category.manage_category_process')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                    <label for="category_name" class="control-label mb-1">Category Name</label>
                                                    <input id="category_name" value="{{$category_name}} " name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                                    @error('category_name')
                                                    {{$message}}
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                            <label for="parent_category_id" class="control-label mb-1">Parent Category</label>
                                            <select id="parent_category_id" name="parent_category_id"  class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach($category as $list)
                                                @if($parent_category_id==$list->id)
                                                <option selected value="{{$list->id}}">
                                                    @else
                                                <option value="{{$list->id}}">
                                                    @endif 
                                                    {{$list->category_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                               
                                                    <div class="col-lg-3">
                                                    <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                                    <input id="category_slug" value="{{$category_slug}}" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                                    @error('category_slug')
                                                    {{$message}}
                                                    @enderror
                                                        </div>

                                                        <div class="col-lg-3">
                                                    <label for="category_image" class="control-label mb-1">Category Image</label>
                                                    <input id="category_image"  name="category_image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('category_image')
                                                    <div class="alert alert-danger" role="alert">
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                    @if($category_image!='') <a href="{{asset('storage/media/category/'.$category_image)}}" target="_blank"><img width="100px" src="{{asset('storage/media/category/'.$category_image)}}"/> </a> @endif


                                                </div>


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

    @endsection