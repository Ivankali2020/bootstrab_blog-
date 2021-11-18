@extends('layouts.master')
@section('title','Edit Article')
@section('content')
    <div class="container p-0">
        <div class="row ">

            <div class="col-md-8">
                <div class="card mt-3 ">
                    <div class="card-body">
                        <div class="form-group  ">
                            <label for="">Article Title</label>
                            <input form="articleStore" type="text" value="{{ $article->title }}" name="title" class="form-control ">
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Article Description</label>
                            <textarea form="articleStore" name="description" id="editSummerNote"   rows="10">
                                @php
                                echo html_entity_decode($article->description);
                                @endphp
                            </textarea>
                        </div>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-3 ">
                    <div class="card-body">
                        <form action="{{ route('article.update',$article->id) }}" id="articleStore" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                        </form>
                        <div class="form-group  ">
                            <label for="">Select Category</label>
                            <select name="category_id"  id="category" form="articleStore" class="custom-select" >
                                <option value="" disabled selected >Select Something</option>
                                @foreach($categories as $category)
                                    <option class="form-control  " {{ $article->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
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
                        <div class="form-group  ">
                            <button form="articleStore" class="btn btn-block btn-primary">Edit Article</button>

                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="col-3">--}}
{{--                <div class="card mt-3 ">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="form-group  ">--}}
{{--                            <label for="">Edit</label>--}}
{{--                            <button form="articleStore" class="btn btn-block btn-primary">Edit Article</button>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>



@endsection

@section('footer')


    <script>
        $(function () {
            // Summernote
            $('#editSummerNote').summernote()

        })


    </script>

@endsection

