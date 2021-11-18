@extends('layouts.app')
@section('style')
    <style>
        #canvasOne{
            width: 100%;
            height: 100%;
            position: absolute;
            border-radius: 10px;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body row">
                    <div class="col-lg-4 position-relative d-none d-lg-block  ">
{{--                        mb-5 mb-md-3  d-flex flex-column justify-content-center  justify-content-lg-between--}}
                        {{--                        <div class="d-flex flex-column align-items-center ">--}}
{{--                            <img src="{{ asset('logo/logo.png') }}" width="100" height="100" alt="">--}}
{{--                            <span class="align-self-lg-start lead "> Explore your minds  </span>--}}
{{--                            <span class="align-self-lg-end "> in our awesome place.</span>--}}
{{--                        </div>--}}
{{--                        <span class="text-secondary mt-4 mt-md-2  text-right "> <b>Ivan.com</b>  is devloped by newbie.</span>--}}
                        <canvas id="canvasOne"></canvas>
                    </div>
                    <form method="POST" class="col-lg-8" action="{{ route('login') }}">
                        @csrf
                        <h3 class="text-center mb-lg-4 "> Login </h3>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <a href="{{ url('redirect') }}" class="btn btn-outline-primary ">
                                    <i class="feather-facebook"></i>
                                </a>

                                    <a class="btn btn-link float-right mr-5 " href="{{ route('register') }}">
                                        {{ __('Register For Blogging web ?') }}
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

@section('script')

    <script>
        let canvas = document.getElementById("canvasOne");
        let ctx = canvas.getContext("2d");
        let particlesArr = [];
        let hsl = 1;

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        window.addEventListener("resize", function () {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });

        let mouse = {
            x: undefined,
            y: undefined,
        };

        window.addEventListener("click", function (e) {
            mouse.x = e.x;
            mouse.y = e.y;
            for (let i=0 ; i<6 ; i++){
                particlesArr.push(new Particle());
            }
            init();
        });

        window.addEventListener("mousemove", function (e) {
            mouse.x = e.x;
            mouse.y = e.y;
            for (let i=0 ; i<6 ; i++){
                particlesArr.push(new Particle());
            }
            init();
        });

        window.addEventListener("keyup", function () {
            mouse.x = canvas.width /2;
            mouse.y = canvas.height /2;
            for (let i=0 ; i<16 ; i++){
                particlesArr.push(new Particle());
            }
            init();
        });

        class Particle {
            constructor() {
                this.x = mouse.x;
                this.y = mouse.y;
                // this.x = Math.random() * canvas.width;
                // this.y = Math.random() * canvas.height;
                this.size = Math.random() * 10+2;
                this.color = `hsl(${hsl},100%,50%)`;
                this.speedX = Math.random() * 3 - 1.5;
                this.speedY = Math.random() * 3 - 1.5;
            }

            update(){
                this.x += this.speedX;
                this.y += this.speedY;
                if(this.size > 0.3 ){ //this is helper of slice because is can run .1 reduce size of one time
                    this.size -= 0.1;
                    console.log(this.size);
                }
            }
            draw() {
                ctx.fillStyle = this.color;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function init(){  //this is for draw loop
            for (let i = 0; i < particlesArr.length; i++) {
                particlesArr[i].draw();
                particlesArr[i].update();
                if(particlesArr[i].size <= .3 ){
                    particlesArr.splice(i,1);
                }
            }
        }



        function animate() {
            // ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = 'rgba(255,255,255,0.5)'
            ctx.fillRect(0,0,canvas.width,canvas.height);
            ctx.fill();
            init();
            hsl+=8;
            requestAnimationFrame(animate);
        }

        animate();
    </script>

    @endsection
