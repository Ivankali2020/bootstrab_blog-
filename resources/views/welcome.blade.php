@extends('blog.master')
@section('content')

    <main class="container">
        <div class="card card-body mb-5 pt-5  rounded mainCover text-secondary  shadow-sm" style="background-image: url({{ asset('storage/BlogPhoto/'.$mainCover->photo) }})">
            <a href="{{ route('blog.show',$mainCover->slug.'?category='.$mainCover->category->slug) }}" class="col-lg-8 text-decoration-none text-light ">
                <p class="h1 fst-italic mb-5  "> {{ \Illuminate\Support\Str::limit($mainCover->title,30) }} </p>
                <p class="lead my-3 text-secondary ">{{ \Illuminate\Support\Str::words($mainCover->description,20) }}</p>
            </a>
            <div class=" d-flex justify-content-between mt-4  align-items-center ">
                <div class="d-flex flex-column flex-md-row   align-items-lg-center ml-3 ">
                    <small class="mr-2  ">
                        <i class="feather-layers"></i>
                        {{ $mainCover->category->title }}
                    </small>
                    <small class="mr-2 d-none d-md-block ">
                        <i class="feather-user"></i>
                        {{ $mainCover->user->name }}
                    </small>
                    <small class="mr-2 d-none d-md-block ">
                        <i class="feather-calendar"></i>
                        {{ $mainCover->created_at->format('d M Y') }}
                    </small>

                    <small class="mr-2  ">
                        <i class="feather-clock"></i>
                        {{ $mainCover->updated_at->diffForHumans() }}
                    </small>

                </div>
                <div class=" align-self-end">
                    <p class="lead   mb-0"><a href="{{ url('blog.show'.$mainCover->slug.'?category='.$mainCover->category->slug) }}" class="text-light fw-bold">Continue reading ...</a></p>
                </div>
            </div>
        </div>

        <div class="row mb-2 ">

            @foreach($co_mains as $co_main)

                <div class="col-md-6 ">
                    <div class="row  mx-0 d-flex rounded overflow-hidden flex-md-row mb-4 shadow-sm   position-relative">
                        <div class="col-lg-8  ">
                            <div class="py-lg-3 pl-lg-3  d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary ">{{  \Illuminate\Support\Str::limit($co_main->category->title,20)  }}</strong>
                                <h3 class="mb-0">{{ \Illuminate\Support\Str::limit($co_main->title,22) }}</h3>
                                <div class="mb-1 text-muted">{{ $co_main->created_at->format('M d') }} </div>
                                <p class="body card-text mb-auto">{{ \Illuminate\Support\Str::limit($co_main->description,115) }}</p>
                                <a href="{{ route('blog.show',$co_main->slug.'?category='.$co_main->category->slug) }}" class="stretched-link  mt-2 mt-md-3">Continue reading</a>
                            </div>
                        </div>
                        <div class="col-md-4 d-none d-lg-block  ">
                            <img  class="coMainCover"  style="background-image: url({{ asset('storage/BlogPhoto/'.$co_main->photo) }})"   alt="">
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

        <div class="row g-5">
            <div class="col-md-8">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">
                    From the Firehose
                </h3>

                @forelse($articles as $a)
                    <div class="mt-2 mt-md-4 card card-body shadow border-0 bg-transparent ">
                        <h3 class="d-flex justify-content-between ">
                            <a href="{{ route('blog.show',$a->slug.'?category='.$a->category->slug) }}" class="text-decoration-none text-capitalize">{{ $a->title }} </a>
                            <img src="{{ asset('storage/profile/'.$a->user->photo) }}" class=" rounded-circle " width="30" height="30" alt="">
                        </h3>
                            <div class="body mt-3  ">
                                {{ \Illuminate\Support\Str::limit($a->description,300) }}
                            </div>

                            <div class=" d-flex flex-column flex-md-row justify-content-between mt-4 ">
                                <div class="d-flex align-items-center text-black-50">
                                    <small class="mr-2  ">
                                        <i class="feather-layers"></i>
                                        {{ $a->category->title }}
                                    </small>
                                    <small class="mr-2  ">
                                        <i class="feather-user"></i>
                                        {{ $a->user->name }}
                                    </small>
                                    <small class="mr-2  d-none d-md-block">
                                        <i class="feather-calendar"></i>
                                        {{ $a->created_at->format('d M Y') }}
                                    </small>

                                    <small class="mr-2  ">
                                        <i class="feather-clock"></i>
                                        {{ $a->updated_at->diffForHumans() }}
                                    </small>

                                </div>
                                <div class="mt-3 mt-md-0 ">
                                    <a href="{{ route('blog.show',$a->slug) }}" class="  btn btn-outline-primary">Continue Reading ...</a>
                                </div>
                            </div>
                        </div>

                @empty
                    <div class="card bg-transparent border-0 shadow-sm mb-4 ">
                        <div class="card-body">
                            <h3 class="text-center ">
                                <a href="" class="text-decoration-none"> Dearest User  </a>
                            </h3>
                            <div class="d-flex align-items-center justify-content-center text-black-50">
                                <small class="mr-2 mb-4 mt-2 ">
                                    <i class="feather-layers"></i>
                                    {{ 'unkonow' }}
                                </small>
                                <small class="mr-2 mb-4 mt-2 ">
                                    <i class="feather-user"></i>
                                    {{ 'unkonow' }}
                                </small>
                                <small class="mr-2 mb-4 mt-2 ">
                                    <i class="feather-calendar"></i>
                                    {{ 'unkonow' }}
                                </small>

                                <small class="mr-2 mb-4 mt-2 ">
                                    <i class="feather-clock"></i>
                                    {{ 'unkonow' }}
                                </small>

                            </div>
                            <div class="body text-center  ">
                                There is no article in this category   ...
                                <p class="display-1  mt-4">😔</p>
                            </div>

                            <div class="float-right">
                                <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">Go Home</a>
                            </div>
                        </div>
                    </div>

                @endforelse

                <div class="my-3 ">
                    {{ $articles}}
                </div>

            </div>

            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="p-4 mb-3 bg-light rounded">
                        <h4 class="fst-italic">About</h4>
                        <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
                    </div>

                    <div class="p-4">
                        <h4 class="fst-italic">Archives</h4>
                        <ol class="list-unstyled mb-0">
                            @foreach($random as $r)
                                <li><a href="{{ url('/?date='.$r->format('Y-m-d')) }}">{{ $r->format('d M Y ') }}</a></li>
                            @endforeach
                        </ol>
                    </div>

                    <div class="p-4">
                        <h4 class="fst-italic">Elsewhere</h4>
                        <ol class="list-unstyled">
                            <li><a href="#"><i class="feather-github mr-2   text-secondary "></i>GitHub</a></li>
                            <li><a href="#"><i class="feather-twitter mr-2 text-secondary "></i>Twitter</a></li>
                            <li><a href="#"><i class="feather-facebook mr-2  text-secondary "></i>Facebook</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
