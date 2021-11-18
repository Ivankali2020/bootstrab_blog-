@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

                <div class="card">
                    <div class="card-body row">
                        <div class="col-lg-4 mb-5 mb-md-3  d-flex flex-column justify-content-center  justify-content-lg-between ">
                           <div class="d-flex flex-column align-items-center ">
                               <img src="{{ asset('logo/logo.png') }}" width="100" height="100" alt="">
                               <span class="align-self-lg-start lead "> Explore your minds  </span>
                               <span class="align-self-lg-end "> in our awesome place.</span>
                           </div>
                            <span class="text-secondary mt-4 mt-md-2  text-right "> <b>Ivan.com</b>  is devloped by newbie.</span>
                        </div>
                        <form method="POST" class="col-lg-8" action="{{ route('register') }}">
                            @csrf
                            <h3 class="text-center mb-lg-4 "> Register </h3>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                    <a href="{{ url('redirect') }}" class="btn btn-outline-primary ">
                                       <i class="feather-facebook  "></i> Google
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection
