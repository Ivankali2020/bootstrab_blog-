@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow ">
                    <div class="card-header text-center bg-transparent">Chang Password Manager</div>
                    <div class="card-body">
                        <form action="{{ route('updatePassword') }}" method="post">
                            @csrf

                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            <div class="form-group align-items-center  d-flex" >
                                   <label for="name" class="w-50 mb-0"> Old Password </label>
                                <input type="text" class="form-control" id="name" name="old">
                            </div>
                            <div class="form-group align-items-center  d-flex">
                                <label for="name" class="w-50 mb-0">New Password</label>
                                <input type="text" class="form-control" id="name" name="new">

                            </div>
                            <div class="form-group align-items-center  d-flex">
                                <label for="name" class="w-50 mb-0">Comfirm Password</label>
                                <input type="text" class="form-control" id="name" name="Cnew">

                            </div>

                            <button class="btn btn-outline-success float-right" >Change Password</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
