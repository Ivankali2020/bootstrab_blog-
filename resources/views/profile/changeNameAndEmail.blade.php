@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow mt-5">
                    <div class="card-header bg-transparent font-weight-bold text-center h4">
                        Change Email And Name Manager
                    </div>

                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-6">
                                <form action="update/name" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Change Name</label>
                                        <input type="text" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}" class="form-control" id="name" name="name">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button class="btn btn-outline-success" >Change Name</button>
                                </form>
                            </div>
                            <div class="col-6">
                                <form action="update/email" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Chane Email</label>
                                        <input type="text" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" class="form-control" id="email" name="name">
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button class="btn btn-outline-success" >Change Email</button>
                                </form>
                            </div>


                            <div class="col-6  mt-3">
                                <form action="update/phone" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Chane Phone</label>
                                        <input type="text" value="{{ \Illuminate\Support\Facades\Auth::user()->phone }}" class="form-control" id="name" name="name">
                                        @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button class="btn btn-outline-success" >Change Phone</button>
                                </form>
                            </div>
                            <div class="col-6 mt-3">
                                <form action="update/address" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Chane Address</label>
                                        <input type="text" value="{{ \Illuminate\Support\Facades\Auth::user()->address }}" class="form-control" id="email" name="name">


                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button class="btn btn-outline-success" >Change Address</button>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
