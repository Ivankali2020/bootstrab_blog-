@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">

                        <img class="img-fluid rounded-top  " src="{{ asset('storage/profile/'.\Illuminate\Support\Facades\Auth::user()->photo) }}" alt="">


                    <div class="card-body">
                        <form action="{{ route('updatePhoto') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-group">

                                <input type="file" class="form-control p-1" id="name" name="photo">
                                @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button class="btn btn-outline-success w-100 " >Change Photo</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
