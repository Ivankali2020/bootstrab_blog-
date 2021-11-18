


@extends('blog.master')
@section('content')

    <div class="">
        @forelse($articles as $article)
            <div class="border-bottom mb-4 pb-4 article-preview">
                <div class="p-0 p-md-3">
                    <a class="fw-bold h4 d-block text-decoration-none"
                       href="http://localhost:9090/2021/09/15/et-omnis-eum-ab-non/">
                        {{ $article->title }}
                    </a>

                    <div class="small post-category">
                        <a href="http://localhost:9090/category/apple/" rel="category tag">
                            {{ $article->category->title }}
                        </a>
                    </div>

                    <div class="my-3 feature-image-box">
                        <img width="1024" height="682"
                             src="{{ asset('logo/logo.png') }}"
                             class="attachment-large size-large wp-post-image" alt=""></div>

                    <div class="text-black-50 the-excerpt">
                        <p>
                            {{ \Illuminate\Support\Str::words($article->description,50) }}
                        </p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center see-more-group">
                        <div class="d-flex align-items-center">
                            <img alt="" src="{{ asset('storage/profile/'.$article->user->photo) }}"
                                 class="avatar avatar-50 photo rounded-circle" height="50" width="50"
                                 loading="lazy">
                            <div class="ms-2">
                                    <span class="small">
                                        <i class="feather-user"></i>
                                        {{ $article->role == 1 ? 'Admin' : 'User' }}
                                    </span>
                                <br>
                                <span class="small">{{ $article->creted_at }}</span>
                            </div>
                        </div>
                        <a href="{{ route('blog.show',$article->slug) }}" class="btn btn-outline-primary rounded-pill px-3">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="mb-4 pb-4">
                <div class="py-5 my-5 text-center text-lg-start">
                    <p class="fw-bold text-primary">Dear Viewer</p>
                    <h1 class="fw-bold">
                        There is no article 😔 ...
                    </h1>
                    <p>Please go back to Home Page</p>
                    <a class="btn btn-outline-primary rounded-pill px-3" href="{{ route('blog.index') }}">
                        <i class="feather-home"></i>
                        Blog Home
                    </a>

                </div>
            </div>
        @endforelse

    </div>

    <div class="d-block d-lg-none d-flex justify-content-center" id="pagination">
        <div class="pagination">
            <ul class="pagination">
                <li class="page-item active"><span aria-current="page" class="page-link">1</span>
                </li>
                <li class="page-item"><a class="page-link" href="http://localhost:8000/?page=2">2</a></li>
                <li class="page-item"><span class="page-link dots">…</span></li>
                <li class="page-item"><a class="page-link" href="http://localhost:8000/?page=6">6</a></li>
                <li class="page-item"><a class="page-link" href="http://localhost:8000/?page=7">7</a></li>
                <li class="page-item"><a class="next page-link" href="http://localhost:8000?page=17">
                        <i class="feather-arrow-right"></i></a>
                </li>
            </ul>
        </div>
    </div>

@endsection
@section('sideBar')

    <div class="col-12 col-lg-4 border-start" id="sidebarColumn">
        <div class="position-sticky" style="top: 100px">
            <div class="mb-5 sidebar">


                <div id="search" class="mb-5">
                    <form action="{{ route('blog.index') }}" method="get">
                        <div class="d-flex search-box">
                            <input type="text" class="form-control flex-shrink-1 me-2 search-input"
                                   placeholder="Search Anything" name="search">
                            <button class="btn btn-primary search-btn">
                                <i class="feather-search d-block d-xl-none"></i>
                                <span class="d-none d-xl-block">Search</span>
                            </button>
                        </div>

                    </form>

                </div>

                <div id="category" class="mb-5">
                    <h4 class="fw-bolder">Category Lists</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ route('blog.index') }}" class="{{ request('category') == ''? 'active' : ''}} ">All</a>
                        </li>
                        @forelse($categories as $c)
                            <li class="list-group-item">
                                <a href="{{ url('/'.'?category='.$c->slug) }}" class="{{ request('category') == $c->slug ? 'active' : ''}}">{{ $c->title }}</a>
                            </li>
                        @empty
                            <li class="list-group-item">
                                <a href="https://apple.com" class="active">Apple</a>
                            </li>
                        @endforelse
                    </ul>
                </div>
                <div class="d-none d-lg-block" id="pagination">
                    <div class="pagination">
                        <ul class="pagination">
                            <li class="page-item active"><span aria-current="page" class="page-link">1</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="http://localhost:8000/?page=2">2</a></li>
                            <li class="page-item"><span class="page-link dots">…</span></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:8000/?page=6">6</a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:8000/?page=7">7</a></li>
                            <li class="page-item"><a class="next page-link" href="http://localhost:8000?page=17">
                                    <i class="feather-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

