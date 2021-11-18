@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                        $head =  \Illuminate\Support\Facades\Request::url();
                        $new = explode('/',$head);
                        $heder = \Illuminate\Support\Facades\Request::segment(2);
                        echo $heder;

                    @endphp

                    {{ \Illuminate\Support\Facades\Auth::user()->isBaned }}
                    {{ __('You are logged in!') }}
                    <button class="btn btn-outline-danger" id="message">Message Btn</button>
                    <button class="btn btn-outline-success" id="troat">Troat Btn</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')


    <script>
        $('#message').click(function (){
            console.log('hello');
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            })
        })

        $('#troat').click(function () {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Signed in successfully'
            })
        })
    </script>


@endsection
