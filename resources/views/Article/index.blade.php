@extends('layouts.master')
@section('title','Article List')
@section('style')
    <style>
        table tbody{
            overflow-scrolling: auto;
        }
        .pagination{
            margin-bottom: 0 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container p-0">
        <div class="row ">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body ">
                        <h3 class="mb-3 "> <i class="fa fa-list-alt "></i> Article List</h3>

                        <table class="table table-bordered table-hover">
                            <thead class="table-danger ">
                            <tr>
                                <th>#</th>
                                <th>Article</th>
                                <th>Category</th>
                                <th>Owner</th>
{{--                                @can(\Illuminate\Support\Facades\Auth::user()->role == '1')--}}
                                <th>Control</th>
{{--                                @endcan--}}
                                <th>Created_at</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{ $article->id }}</td>

                                        <td>
                                            <span class="font-weight-bolder ">
                                                {{ \Illuminate\Support\Str::limit($article->title,20) }}
                                            </span>
                                            <br>
                                            <small class="text-black-50">
                                                {{ \Illuminate\Support\Str::limit($article->description,30) }}
                                            </small>
                                        </td>

                                        <td>{{ $article->category->title }}</td>
                                        <td>{{ $article->user->name }}</td>
                                        <td class="">
                                            <div class="d-flex justify-content-between align-items-center ">
                                                <div class="">
                                                    <a href="{{ route('article.show',[$article->id,'page'=>request()->page]) }}" class="btn btn-sm  btn-outline-success">
                                                        <i class="fa fa-icicles"></i>
                                                    </a>
                                                    @if( \Illuminate\Support\Facades\Auth::user()->role == 0 || \Illuminate\Support\Facades\Auth::user()->id == $article->user_id )
                                                    <a href="{{ route('article.edit',$article->id) }}" class="btn btn-sm  btn-outline-warning">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <form id="delForm"   action="{{ route('article.destroy',[$article->id,'page'=>request()->page]) }}" class="d-inline-block " method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="askConfirm('{{$article->title}}')" class="btn btn-sm  btn-outline-primary deleteBtn"> <i class="fa fa-trash-alt "></i></button>
                                                    </form>
                                                    @endif
                                                </div>

                                                @if(\Illuminate\Support\Facades\Auth::user()->role == 0)
                                                <div class="">
                                                    <a href="{{ route('article.comainleft',$article->id) }}" class="btn btn-sm  {{ $article->co_main == 2 ? 'btn-outline-success ' : 'text-black-50' }} ">
                                                        <i class="fa fa-star-of-david  "></i>
                                                    </a>
                                                    <a href="{{ route('article.comainright',$article->id) }}" class="btn btn-sm  {{ $article->co_main == 1 ? 'btn-outline-warning ' : 'text-black-50' }} ">
                                                        <i class="fa fa-star-of-life" ></i>
                                                    </a>
                                                </div>

                                                <a href="{{ route('article.mainCover',$article->id) }}" class="btn btn-sm {{ $article->mainCover == 1 ? 'btn-outline-warning' : '' }} ">
                                                    <i class="fa fa-star "></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>

                                        <td>
                                            <small> <i class="fa fa-calendar-alt mr-2 "></i>   {{ $article->created_at->format('d-m-Y ') }}</small>
                                            <br>
                                            <small><i class="fa fa-clock mr-2 "></i>{{ $article->created_at->format('h:i a ') }}</small>
                                        </td>

                                @endforeach
                            </tbody>

                               <div class="d-flex justify-content-between align-items-center mb-3 ">
                                   <span> {!! $articles->appends(\Illuminate\Support\Facades\Request::all())->links() !!}</span>
                                   @isset(request()->search)
                                       <a href="{{ route('article.index') }}"  class="btn  btn-dark">All Article</a>
                                       <span class="font-weight-bolder ">Search By : " {{ request()->search }} "</span>
                                   @endisset

                                   <div class="form-inline ">
                                       <form action="{{ route('article.index') }}" method="get">
                                           <input type="text" name="search" value="{{ request()->search }}" class="form-control  ">
                                           <button class="ml-2 btn  btn-outline-success">Search</button>
                                       </form>

                                   </div>
                               </div>

                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('footer')
    <script>

        $(document).ready(function (){

            askConfirm =  (x) => {
                console.log('hlell');
                Swal.fire({
                    title: x,
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons:true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delForm').submit();
                    }
                })
            }

        })
    </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>

@endsection
