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
                                            <form action="{{route('category.manage_category_process')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="category_name" class="control-label mb-1">Category Name</label>
                                                    <input id="category_name" value="{{$category_name}} " name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                                    @error('category_name')
                                                    {{$message}}
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                                    <input id="category_slug" value="{{$category_slug}}" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                                    @error('category_slug')
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