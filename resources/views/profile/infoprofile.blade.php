@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">

                    <img class="img-fluid rounded-top  " src="{{ asset('storage/profile/'.\Illuminate\Support\Facades\Auth::user()->photo) }}" alt="">

                    <div class="card-body text-center">
                    @php
                     $user = \Illuminate\Support\Facades\Auth::user();
                    @endphp
                        <h2 class=" font-weight-bold text-capitalize"> {{ $user->name  }} </h2>
                        <h4 class="text-muted my-3 lead"> {{ $user->email  }}</h4>
                        <p  class="" >
                            <i class="fa fa-phone-alt text-muted  fa-fw w-25" style="font-size: 21px"></i>
                            <span class="text-muted   text-right h5">{{ $user->phone }}</span>
                        </p>
                        <p class="">
                            <i class="fa fa-map-signs text-muted   w-25 fa-fw" style="font-size: 21px"></i>
                            <span class="text-muted  text-right h5">{{ $user->address }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
