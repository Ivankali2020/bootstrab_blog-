@extends('layouts.master')
@section('title','Create Article')
@section('content')
    <div class="container p-0">
        <div class="row ">
{{--            <div class="col-12">--}}
{{--                <div class="card shadow">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3>Create Article</h3>--}}
{{--                        <form action="{{ route('article.store') }}" id="articleStore" method="post">--}}
{{--                            @csrf--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-3">
                <div class="card mt-3 ">
                    <div class="card-body">
                        <form action="{{ route('article.store') }}" id="articleStore" method="post" enctype="multipart/form-data">
                            @csrf
                        </form>
                        <div class="form-group  ">
                            <label for="">Select Category</label>
                            <select name="category_id" id="category" form="articleStore" class="custom-select" >
                                <option value="" disabled selected >Select Something</option>
                                @foreach($categories as $category)
                                    <option class="form-control  " {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <small class="text-danger ">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="photo" class="user-select-none">Select Photo</label>
                            <input form="articleStore" type="file" name="photo" id="photo" class="form-control p-1 ">
                            @error('photo')
                            <small class="text-danger ">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="main" class="user-select-none">For MainCover Article</label>
                            <input form="articleStore" type="checkbox" name="mainCover" id="main" class="btn btn-outline-secondary ml-4">
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-6">
                <div class="card mt-3 ">
                    <div class="card-body">
                        <div class="form-group  ">
                            <label for="">Article Title</label>
                            <input form="articleStore" type="text" value="{{ old('title') }}" name="title" class="form-control ">
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Article Description</label>
                            <textarea form="articleStore" name="description" value="{{ old('description') }}" id="description"  class="form-control " rows="10"></textarea>
                        </div>
                        @error('description')
                         <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card mt-3 ">
                    <div class="card-body">
                        <div class="form-group  ">
                            <label for="">Create</label>
                            <button form="articleStore" class="btn btn-block btn-primary">Create Article</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('footer')




@endsection
