@extends('blog.master')
@section('content')

<div class="container">
    <div class="row mb-4 ">
        <div class="col-12 col-md-8">
            <div class="card bg-transparent border-0 shadow-sm ">
                <div class="card-body">
                    <h3 class="text-center text-capitalize mb-3 " style="line-height: 2em;">{{ $article->title }} </h3>
                    @if($article->photo != 'blog_photo.jpeg')
                        <div class="text-center">
                            <img src="{{ asset('storage/BlogPhoto/'.$article->photo) }}" width="50%" height="50%" alt="">
                        </div>
                    @endif

                    <div class="d-flex align-items-center justify-content-center">
                        <small class="mr-2 mb-4 mt-2 ">
                            <i class="feather-calendar"></i>
                            {{ $article->created_at->format('d M Y') }}
                        </small>
                        <small class="mr-2 mb-4 mt-2 ">
                            <i class="feather-user"></i>
                            {{ $article->user->name  }}
                        </small>
                        <small class="mr-2 mb-4 mt-2 ">
                            <i class="feather-clock"></i>
                            {{ $article->updated_at->diffForHumans() }}
                        </small>
                        <small class="mr-2 mb-4 mt-2 ">
                            <i class="feather-layers"></i>
                            {{ $article->category->title }}
                        </small>
                    </div>

                    <div class="body">
                        @php
                            echo html_entity_decode($article->description);
                        @endphp
                    </div>

                    <div class="d-flex align-items-center justify-content-between ">
                        @php
                        $previousArticle = \App\Article::where('id','<',$article->id)->orderBy('id','desc')->with('category')->first();
                        $nextArticle = \App\Article::where('id','>',$article->id)->with('category')->first();
                        @endphp
                        <a href="{{ route('blog.show',$previousArticle->slug.'?category='.$previousArticle->category->slug ?? '/') }}" class="mr-2 mb-4 mt-4 {{ isset($previousArticle->id ) ? 'text-primary' : 'd-none' }} ">
                            <i class="feather-arrow-left"></i>
                            PREVIOUS
                        </a>
                        <a href="{{ route('blog.show',$nextArticle->slug.'?category='.$previousArticle->category->slug ?? '/') }}" class="mr-2 mb-4 mt-4 {{ isset($nextArticle->id ) ? 'align-self-end' : 'd-none' }}">
                           NEXT
                            <i class="feather-arrow-right"></i>
                        </a>

                    </div>


                </div>
            </div>

        </div>

        <div class="col-12 col-md-4">
            <h2 class="ml-md-2 "> Articles  </h2>
            @forelse($articles as $a)
                <div class="card bg-transparent border-0 shadow-sm mb-2 ">
                    <div class="card-body">
                        <h5 class="text-capitalize">
                            <a href="{{ route('blog.show',$a->slug.'?category='.$a->category->slug) }}" class="text-decoration-none" >{{ \Illuminate\Support\Str::words($a->title,5) }} </a>
                        </h5>
                        <div class="d-flex align-items-center text-black-50">
                            <small class="mr-2 mb-4 mt-2 "  >
                                <i class="feather-layers"></i>
                                {{ $a->category->title }}
                            </small>
                            <small class="mr-2 mb-4 mt-2 ">
                                <i class="feather-calendar"></i>
                                {{ $a->created_at->format('M d') }}
                            </small>

                            <small class="mr-2 mb-4 mt-2 ">
                                <i class="feather-clock"></i>
                                {{ $a->updated_at->diffForHumans() }}
                            </small>

                        </div>
                        <div class="body  ">
                            {{ \Illuminate\Support\Str::limit($a->description,100) }}
                        </div>

                        <div class="d-flex justify-content-between align-items-baseline mt-2 ">
                            <div class=" ">
                                <img src="{{ asset('storage/profile/'.$a->user->photo) }}"  class="rounded rounded-circle" width="30px" height="30px" alt="">
                            </div>
                            <a href="{{ route('blog.show',$a->slug.'?category='.$a->category->slug) }}" class="align-self-end">Continue Reading ...</a>
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

                        <div class="text-right ">
                            <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">Go Home</a>
                        </div>
                    </div>
                </div>

            @endforelse
            {{ $articles }}
{{--            <div class="my-3 {{ count($articles) ? 'd-block' : 'd-none' }}">--}}
{{--                @php--}}
{{--                    $head = \Illuminate\Support\Facades\Request::segment(2);--}}
{{--                    $url = \Illuminate\Support\Facades\Request::url();--}}
{{--                @endphp--}}
{{--                <div class="pagination">--}}
{{--                    <ul class="pagination">--}}
{{--                        <li class="page-item  "><span aria-current="page" class="page-link">1</span>--}}
{{--                        </li>--}}
{{--                        <li class="page-item "><a class="page-link" href="{{ $url }}?page=2">2</a></li>--}}
{{--                        <li class="page-item "><span class="page-link dots">…</span></li>--}}
{{--                        <li class="page-item "><a class="page-link" href="{{ $url }}?page=6">6</a></li>--}}
{{--                        <li class="page-item "><a class="page-link" href="{{ $url }}?page=7">7</a></li>--}}
{{--                        <li class="page-item "><a class="next page-link" href="{{ $url }}?page=17">--}}
{{--                                <i class="feather-arrow-right"></i></a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </div>
</div>
@endsection





